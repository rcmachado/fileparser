<?php
$testDir = dirname(__FILE__);
$baseDir = dirname($testDir);
set_include_path($baseDir . PATH_SEPARATOR . get_include_path());
define('FIXTURES_DIR', $testDir);

if (!file_exists("$baseDir/build")) {
    mkdir("$baseDir/build/coverage", 0755, true);
    mkdir("$baseDir/build/logs", 0755, true);
}
?>