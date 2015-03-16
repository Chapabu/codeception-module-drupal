<?php namespace Codeception\Module\Drupal7\Submodules;

/**
 * Class EntityTrait
 * @package Codeception\Module\Drupal7\Submodules
 */
trait EntityTrait
{

    use AssertMethodHelperTrait;

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
     *
     * @return bool|void
     *     Will return true if test passes or void if it fails.
     */
    public function seeEntityHasBundle($entityMachineName, $bundleMachineName)
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        $this->assertContains($bundleMachineName, array_keys($entityInfo['bundles']));
    }

    /**
     * Check that an entity type does not have a specific bundle.
     *
     * @param $entityMachineName
     *    The machine name of the entity you are testing (i.e. node)
     * @param $bundleMachineName
     *    The machine name of the bundle you are testing for (i.e. article)
     *
     * @return bool|void
     *     Will return true if test passes or void if it fails.
     */
    public function dontSeeEntityHasBundle($entityMachineName, $bundleMachineName)
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        $this->assertNotContains($bundleMachineName, array_keys($entityInfo['bundles']));
    }

    /**
     * Check that an entity type has a base field.
     *
     * @param string $entityMachineName
     *    The machine name of the entity you are testing (i.e. node)
     * @param string $baseField
     *    The name of the base field you are looking for.
     * @param string $schemaKey
     *    The key of the array item that contains the entity base fields.
     */
    public function seeEntityHasBaseField($entityMachineName, $baseField, $schemaKey = 'schema_fields_sql')
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        $this->assertContains($baseField, array_values($entityInfo[$schemaKey]['base table']));
    }

    /**
     * Check that an entity type does not have a base field.
     *
     * @param string $entityMachineName
     *    The machine name of the entity you are testing (i.e. node)
     * @param string $baseField
     *    The name of the base field you are looking for.
     * @param string $schemaKey
     *    The key of the array item that contains the entity base fields.
     */
    public function dontSeeEntityHasBaseField($entityMachineName, $baseField, $schemaKey = 'schema_fields_sql')
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        $this->assertNotContains($baseField, array_values($entityInfo[$schemaKey]['base table']));
    }

    /**
     * Check that an entity type has a view mode assigned.
     *
     * @param string $entityMachineName
     *    The machine name of the entity you are testing (i.e. node)
     * @param string $viewModeMachineName
     *    The machine name of the view mode you are looking for (i.e. teaser)
     */
    public function seeEntityHasViewMode($entityMachineName, $viewModeMachineName)
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        $this->assertContains($viewModeMachineName, array_keys($entityInfo['view modes']));
    }

    /**
     * Check that an entity type doesn't have a specific view mode assigned.
     *
     * @param string $entityMachineName
     *    The machine name of the entity you are testing (i.e. node)
     * @param string $viewModeMachineName
     *    The machine name of the view mode you are looking for (i.e. teaser)
     */
    public function dontSeeEntityHasViewMode($entityMachineName, $viewModeMachineName)
    {
        $entityInfo = $this->grabEntityInfo($entityMachineName);

        $this->assertNotContains($viewModeMachineName, array_keys($entityInfo['view modes']));
    }
}
