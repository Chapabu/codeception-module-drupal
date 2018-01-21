# Codeception Drupal Module

Branch | Build Status | Coverage
-------|--------------|----------
Master|[![Build Status](https://travis-ci.org/Chapabu/codeception-module-drupal.svg?branch=master)](https://travis-ci.org/Chapabu/codeception-module-drupal)|[![Coverage](https://coveralls.io/repos/Chapabu/codeception-module-drupal/badge.svg?branch=master)](https://coveralls.io/r/Chapabu/codeception-module-drupal?branch=master)
Develop|[![Build Status](https://travis-ci.org/Chapabu/codeception-module-drupal.svg?branch=develop)](https://travis-ci.org/Chapabu/codeception-module-drupal)|[![Coverage](https://coveralls.io/repos/Chapabu/codeception-module-drupal/badge.svg?branch=develop)](https://coveralls.io/r/Chapabu/codeception-module-drupal?branch=develop)

This module aims to allow tests to use the Drupal API during
testing. This allows for better functional testing of your Drupal sites.

It also makes test driven development with Drupal significantly easier, as you can make assertions on items that you create through the UI.

## Installation

```bash
$ composer require chapabu/codeception-module-drupal --dev
```

## Usage

In your `*.suite.yml` file, add `Drupal` to your enabled modules list.

### Example configuration

This will run tests under the assumption that your Drupal installation is in a
`drupal` sub-directory.

```yaml
class_name: AcceptanceTester modules:
    enabled:
        \Codeception\Module\Drupal7\Drupal7:
            root: 'drupal'
            relative: yes
```

### Options

#### root
Accepts: `string` Default: `current working directory`

This defines the Drupal root in relation to the `codecept.yml` file. If this isn't passed in it defaults to the current working directory.

#### relative
Accepts: `yes` or `no` Default: `no`

This allows you to specify if the path to the drupal root is relative from the
`codeception.yml` file. Accepts `yes` or `no`.

## About URL-based functional tests
The [Codeception Documentation on Functional tests](http://codeception.com/docs/04-FunctionalTests) says:

> Now that we’ve written some acceptance tests, functional tests are almost the 
> same, with one major difference: Functional tests don’t require a web server.

This - or at least the first part of this - is not true for functional tests 
for Drupal 7 (whether they be based on this module or anything else). A 
little further, the same documentation says:

> If your application was not designed to run in long lived processes (e.g. if 
> you use the exit operator or global variables), then functional tests are 
> probably not for you.

We respectfully disagree. The technical part of this is true for Drupal 7. It
*does* call exit and uses global variables. It also calls the header() PHP 
function directly, in some situations (e.g. in drupal_goto()), which also 
prevents the test process to survive more than one request. All this means, 
though, is that in Drupal 7's case, functional tests are nothing like acceptance 
tests, because HTTP-request-based tests are not going to fly. This is why you 
will not find a Connector class in this package as with other frameworks. 

However, we still have access to the API and database, which lets us do some 
pretty useful stuff that both unit tests and acceptance tests are unable to.

## Contributing

### Coding standards

Please ensure all code follows
[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
standards where possible (with the exception of and Codeception methods that
don't follow this already, such as `_initialize`)

Tests do not need to follow PSR-2 exactly, but should follow the standards laid out by the current tests (i.e. test method naming doesn't conform to PSR-2, but is more useful in this context).

### Tests

All contributions should come with relevant unit tests as per the rest of the
suite. For examples, look under the `tests` directory

#### Running tests - Linux/OSX

To setup for testing, run `$ composer testinit` followed by `$
vendor/bin/codecept run` or simply `$ codecept run` if you have Codeception
installed system wide.

The `testinit.sh` script assumes you have Drush installed system-wide.  This
will install Drupal using the username of root and a blank password to a MySQL
database. Feel free to edit this file should you need to, but please ensure it
is not committed back.

#### Running tests - Windows

If you want to contribute and are running Windows, you should just run the command contained in the `testinit.sh` script using the command line.

## License

The project is licensed under The MIT License (MIT).
