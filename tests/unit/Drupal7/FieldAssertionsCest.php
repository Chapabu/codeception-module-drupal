<?php namespace Drupal7;

use \UnitTester;

class FieldAssertionsCest extends Drupal7AssertionCestBase
{
    public function it_can_grab_all_base_field_information(UnitTester $I)
    {
        $fieldList = $I->grabFieldList();
        $I->assertTrue(is_array($fieldList));
        $I->assertTrue(!empty($fieldList));
    }

    public function it_can_grab_field_instances_for_a_bundle(UnitTester $I)
    {
        $instance = $I->grabFieldInstance('node', 'field_image', 'article');
        $I->assertNotNull($instance);
    }

    public function it_returns_null_when_grabbing_a_non_existant_field_from_a_bundle(UnitTester $I)
    {
        $instance = $I->grabFieldInstance('user', 'field_image', 'user');
        $I->assertNull($instance);
    }
}