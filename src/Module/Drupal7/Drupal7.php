<?php namespace Codeception\Module\Drupal7;

use Codeception\Exception\DrupalSubmoduleNotFoundException;
use Codeception\Module;
use Codeception\Exception\DrupalNotFoundException;
use Codeception\Module\DrupalBaseModule;
use Codeception\Module\DrupalModuleInterface;

/**
 * Class Drupal
 * @package Codeception\Module
 */
class Drupal7 extends DrupalBaseModule implements DrupalModuleInterface
{

    /**
     * { @inheritdoc }
     */
    public function _initialize()
    {

        $this->bootstrapDrupal();

        $modules = $this->getModulesFromConfig();

        if (!empty($modules)) {
            $this->loadModules($modules);
        }

    }

    /**
     * Actually bootstrap Drupal.
     *
     * @throws \Codeception\Exception\DrupalNotFoundException
     */
    public function bootstrapDrupal()
    {
        $this->config['root'] = $this->getDrupalRoot();

        $this->validateDrupalRoot($this->config['root']);

        // Do a Drush-style bootstrap.
        define('DRUPAL_ROOT', $this->config['root']);

        require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
        drupal_override_server_variables();

        // Bootstrap Drupal.
        drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
    }

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
    public function validateDrupalRoot($root)
    {
        if (!file_exists($root . '/includes/bootstrap.inc')) {
            throw new DrupalNotFoundException('Drupal root incorrect.');
        }

        return true;
    }

    /**
     * Load the submodules that should be included with the test suite.
     *
     * @throws DrupalSubmoduleNotFoundException
     *
     * @param array $modules
     *   The list of Codeception Drupal submodules to be loaded.
     */
    public function loadModules(array $modules = [])
    {
        foreach ($modules as $moduleClassName) {
            if (!class_exists($moduleClassName)) {
                throw new DrupalSubmoduleNotFoundException($moduleClassName . 'not found.');
            }

            $this->getModule($moduleClassName);
        }
    }

    /**
     * Read the list of modules from the configuration file.
     *
     * @see loadModules()
     *
     * @return array
     *   An array of module class names to be passed to loadModules().
     */
    public function getModulesFromConfig()
    {
        // If there weren't any modules added then just return an empty array here.
        if (is_null($this->config['submodules'])) {
            return [];
        }

        $modules = [];

        foreach ($this->config['submodules'] as $subModule) {
            $modules[] = $this->getClassNameForSubModule($subModule);
        }

        return $modules;
    }

    /**
     * Generate the class name used to load a submodule.
     *
     * @param $subModuleName
     *   The submodule name as added in the config file (i.e. entity)
     *
     * @return string
     *   The full class name (i.e. \Codeception\Module\Drupal7\EntitySubModule).
     */
    public function getClassNameForSubModule($subModuleName)
    {
        return '\\Codeception\\Module\\Drupal7\\Submodules\\' . ucfirst($subModuleName) . 'Module';
    }
}
