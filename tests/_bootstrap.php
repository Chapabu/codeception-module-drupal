<?php
// This is global bootstrap for autoloading

use Codeception\Util\Fixtures;

Fixtures::add('validModuleConfig', [
    'root' => 'testsites/drupal7/drupal-7.x',
    'submodules' => [
        'entity'
    ]
]);

Fixtures::add('invalidModuleConfig', [
    'root' => 'this/is/a/fake/path',
    'submodules' => [
        'dummy'
    ]
]);

Fixtures::add('validModuleConfigNoModules', [
    'root' => 'testsites/drupal7/drupal-7.x',
]);

Fixtures::add('validPathInvalidModules', [
    'root' => 'testsites/drupal7/drupal-7.x',
    'submodules' => [
        'dummy'
    ]
]);

Fixtures::add('suiteConfigWithSubmodule', [
    'class_name' => 'HobbitGuy',
    'modules' => array(
        'enabled' => array(
            'Codeception\Module\Drupal7\Drupal7',
            'PhpBrowser'
        ),
        'config' => array(
            'Codeception\Module\Drupal7\Drupal7' => Fixtures::get('validModuleConfig'),
            'PhpBrowser' => array(
                'url' => '127.0.0.1'
            )
        ),
    ),
    'namespace' => null,
    'path' => 'tests/shire',
    'groups' => [],
    'suite_class' => '\PHPUnit_Framework_TestSuite',
    'error_level' => 'E_ALL & ~E_STRICT & ~E_DEPRECATED',
]);
