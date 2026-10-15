<?php

// phpcs:ignoreFile PSR1.Files.SideEffects.FoundWithSymbols -- This executable test bootstrap must define Kanboard constants.

/**
 * Runs KanboardCSS's focused production regression checks against Kanboard.
 *
 * Related test files: TestAssertions.php and KanboardCssCompatibilityTest.php.
 */

$kanboardRoot = isset($argv[1]) ? realpath($argv[1]) : false;

if ($kanboardRoot === false || !is_file($kanboardRoot . '/app/common.php')) {
    fwrite(STDERR, "Usage: php tests/run.php <kanboard-root>\n");
    exit(2);
}

$pluginRoot = dirname(__DIR__);
$pluginsRoot = getenv('KANBOARD_PLUGINS_DIR') ?: $kanboardRoot . '/plugins';

define('PLUGINS_DIR', $pluginsRoot);
define('DB_FILENAME', ':memory:');

require $kanboardRoot . '/app/common.php';
require __DIR__ . '/TestAssertions.php';

$pluginName = 'KanboardCSS';
$loadedPlugins = $container['pluginLoader']->getPlugins();
$incompatiblePlugins = $container['pluginLoader']->getIncompatiblePlugins();

kanboardCssAssertFalse(isset($incompatiblePlugins[$pluginName]), 'KanboardCSS must be compatible with the tested Kanboard release.');
kanboardCssAssertTrue(isset($loadedPlugins[$pluginName]), 'KanboardCSS must load before its regression checks run.');

require __DIR__ . '/KanboardCssCompatibilityTest.php';

echo 'KanboardCSS regression checks passed on Kanboard ' . APP_VERSION . ' with PHP ' . PHP_VERSION . PHP_EOL;
