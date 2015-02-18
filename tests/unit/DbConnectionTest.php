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
     * @test
     */
    public function it_can_access_the_database()
    {
        if (!function_exists('entity_get_info')) {
            $this->fail('Drupal not bootstrapped.');
        }

        $entityInfo = entity_get_info();

        $this->assertCount(6, $entityInfo, 'Entity info returned.');
    }
}
