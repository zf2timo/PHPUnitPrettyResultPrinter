<?php

namespace PrettyResultPrinterTest\ChildNamespace\GrandChildNamespace\SubNamespace;

class PrinterTest extends \PHPUnit_Framework_TestCase
{

    public function testTestCaseNameIsDisplayed()
    {
        $this->assertTrue(true);
    }

    public function testThatFails()
    {
        $this->assertTrue(false);
    }

    public function testIsIncomplete()
    {
        $this->markTestIncomplete('Test Stub is incomplete.');
    }

    public function testIsSkipped()
    {
        $this->markTestSkipped('Test Stub is Skipped');
    }
}
