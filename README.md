# PHPUnit Pretty Result Printer

This Result Printer for PHPUnit shows more information in a more readable format during a test run

Branch  | Status|Dependency Status
------- | ------|------------
master  | [![Build Status](https://travis-ci.org/zf2timo/PHPUnitPrettyResultPrinter.svg?branch=master)](https://travis-ci.org/zf2timo/PHPUnitPrettyResultPrinter)|[![Dependency Status](https://www.versioneye.com/user/projects/57023edffcd19a0039f1564e/badge.svg?style=flat)](https://www.versioneye.com/user/projects/57023edffcd19a0039f1564e)
develop  | [![Build Status](https://travis-ci.org/zf2timo/PHPUnitPrettyResultPrinter.svg?branch=develop)](https://travis-ci.org/zf2timo/PHPUnitPrettyResultPrinter)|[![Dependency Status](https://www.versioneye.com/user/projects/57023edbfcd19a004543f820/badge.svg?style=flat)](https://www.versioneye.com/user/projects/57023edbfcd19a004543f820)

# Preview

![PHPUnitPrettyResultPrinter Screenshot](https://cloud.githubusercontent.com/assets/3073381/14188190/262046ee-f787-11e5-858a-6978a4a83b14.png)

# Installation

Installation is provided via composer and can be done with the following command:
```bash 
$ composer require --dev zf2timo/phpunit-pretty-result-printer:^1.0
```

To activate the Printer for PHPUnit, just add it to your configuration XML:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit printerClass="zf2timo\PrettyResultPrinter\Printer">
 // ....
</phpunit>
```
# Configuration

In some Environments like Travis, Jenkins or some old Bash Console the UTF-8 Characters ✘ and ✔ are not supported.
You can enable the default PHPUnit symbols by exporting an environment variable:
 ```bash
 $ export PHP_CI=true
 $ php vendor/bin/phpunit
 ```
