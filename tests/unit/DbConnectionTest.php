<?php

use Codeception\Module\Drupal7\Drupal7 as Drupal;
use Codeception\Util\Fixtures;

/**
 * Class DbConnectionTestCest
 */
class DbConnectionTest extends \Codeception\TestCase\Test
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
     * { @inheritdoc }
     */
    protected function _before()
    {
        $this->validConfig = Fixtures::get('validModuleConfig');

        $this->module = new Drupal;
        $this->module->_setConfig($this->validConfig);
        $this->module->_initialize();
    }

    /**
     * @test
     */
    public function it_can_access_the_database()
    {
        $entityInfo = entity_get_info();

        $this->assertCount(6, $entityInfo, 'Entity info returned.');
    }
}
