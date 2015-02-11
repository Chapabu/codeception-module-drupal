<?php
// This is global bootstrap for autoloading

use Codeception\Util\Fixtures;

Fixtures::add('validModuleConfig', [
    'root' => 'testsites/drupal7/drupal-7.x',
    'submodules' => [
        'EntityAssertions'
    ]
]);

Fixtures::add('invalidModuleConfig', [
    'root' => 'this/is/a/fake/path',
    'submodules' => [
        'dummy'
    ]
]);


Fixtures::add('validPathInvalidModules', [
    'root' => 'testsites/drupal7/drupal-7.x',
    'submodules' => [
        'entity'
    ]

]);
