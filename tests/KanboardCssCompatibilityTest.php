<?php

/**
 * Verifies KanboardCSS metadata, asset order, colour schemes, and responsive safeguards.
 *
 * Related production files: Plugin.php and Assets/css/kanboardcss.css.
 */

$plugin = $loadedPlugins[$pluginName];
$stylesheetPath = $pluginRoot . '/Assets/css/kanboardcss.css';
$customStylesheetPath = $pluginRoot . '/Assets/css/kanboardcss-custom.css';
$stylesheet = file_get_contents($stylesheetPath);

kanboardCssAssertSame('3.7.0', $plugin->getPluginVersion(), 'The plugin version must match the production release being prepared.');
kanboardCssAssertSame('>=1.2.54', $plugin->getCompatibleVersion(), 'Compatibility must not advertise an untested Kanboard release.');
kanboardCssAssertTrue(is_file($stylesheetPath), 'The main stylesheet must exist.');
kanboardCssAssertTrue(is_file($customStylesheetPath), 'The user override stylesheet must exist.');

$cssListeners = $container['hook']->getListeners('template:layout:css');
$expectedListeners = array(
    array('template' => 'plugins/KanboardCSS/Assets/css/kanboardcss.css'),
    array('template' => 'plugins/KanboardCSS/Assets/css/kanboardcss-custom.css'),
);

kanboardCssAssertSame($expectedListeners, $cssListeners, 'The custom stylesheet must load after the main theme.');
kanboardCssAssertTrue(strpos($stylesheet, 'light-dark(') !== false, 'The stylesheet must provide paired light and dark colours.');
kanboardCssAssertTrue(strpos($stylesheet, '@media (prefers-reduced-motion: reduce)') !== false, 'Reduced-motion preferences must be supported.');
kanboardCssAssertTrue(strpos($stylesheet, '@media (forced-colors: active)') !== false, 'Forced-colour mode must retain visible boundaries.');
kanboardCssAssertTrue(strpos($stylesheet, '@media screen and (max-width: 768px)') !== false, 'The responsive layout must cover tablet and mobile widths.');
kanboardCssAssertTrue(strpos($stylesheet, 'width: min(281px, calc(100vw - 2rem))') !== false, 'The dropdown must not overflow a narrow viewport.');
kanboardCssAssertTrue(strpos($stylesheet, '.task-summary-container.color-blue {background-color: light-dark(') !== false, 'Task summaries must retain their colour identity in both themes.');
kanboardCssAssertTrue(strpos($stylesheet, 'color: var(--kbcss-task-summary-text)') !== false, 'Task summary text must remain legible in dark mode.');
kanboardCssAssertTrue(strpos($stylesheet, '#task-summary h2 {' . PHP_EOL . '    color: var(--kbcss-text)') !== false, 'Task headings must use neutral text instead of warning red.');
kanboardCssAssertTrue(strpos($stylesheet, 'background-color: var(--kbcss-active-background)') !== false, 'Non-destructive active states must use the blue interaction palette.');
kanboardCssAssertFalse(strpos($stylesheet, 'font-family: Roboto') !== false, 'KanboardCSS must not override FontSwitcher on task titles.');
kanboardCssAssertFalse((bool) preg_match('/(?:^|\})\s*a\s*\{[^}]*color:\s*(?:black|#000000)\s*;/i', $stylesheet), 'Global links must not force black text in dark mode.');
kanboardCssAssertFalse((bool) preg_match('/@media[^}]+max-width:\s*500px[^}]*}.*?\.comment-actions\s*\{\s*display:\s*none/s', $stylesheet), 'Mobile layouts must preserve comment actions.');

$declaredVariables = array();
$referencedVariables = array();
$coreCss = '';
$coreCssIterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($kanboardRoot . '/assets/css/src', FilesystemIterator::SKIP_DOTS)
);

foreach ($coreCssIterator as $coreCssFile) {
    if ($coreCssFile->isFile() && $coreCssFile->getExtension() === 'css') {
        $coreCss .= file_get_contents($coreCssFile->getPathname());
    }
}

preg_match_all('/(--[a-z0-9_-]+)\s*:/i', $stylesheet . $coreCss, $declaredMatches);
preg_match_all('/var\((--[a-z0-9_-]+)/i', $stylesheet, $referencedMatches);
$declaredVariables = array_fill_keys($declaredMatches[1], true);
$referencedVariables = array_unique($referencedMatches[1]);

foreach ($referencedVariables as $referencedVariable) {
    kanboardCssAssertTrue(isset($declaredVariables[$referencedVariable]), 'Undefined CSS custom property: ' . $referencedVariable . '.');
}
