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
        'entity'
    ]
]);
