<?php

/**
 * Here you can initialize variables that will be used for your tests
 */
use Codeception\Util\Fixtures;

$mockValidModuleConfig = [
    'root' => 'vendor/drupal/drupal'
];

$mockInvalidModuleconfig = [
    'root' => 'this/is/a/fake/path'
];

Fixtures::add('validModuleconfig', $mockValidModuleConfig);
Fixtures::add('invalidModuleConfig', $mockInvalidModuleconfig);
