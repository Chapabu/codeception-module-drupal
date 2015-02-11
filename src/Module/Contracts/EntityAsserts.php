<?php namespace Codeception\Module\Drupal7\Contracts;

/**
 * Interface EntitySubmodule
 * @package Codeception\Module\Drupal7\Contracts
 */
interface EntitySubmodule
{
    /**
     * Checks that an entity exists.
     *
     * @param string $entity
     *   The machine name of an entity (i.e. node, user, taxonomy_term)
     */
    public function seeEntityExists($entity);

    /**
     * Checks that an entity type has a specific bundle.
     *
     * @param $entity
     *   The machine name of an entity (i.e. node, user, taxonomy_term)
     *
     * @param $bundle
     *   The machine name of the bundle to be checked for on the entity (i.e. you may want to check for an article
     *   bundle on a Node entity.
     */
    public function seeEntityHasBundle($entity, $bundle);


    /**
     * Checks that an entity type has a specific view mode.
     *
     * @param $entity
     *   The machine name of an entity (i.e. node, user, taxonomy_term)
     *
     * @param $viewMode
     *   The machine name of the view mode to be check for on the entity.
     */
    public function seeEntityHasViewMode($entity, $viewMode);


    /**
     * Get the entity info array of an entity type. This is simple a wrapper around Drupal's entity_get_info().
     *
     * @param null|string $entityType
     *   The entity type, e.g. node, for which the info shall be returned, or NULL
     *   to return an array with info about all types.
     *
     * @return array|null
     *   An array of entity metadata for either a single entity type or all entities. Will return null if an
     *   unrecognised entity is passed as an argument.
     */
    public function grabEntityInfo($entityType = null);
}
