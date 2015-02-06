<?php

use Codeception\Module\Drupal;
use Codeception\Util\Fixtures;

/**
 * Class ConfigurationTest
 */
class ConfigurationTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \Codeception\Module\Drupal
     */
    protected $module;

    protected $validConfig = [
        'root' => 'vendor/drupal/drupal'
    ];

    protected $invalidConfig = [
        'root' => 'this/is/a/fake/path'
    ];

    /**
     *
     */
    protected function _before()
    {
        $this->module = new Codeception\Module\Drupal();
    }

    /**
     *
     */
    protected function _after()
    {
    }

    /**
     * @test
     */
    public function it_throws_exception_if_path_to_drupal_is_incorrect()
    {
        $this->module->_setConfig($this->invalidConfig);
        $this->setExpectedException('\Codeception\Exception\DrupalNotFoundException', 'Drupal root incorrect.');
        $this->module->_initialize();
    }

    /**
     * @test
     */
    public function it_bootstraps_drupal()
    {
        $this->module->_setConfig($this->validConfig);
        $this->module->_initialize();

        $watchdogLevels = watchdog_severity_levels();

        $this->assertCount(8, $watchdogLevels, 'Drupal API available');
    }
}
