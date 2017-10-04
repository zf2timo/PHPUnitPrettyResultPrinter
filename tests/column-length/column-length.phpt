--TEST--
php vendor/bin/phpunit -c phpunit.xml --columns 60
--FILE--
<?php
$_SERVER['TERM']    = 'linux';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/__files/phpunit.xml';
$_SERVER['argv'][3] = '--columns';
$_SERVER['argv'][4] = '60';
$_SERVER['argv'][5] = dirname(__FILE__) . '/__files/PrinterTest.php';

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

\PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


...ldNamespace\SubNamespace\PrinterTest	✔✖IS

Time: %s, Memory: %s

There was 1 failure:

1) PrettyResultPrinterTest\ChildNamespace\GrandChildNamespace\SubNamespace\PrinterTest::testThatFails
Failed asserting that false is true.

%s/PHPUnitPrettyResultPrinter/tests/column-length/__files/PrinterTest.php:15

FAILURES!
Tests: 4, Assertions: 2, Failures: 1, Skipped: 1, Incomplete: 1.