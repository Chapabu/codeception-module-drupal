<?php namespace Drupal7;

use PHPUnit_Framework_AssertionFailedError;
use \UnitTester;
use Mockery as Mock;

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

    public function it_can_check_if_an_entity_exists(UnitTester $I)
    {
        $I->seeEntityExists('node');
    }

    public function it_can_check_if_an_entity_does_not_exist(UnitTester $I)
    {
        $I->dontSeeEntityExists('nodes');
    }

    public function it_can_check_if_an_entity_has_a_bunde(UnitTester $I)
    {
        $I->seeEntityHasBundle('node', 'article');
        $I->seeEntityHasBundle('node', 'page');

    }

    public function see_fails_if_looking_for_a_non_existent_bundle(UnitTester $I)
    {
        try {
            $I->seeEntityHasBundle('node', 'fakebundle');
        } catch (\PHPUnit_Framework_AssertionFailedError $e) {
            return;
        }

        $I->fail('seeEntityHasBundle does not fail with a non-existent bundle');
    }

    public function it_can_check_if_an_entity_does_not_have_a_bunde(UnitTester $I)
    {
        $I->dontSeeEntityHasBundle('node', 'fakebundle');
        $I->dontSeeEntityHasBundle('node', 'fakebundle2');
    }

    public function dont_see_fails_if_looking_for_an_existing_bundle(UnitTester $I)
    {
        try {
            $I->dontSeeEntityHasBundle('node', 'article');
        } catch (\PHPUnit_Framework_AssertionFailedError $e) {
            return;
        }

        $I->fail('dontSeeEntityHasBundle does not fail with an existing bundle');
    }
}
