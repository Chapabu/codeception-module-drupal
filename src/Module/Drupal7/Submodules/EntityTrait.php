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

    /**
     * Check that an entity type exists.
     *
     * @param string $entityMachineName
     *   The machine name of the entity you are testing for (i.e. node)
     */
    public function seeEntityExists($entityMachineName)
    {
        $entity = $this->grabEntityInfo($entityMachineName);

        $this->assertNotNull($entity);
    }

    /**
     * Check that an entity type does not exist.
     *
     * @param string $entityMachineName
     *   The machine name of the entity you are testing for (i.e. node)
     */
    public function dontSeeEntityExists($entityMachineName)
    {
        $entity = $this->grabEntityInfo($entityMachineName);

        $this->assertNull($entity);
    }

    /**
     * Check that an entity type has a specific bundle.
     *
     * @param $entityMachineName
     *    The machine name of the entity you are testing (i.e. node)
     * @param $bundleMachineName
     *    The machine name of the bundle you are testing for (i.e. article)
     */
    public function seeEntityHasBundle($entityMachineName, $bundleMachineName)
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        if (array_key_exists($bundleMachineName, $entityInfo['bundles'])) {
            return true;
        }

        $failMessage = 'Bundle ' . $bundleMachineName . ' does not exist on the ' . $entityMachineName . ' entity.';

        return $this->fail($failMessage);
    }

    /**
     * Check that an entity type does not have a specific bundle.
     *
     * @param $entityMachineName
     *    The machine name of the entity you are testing (i.e. node)
     * @param $bundleMachineName
     *    The machine name of the bundle you are testing for (i.e. article)
     */
    public function dontSeeEntityHasBundle($entityMachineName, $bundleMachineName)
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        if (!array_key_exists($bundleMachineName, $entityInfo['bundles'])) {
            return true;
        }

        $failMessage = 'Bundle ' . $bundleMachineName . ' exists on the ' . $entityMachineName . ' entity.';

        return $this->fail($failMessage);
    }
}
