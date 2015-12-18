<?php

namespace PrettyResultPrinter;

use PHPUnit_Framework_Test;
use PHPUnit_TextUI_ResultPrinter;
use PrettyResultPrinter\Exception\InvalidArgumentException;


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

        if ($this->lastClassName !== $this->className) {
            echo PHP_EOL;
            echo $this->formatClassName($this->className);
            echo "\t";

            $this->lastClassName = $this->className;
        }

        $this->printTestCaseStatus($progress);
    }

    /**
     * @param string $progress Result of the Test Case => . F S I R
     * @throws Exception\InvalidArgumentException
     */
    private function printTestCaseStatus($progress)
    {

        switch (strtoupper($progress)) {
            case '.':
                echo "\033[01;32m" . mb_convert_encoding("\x27\x14", 'UTF-8', 'UTF-16BE') . "\033[0m";
                return;
            case 'F':
                echo "\033[01;31m" . mb_convert_encoding("\x27\x16", 'UTF-8', 'UTF-16BE') . "\033[0m";
                return;
            default:
                echo $progress;
                return;
        }
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
} 