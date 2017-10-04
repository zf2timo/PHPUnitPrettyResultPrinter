--TEST--
php vendor/bin/phpunit -c phpunit.xml __files/
UnitTest for Issue #36
--FILE--
<?php
$_SERVER['TERM']    = 'linux';
$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = dirname(__FILE__) . '/__files/phpunit.xml';
$_SERVER['argv'][3] = dirname(__FILE__) . '/__files/';

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

\PHPUnit\TextUI\Command::main();
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.


PrettyResultPrinterTest\PrinterTest             	✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔
                                                	✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔
PrettyResultPrinterTest\SecondPrinterTest       	✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔
                                                	✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔✔

Time: %s ms, Memory: %sMB

OK (102 tests, 102 assertions)
