# Codeception Drupal Module

[![Build Status](https://travis-ci.org/Chapabu/codeception-module-drupal.svg?branch=master)](https://travis-ci.org/Chapabu/codeception-module-drupal)
[![Coverage Status](https://coveralls.io/repos/Chapabu/codeception-module-drupal/badge.svg?branch=master)](https://coveralls.io/r/Chapabu/codeception-module-drupal?branch=master)

Codeception This module aims to allow tests to use the Drupal API during
testing. This allows for better functional testing of your Drupal sites.

## Installation

```bash
$ composer require chapabu/codeception-module-drupal --dev
```

## Usage

In your `*.suite.yml` file, add `Drupal` to your enabled modules list.

### Example configuration

This will run tests under the assumption that your Drupal installation
is in a `drupal` sub-directory.

```yaml
class_name: AcceptanceTester
modules:
    enabled:
        \Codeception\Module\Drupal7\Drupal7:
            root: 'drupal'
```

### Options

```root``` - This defines the Drupal root in relation to the
`codecept.yml` file. If this isn't passed in it defaults to the current
working directory.

```relative``` - This allows you to specify if the path to the drupal root is relative from the `codeception.yml` file. Accepts `yes` or `no` (default `no`).
## Roadmap

* ~~0.1.0~~
    * ~~There are assertions for Entities, Bundles, and Fields.~~
    * ~~There is test coverage of at _least_ 70%~~

## Running tests

To setup this module for testing, run `$ composer testinit` followed by
`$ vendor/bin/codecept run` or simply `$ codecept run` if you have
Codeception installed system wide.

The `testinit.sh` script assumes you have Drush installed system-wide.  This will install
Drupal using the username of root and a blank password to a MySQL
database. Feel free to edit this file should you need to, but please
ensure it is not committed back.

## License

The project is licensed under The MIT License (MIT).
