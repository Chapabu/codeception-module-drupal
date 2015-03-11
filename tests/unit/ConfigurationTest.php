<?php

use Codeception\Module\Drupal7\Drupal7 as Drupal;
use Codeception\SuiteManager;
use Codeception\Util\Fixtures;
use Mockery as Mock;

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
     * { @inheritdoc }
     */
    protected function setUp()
    {
        parent::setUp();

        // This is required as there was a commit recently that made the SuiteManager better. Sadly, it made this fail
        // on the latest dev release for Codeception.
        if (Codeception\Codecept::VERSION >= '2.1.0') {
            $this->module = $this->moduleContainer->getModule('\Codeception\Module\Drupal7\Drupal7');
        } else {
            $this->module = SuiteManager::$module['\Codeception\Module\Drupal7\Drupal7'];
        }

        $this->validConfig = Fixtures::get('validModuleConfig');
        $this->invalidConfig = Fixtures::get('invalidModuleConfig');
    }

    /**
     * @test
     */
    public function it_throws_exception_if_path_to_drupal_is_incorrect()
    {
        $this->module->_reconfigure($this->invalidConfig);
        $this->setExpectedException('\Codeception\Exception\DrupalNotFoundException', 'Drupal root incorrect.');
        $this->module->_initialize();
    }

    /**
     * @test
     */
    public function it_returns_true_if_drupal_root_is_valid()
    {
        $validRoot = $this->module->validateDrupalRoot($this->validConfig['root']);
        $this->assertTrue($validRoot);
    }

    /**
     * @test
     */
    public function it_bootstraps_drupal()
    {

        if (!function_exists('watchdog_severity_levels')) {
            $this->fail('Drupal API unavailable');
        }

        $watchdogLevels = watchdog_severity_levels();

        $this->assertCount(8, $watchdogLevels, 'Drupal API available');
    }

    public function tearDown()
    {
        $this->module->_resetConfig();
        Mock::close();
    }
}
