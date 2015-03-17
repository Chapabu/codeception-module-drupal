<?php namespace Drupal7;

use \UnitTester;

class SystemAssertionsCest extends Drupal7AssertionCestBase
{

    public function it_can_grab_a_variable(UnitTester $I)
    {
        $adminTheme = $I->grabVariable('admin_theme');

        $I->assertEquals('seven', $adminTheme);
    }

    public function it_can_see_if_a_module_is_enabled(UnitTester $I)
    {
        $I->seeModuleIsEnabled('node');
    }

    public function it_fails_if_a_module_is_not_enabled_when_it_should_be(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->seeModuleIsEnabled('book');
        });
    }

    public function it_can_see_if_a_module_is_disabled_or_not_present(UnitTester $I)
    {
        $I->dontSeeModuleIsEnabled('book');
    }

    public function it_fails_if_a_module_is_enabled_when_it_should_not_be(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->dontSeeModuleIsEnabled('node');
        });
    }

    public function it_can_see_if_a_variable_matches_a_value(UnitTester $I)
    {
        $I->seeVariableIs('admin_theme', 'seven');
    }

    public function it_fails_if_a_variable_does_not_match_the_expected_value(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->seeVariableIs('admin_theme', 'bartik');
        });
    }

    public function it_can_see_if_a_variable_does_not_match_a_value(UnitTester $I)
    {
        $I->dontSeeVariableIs('admin_theme', 'bartik');
    }

    public function it_fails_if_a_variable_matches_a_value_when_it_should_not(UnitTester $I)
    {
        $I->shouldFail(function () use ($I) {
            $I->dontSeeVariableIs('admin_theme', 'seven');
        });
    }
}
