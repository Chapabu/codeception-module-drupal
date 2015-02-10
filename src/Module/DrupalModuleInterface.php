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
}
