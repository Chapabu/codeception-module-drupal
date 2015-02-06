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

    /**
     * @var array
     */
    protected $validConfig = [];

    /**
     * @var array
     */
    protected $invalidConfig = [];

    /**
     * { @inheritdoc }
     */
    protected function _before()
    {
        $this->module = new Drupal;
        $this->validConfig = Fixtures::get('validModuleConfig');
        $this->invalidConfig = Fixtures::get('invalidModuleConfig');
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
}
