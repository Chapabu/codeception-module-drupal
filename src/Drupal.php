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
     * @param array $config
     */
    function _initialize($config)
    {
        // We can't get getcwd() as a default parameter, so this will have to do.
        if (is_null($this->config['root'])) {
            $this->config['root'] = getcwd();
        } else {
            $this->config['root'] = getcwd() . DIRECTORY_SEPARATOR . $this->config['root'];
        }

        // Do a Drush-style bootstrap.
        define('DRUPAL_ROOT', $this->config['root']);
        require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        // Bootstrap Drupal.
        drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
    }


}
