<?php
// This is global bootstrap for autoloading

use Codeception\Util\Fixtures;

Fixtures::add('validModuleConfig', [
  'root' => 'vendor/drupal/drupal'
]);

Fixtures::add('invalidModuleConfig', [
  'root' => 'this/is/a/fake/path'
]);
