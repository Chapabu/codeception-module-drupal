<?php namespace Drupal7;

use \UnitTester;

class EntityAssertionsCest extends Drupal7AssertionCestBase
{
    public function it_can_grab_entity_information_for_all_entities(UnitTester $I)
    {
        $entityInfo = $I->grabEntityInfo();
        $I->assertCount($entityInfo, 6);
    }

    public function it_can_grab_entity_information_for_a_single_entity_type(UnitTester $I)
    {
        $entityInfo = $I->grabEntityInfo('node');
        $I->assertContains('base table', $entityInfo);
        $I->assertEquals($entityInfo['base table'], 'node');
    }
}
