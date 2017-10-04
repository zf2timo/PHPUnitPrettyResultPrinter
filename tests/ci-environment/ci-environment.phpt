--TEST--
php vendor/bin/phpunit -c phpunit.xml
--FILE--
<?php
$_SERVER['TERM']    = 'linux';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/__files/phpunit.xml';
$_SERVER['argv'][3] = dirname(__FILE__) . '/__files/PrinterTest.php';
$_SERVER['PHP_CI'] = 'true';

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

\PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


PrettyResultPrinterTest\PrinterTest             	.FIS

Time: %s, Memory: %s

There was 1 failure:

1) PrettyResultPrinterTest\PrinterTest::testThatFails
Failed asserting that false is true.

%s/PHPUnitPrettyResultPrinter/tests/ci-environment/__files/PrinterTest.php:15

FAILURES!
Tests: 4, Assertions: 2, Failures: 1, Skipped: 1, Incomplete: 1.