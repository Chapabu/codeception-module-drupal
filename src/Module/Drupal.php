<?php namespace Codeception\Module;

use Codeception\Module;
use Codeception\Exception\DrupalNotFoundException;

/**
 * Class Drupal
 * @package Codeception\Module
 */
class Drupal extends Module
{

    /**
     * @var array
     */
    protected $config = [
        'root' => null
    ];

    /**
     * { @inheritdoc }
     */
    public function _initialize()
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
     * Get the Drupal root directory.
     *
     * @return string
     *   The root directory of the Drupal installation.
     */
    private function getDrupalRoot()
    {
        // We can't get getcwd() as a default parameter, so this will have to do.
        if (is_null($this->config['root'])) {
            return codecept_root_dir();
        } else {
            // If a user has passed in a path to their Drupal root, then we'll still need to append the current working
            // directory to it.
            return codecept_root_dir($this->config['root']);
        }
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
    private function validateDrupalRoot($root)
    {
        if (!file_exists($root . '/includes/bootstrap.inc')) {
            throw new DrupalNotFoundException('Drupal root incorrect.');
        }

        return true;
    }
}
