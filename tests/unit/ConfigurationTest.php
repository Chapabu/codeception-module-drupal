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
     * @var array
     */
    protected $validPathNoModulesConfig = [];

    /**
     * @var \Codeception\SuiteManager
     */
    protected $suiteManager;

    /**
     * { @inheritdoc }
     */
    protected function _before()
    {
        $this->module = new Drupal;
        $this->validConfig = Fixtures::get('validModuleConfig');
        $this->invalidConfig = Fixtures::get('invalidModuleConfig');
        $this->invalidModuleConfig = Fixtures::get('validPathInvalidModules');
        $this->validPathNoModulesConfig = Fixtures::get('validModuleConfigNoModules');
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
        $this->module->_setConfig($this->validPathNoModulesConfig);
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
        $this->dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher;
        $this->suiteManager = new \Codeception\SuiteManager(
            $this->dispatcher,
            'testsuite',
            Fixtures::get('suiteConfigWithSubmodule')
        );

        // Make the initializeModules method accessible for our test.
        $initModulesMethod = new ReflectionMethod($this->suiteManager, 'initializeModules');
        $initModulesMethod->setAccessible(true);
        $initModulesMethod->invoke($this->suiteManager);
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
