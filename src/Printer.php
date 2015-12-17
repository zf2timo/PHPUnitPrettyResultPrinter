<?php

namespace PrettyResultPrinter;

use PHPUnit_Framework_Test;
use PHPUnit_TextUI_ResultPrinter;


/**
 * Class Printer
 *
 * @license MIT
 */
class Printer extends \PHPUnit_TextUI_ResultPrinter
{

    /**
     * @var string
     */
    private $className = '';

    /**
     * @var string
     */
    private $lastClassName = '';

    /**
     * @var int
     */
    private $maxClassNameLength = 40;

    /**
     * {@inheritdoc}
     */
    protected function writeProgress($progress)
    {
        if ($this->debug) {
            parent::writeProgress($progress);
            return;
        }

        $this->printClassName();

        $this->printTestCaseStatus($progress);
    }

    /**
     * {@inheritdoc}
     */
    protected function writeProgressWithColor($color, $buffer)
    {

        if ($this->debug) {
            parent::writeProgressWithColor($color, $buffer);
        }

        $this->printClassName();
    }


    /**
     * @param string $progress Result of the Test Case => . F S I R
     * @throws Exception\InvalidArgumentException
     */
    private function printTestCaseStatus($progress)
    {

        switch (strtoupper($progress)) {
            case '.':
                $color = 'fg-green';
                $buffer = mb_convert_encoding("\x27\x14", 'UTF-8', 'UTF-16BE');
                break;
            case 'F':
                $color = 'fg-red';
                $buffer = mb_convert_encoding("\x27\x16", 'UTF-8', 'UTF-16BE');
                break;
            default:
                $color = '';
                $buffer = $progress;
        }

        if ($this->colors !== true) {
            echo $buffer;
        }

        echo parent::formatWithColor($color, $buffer);
    }

    /**
     * {@inheritdoc}
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
        $this->className = get_class($test);
        parent::startTest($test);
    }

    /**
     * @param string $className
     * @return string
     */
    private function formatClassName($className)
    {
        if (strlen($className) <= $this->maxClassNameLength) {
            return $this->fillWithWhitespace($className);
        }

        return '...' . substr($className, strlen($className) - $this->maxClassNameLength, $this->maxClassNameLength);
    }

    /**
     * @param string $className
     * @return string;
     */
    private function fillWithWhitespace($className)
    {
        return str_pad($className, $this->maxClassNameLength);
    }

    /**
     * Prints the Class Name if it has changed
     */
    protected function printClassName()
    {
        if ($this->lastClassName === $this->className) {
            return;
        }

        echo PHP_EOL;
        echo $this->formatClassName($this->className);
        echo "\t";

        $this->lastClassName = $this->className;
    }
} 