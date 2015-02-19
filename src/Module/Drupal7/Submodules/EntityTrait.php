<?php namespace Codeception\Module\Drupal7\Submodules;

use Codeception\Util\Shared\Asserts;

/**
 * Class EntityTrait
 * @package Codeception\Module\Drupal7\Submodules
 */
trait EntityTrait
{
    use Asserts;

    /**
     * Grab the output of entity_get_info().
     *
     * @param null $entityType
     *   The entity type, e.g. node, for which the info shall be returned, or NULL to return an array with info about
     *   all types.
     *
     * @return array
     *   Information about an entity type, or all entities if one was passed in.
     */
    public function grabEntityInfo($entityType = null)
    {
        return entity_get_info($entityType);
    }

    public function seeEntityExists($entityMachineName)
    {
        $entity = $this->grabEntityInfo($entityMachineName);

        $this->assertNotNull($entity);
    }

    public function dontSeeEntityExists($entityMachineName)
    {
        $entity = $this->grabEntityInfo($entityMachineName);

        $this->assertNull($entity);
    }
}
