# PHPUnit Pretty Result Printer

This Result Printer for PHPUnit shows more information in a more readable format during a test run

# Installation

Installation is provided via composer and can be done with the following command:
```bash 
$ composer require --dev zf2timo/phpunit-pretty-result-printer:^1.0
```

To activate the Printer for PHPUnit, just add it to your configuration XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit printerClass="PrettyResultPrinter\Printer">
 // ....
</phpunit>
```
