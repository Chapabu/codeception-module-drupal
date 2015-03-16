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
        $I->shouldFail(function() use ($I) {
            $I->seeEntityHasBundle('node', 'fakebundle');
        });
    }

    public function it_can_check_if_an_entity_does_not_have_a_bunde(UnitTester $I)
    {
        $I->dontSeeEntityHasBundle('node', 'fakebundle');
        $I->dontSeeEntityHasBundle('node', 'fakebundle2');
    }

    public function dont_see_fails_if_looking_for_an_existing_bundle(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->dontSeeEntityHasBundle('node', 'article');
        });
    }

    public function it_can_check_if_an_entity_has_a_view_mode(UnitTester $I)
    {
        $I->seeEntityHasViewMode('node', 'full');
        $I->seeEntityHasViewMode('node', 'teaser');
        $I->seeEntityHasViewMode('taxonomy_term', 'full');
        $I->seeEntityHasViewMode('user', 'full');
    }

    public function see_fails_if_an_entity_does_not_have_a_view_mode(UnitTester $I)
    {

        $I->shouldFail(function() use ($I) {
            $I->seeEntityHasViewMode('user', 'teaser');
        });
    }

    public function it_can_check_if_an_entity_does_not_have_a_view_mode(UnitTester $I)
    {
        $I->dontSeeEntityHasViewMode('user', 'teaser');
        $I->dontSeeEntityHasViewMode('taxonomy_term', 'teaser');
    }

    public function dont_see_fails_if_an_entity_has_a_view_mode(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->dontSeeEntityHasViewMode('node', 'full');
        });
    }

    public function it_can_check_if_an_entity_has_a_base_field(UnitTester $I)
    {
        $I->seeEntityHasBaseField('taxonomy_vocabulary', 'hierarchy');
    }

    public function it_should_fail_if_an_entity_has_no_base_field_when_it_should(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->seeEntityHasBaseField('taxonomy_vocabulary', 'fixture');
        });
    }

    public function it_can_check_if_an_entity_does_not_have_a_base_field(UnitTester $I)
    {
        $I->dontSeeEntityHasBaseField('taxonomy_vocabulary', 'fixture');
    }

    public function it_should_fail_if_an_entity_has_a_base_field_when_it_should_not(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->dontSeeEntityHasBaseField('taxonomy_vocabulary', 'hierarchy');
        });
    }
}
