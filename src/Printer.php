<?php

namespace PrettyResultPrinter;

use PHPUnit\Framework\Test;
use PHPUnit\TextUI\ResultPrinter;
use SebastianBergmann\Environment\Console;

/**
 * Class Printer
 *
 * @license MIT
 */
class Printer extends ResultPrinter
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
     * @var int
     */
    private $maxNumberOfColumns;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        $out = null,
        $verbose = false,
        $colors = self::COLOR_DEFAULT,
        $debug = false,
        $numberOfColumns = 80
    ) {
        parent::__construct($out, $verbose, $colors, $debug, $numberOfColumns);

        if ($numberOfColumns === 'max') {
            $console = new Console();
            $numberOfColumns = $console->getNumberOfColumns();
        }
        $this->maxNumberOfColumns = $numberOfColumns;

        $this->maxClassNameLength = intval($numberOfColumns * 0.6);
    }

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

        $this->printTestCaseStatus('', $progress);
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
        $this->printTestCaseStatus($color, $buffer);
    }

    /**
     * @param string $color
     * @param string $buffer Result of the Test Case => . F S I R
     */
    private function printTestCaseStatus($color, $buffer)
    {
        if ($this->column >= $this->maxNumberOfColumns) {
            $this->writeNewLine();
            $padding = $this->maxClassNameLength;
            $this->column = $padding;
            echo str_pad(' ', $padding) . "\t";
        }

        if ($this->isCIEnvironment()) {
            echo $buffer;
            $this->column++;
            return;
        }

        switch (strtoupper($buffer)) {
            case '.':
                $color = 'fg-green,bold';
                $buffer = \mb_convert_encoding("\x27\x14", 'UTF-8', 'UTF-16BE');
                break;
            case 'F':
                $color = 'fg-red,bold';
                $buffer = \mb_convert_encoding("\x27\x16", 'UTF-8', 'UTF-16BE');
                break;
        }

        echo parent::formatWithColor($color, $buffer);
        $this->column++;
    }

    /**
     * {@inheritdoc}
     */
    public function startTest(Test $test)
    {
        $this->className = get_class($test);
        parent::startTest($test);
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
        $className = $this->formatClassName($this->className);
        if ($this->colors === true) {
            $this->writeWithColor('fg-cyan,bold', $className, false);
        } else {
            $this->write($className);
        }
        $this->column = strlen($className) + 4;
        echo "\t";

        $this->lastClassName = $this->className;
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
     * Detects if PHPUnit is executed in a CI Environment - in this case the UTF-8 Symbols are
     * deactivated because they are not correct displayed in the report.
     *
     * At the moment only travis is support and when its manually disabled
     *
     * @return bool
     */
    private function isCIEnvironment()
    {
        if (isset($_SERVER['PHP_CI']) && $_SERVER['PHP_CI'] === 'true') {
            return true;
        }

        return false;
    }
}
