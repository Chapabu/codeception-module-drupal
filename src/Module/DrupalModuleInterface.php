<?php namespace Codeception\Module;

use Codeception\Exception\DrupalNotFoundException;

/**
 * Class Drupal
 * @package Codeception\Module
 */
interface DrupalModuleInterface
{

    /**
     * Get the Drupal root directory.
     *
     * @return string
     *   The root directory of the Drupal installation.
     */
    public function getDrupalRoot();

    /**
     * Validate the provided path as a Drupal root directory.
     *
     * @param string $root
     *   The directory to validate.
     *
     * @throws DrupalNotFoundException
     *   If the provided path is not a Drupal root, then an exception will be thrown.
     *
     * @return bool
     *   Returns true if the provided path is a Drupal root directory.
     */
    public function validateDrupalRoot($root);

    /**
     * Actually bootstrap Drupal.
     *
     * @throws \Codeception\Exception\DrupalNotFoundException
     */
    public function bootstrapDrupal();

    /**
     * Load the submodules that should be included with the test suite.
     *
     * @throws \Codeception\Exception\DrupalSubmoduleNotFoundException
     *
     * @param array $modules
     *   The list of full classnames fod Codeception Drupal submodules to be loaded.
     */
    public function loadModules(array $modules = []);

    /**
     * Read the list of modules from the configuration file.
     *
     * @see loadModules()
     *
     * @return array
     *   An array of module class names to be passed to loadModules().
     */
    public function getModulesFromConfig();

    /**
     * Generate the class name used to load a submodule.
     *
     * @param $subModuleName
     *   The submodule name as added in the config file (i.e. entity)
     *
     * @return string
     *   The full class name (i.e. \Codeception\Module\Drupal7\EntitySubModule).
     */
    public function getClassNameForSubModule($subModuleName);
}
