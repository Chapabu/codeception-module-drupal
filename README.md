# Codeception Drupal Module

# Please note that this module is under very VERY early development, and as such this readme may be incomplete or inconsistent.

This Codeception module aims to allow tests to use the Drupal API during testing. This allows for better functional testing of your Drupal sites.

## Installation

```bash
$ composer require chapabu/codeception-module-drupal --dev
```

## Usage

In your `*.suite.yml` file, add `Drupal` to your enabled modules list.

### Example configuration:

This will run tests under the assumption that your Drupal installation is in a `drupal` sub-directory.

```yaml
class_name: AcceptanceTester
modules:
    enabled:
        Drupal:
            root: 'drupal'
        
        
```

### Options

```root``` - This defines the Drupal root in relation to the `codecept.yml` file. If this isn't passed in it defaults to the current working directory.

Example:

# Running tests

To setup this module for testing, run `$ composer testinit` followed by `$ vendor/bin/codecept run` or simply `$ codecept run` if you have Codeception installed system wide.

The `testinit.sh` script will use the bundled version of Drush to run `site-install` on the bundled version of Drupal.  This will create an SQLite database and install Drupal.

Once you are done running the tests, run `$ composer donetesting` to remove the SQLite database.