<?php namespace Codeception\Module\Drupal7;

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
}
