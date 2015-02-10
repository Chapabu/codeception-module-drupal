<?php namespace Codeception\Module;

use Codeception\Module;

abstract class DrupalBaseModule extends Module
{
    /**
     * @var array
     */
    protected $config = [
      'root' => null
    ];

    /**
     * Get the Drupal root directory.
     *
     * @return string
     *   The root directory of the Drupal installation.
     */
    public function getDrupalRoot()
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
}
