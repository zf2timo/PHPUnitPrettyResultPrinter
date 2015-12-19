<?php

namespace PrettyResultPrinterTest;

use PrettyResultPrinter\Printer;

class PrinterTest extends \PHPUnit_Framework_TestCase
{

    public function testTestCaseNameIsDisplayed()
    {

        $mock = $this->getMock('\PHPUnit_Framework_Test', null, array(), 'Foo\Bar\CaseTest');

        $printer = new Printer();
        $printer->startTest($mock);
    }
} 