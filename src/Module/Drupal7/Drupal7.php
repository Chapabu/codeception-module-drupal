<?php namespace Codeception\Module\Drupal7;

use Codeception\Exception\DrupalNotFoundException;
use Codeception\Exception\DrupalSubmoduleNotFoundException;
use Codeception\Module;
use Codeception\Module\DrupalBaseModule;
use Codeception\Module\DrupalModuleInterface;
use Codeception\SuiteManager;

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
     * { @inheritdoc }
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
     * { @inheritdoc }
     */
    public function validateDrupalRoot($root)
    {
        if (!file_exists($root . '/includes/bootstrap.inc')) {
            throw new DrupalNotFoundException('Drupal root incorrect.');
        }

        return true;
    }

    /**
     * { @inheritdoc }
     */
    public function loadModules(array $modules = [])
    {
        foreach ($modules as $moduleClassName) {
            // If the class doesn't exist, then we want to throw an exception right away.
            if (!class_exists($moduleClassName)) {
                throw new DrupalSubmoduleNotFoundException($moduleClassName . ' not found.');
            }

            // Reflect on the class we've reached...
            $moduleReflection = new \ReflectionClass($moduleClassName);

            // ...and ensure it's actually a Codeception module.
            if ($moduleReflection->getParentClass()->getName() === 'Codeception\Module') {
                // We want to remove the slash from the beginning of the class name for the array key.
                $trimmedClassName = trim($moduleClassName, '\\');

                // Ensure that the current test suite knows about our new modules, and then initialise them.
                SuiteManager::$modules[$trimmedClassName] = new $moduleClassName;
                SuiteManager::$modules[$trimmedClassName]->_initialize();
            }
        }
    }

    /**
     * { @inheritdoc }
     */
    public function getModulesFromConfig()
    {
        // If there weren't any modules added then just return an empty array here.
        if (is_null($this->config['submodules'])) {
            return [];
        }

        $modules = [];

        // Loop over each module option and get an actual class name.
        foreach ($this->config['submodules'] as $subModule) {
            $modules[] = $this->getClassNameForSubModule($subModule);
        }

        return $modules;
    }

    /**
     * { @inheritdoc }
     */
    public function getClassNameForSubModule($subModuleName)
    {
        return '\\Codeception\\Module\\Drupal7\\Submodules\\' . ucfirst($subModuleName) . 'SubModule';
    }
}
