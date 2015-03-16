<?php namespace Codeception\Module\Drupal7\Submodules;

/**
 * Class SystemTrait
 * @package Codeception\Module\Drupal7\Submodules
 */
trait SystemTrait
{

    use AssertMethodHelperTrait;

    /**
     * Check to see if a module is enabled.
     *
     * @param string $moduleName
     *   The machine name of the module (i.e. field_collection)
     */
    public function seeModuleIsEnabled($moduleName)
    {
        $this->assertTrue(module_exists($moduleName));
    }

    /**
     * Check to see if a module is enabled.
     *
     * @param string $moduleName
     *   The machine name of the module (i.e. field_collection)
     */
    public function dontSeeModuleIsEnabled($moduleName)
    {
        $this->assertFalse(module_exists($moduleName));
    }

    /**
     * Check that a system variable has a particular value.
     *
     * @param $variableName
     *   The name of the variable you are checking (i.e. site_name)
     * @param $expectedValue
     *   The value you are expecting.
     */
    public function seeVariableIs($variableName, $expectedValue)
    {
        $variableValue = $this->grabVariable($variableName);

        $this->assertEquals($variableName, $expectedValue);
    }

    /**
     * Get the value of a variable from the system table.
     *
     * @param string $variableName
     *   The variable name you want from the database (i.e. admin_theme).
     *
     * @return mixed
     *   The variable value you are looking for, or null if the variable is not set or doesn't exist.
     */
    public function grabVariable($variableName)
    {
        return variable_get($variableName);
    }

    /**
     * Check that a system variable does not have a particular value.
     *
     * @param $variableName
     *   The name of the variable you are checking (i.e. site_name)
     * @param $expectedValue
     *   The value you are expecting to fail.
     */
    public function dontSeeVariableIs($variableName, $expectedValue)
    {
        $variableValue = $this->grabVariable($variableName);

        $this->assertNotEquals($variableName, $expectedValue);
    }
}
