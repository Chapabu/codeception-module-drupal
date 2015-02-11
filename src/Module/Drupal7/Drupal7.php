<?php namespace Codeception\Module\Drupal7;

use Codeception\Exception\DrupalNotFoundException;
use Codeception\Exception\DrupalSubmoduleNotFoundException;
use Codeception\Module;
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
            if (!class_exists($moduleClassName)) {
                throw new DrupalSubmoduleNotFoundException($moduleClassName . 'not found.');
            }

            $this->getModule($moduleClassName);
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
        return '\\Codeception\\Module\\Drupal7\\Submodules\\' . ucfirst($subModuleName) . 'Module';
    }
}
