<?php

use Codeception\Module\Drupal7\Drupal7 as Drupal;
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
     * @var \Codeception\Module\Drupal7\Drupal7
     */
    protected $module;

    /**
     * @var array
     */
    protected $validConfig = [];

    /**
     * @var array
     */
    protected $invalidConfig = [];

    /**
     * @var array
     */
    protected $invalidModuleConfig = [];

    /**
     * { @inheritdoc }
     */
    protected function _before()
    {
        $this->module = new Drupal;
        $this->validConfig = Fixtures::get('validModuleConfig');
        $this->invalidConfig = Fixtures::get('invalidModuleConfig');
        $this->invalidModuleConfig = Fixtures::get('validPathInvalidModules');
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

        if (!function_exists('watchdog_severity_levels')) {
            $this->fail('Drupal API unavailable');
        }

        $watchdogLevels = watchdog_severity_levels();

        $this->assertCount(8, $watchdogLevels, 'Drupal API available');
    }

    /**
     * @test
     */
    public function it_loads_submodules_from_config()
    {
        $this->module->_setConfig($this->validConfig);
        $this->module->_initialize();
        // Todo: Work out if I can see which modules are enabled.
        $this->fail('Test needs finishing');
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_module_not_found()
    {
        $this->module->_setConfig($this->invalidModuleConfig);
        $this->setExpectedException('\Codeception\Exception\DrupalSubmoduleNotFoundException');
        $this->module->_initialize();
    }
}
