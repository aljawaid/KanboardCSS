<?php

/**
 * Provides assertion helpers for KanboardCSS's focused regression tests.
 *
 * Related test runner: tests/run.php.
 */

function kanboardCssAssertTrue($condition, $message)
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function kanboardCssAssertFalse($condition, $message)
{
    kanboardCssAssertTrue(!$condition, $message);
}

function kanboardCssAssertSame($expected, $actual, $message)
{
    if ($expected !== $actual) {
        throw new RuntimeException($message . ' Expected ' . var_export($expected, true) . ', got ' . var_export($actual, true) . '.');
    }
}
