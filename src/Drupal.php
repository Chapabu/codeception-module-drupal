<?php
namespace Codeception\Module;

use Codeception\Module;

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
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

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
            return codecept_root_dir(DIRECTORY_SEPARATOR . $this->config['root']);
        }
    }

    /**
     * Validate the provided path as a Drupal root directory.
     * 
     * ToDo: Throw a better exception that actually means something.
     * ToDo: Decide on a better way to determine Drupal root. Searching for index.php is NOT reliable. 
     *
     * @param string $root
     *   The directory to validate.
     * 
     * @throws \InvalidArgumentException
     *   If the provided path is not a Drupal root, then an exception will be thrown.
     *
     * @return bool
     *   Returns true if the provided path is a Drupal root directory.
     */
    private function validateDrupalRoot($root)
    {
        if (!file_exists($root) . '/index.php')
        {
            // @mToDo: Stub a more descriptive exception for this.
            throw new \InvalidArgumentException('Drupal root incorrect.');
        }

        return true;
    }
}
