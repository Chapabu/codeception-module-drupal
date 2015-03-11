<?php namespace Codeception\Module\Drupal7\Submodules;

/**
 * Class FieldTrait
 * @package Codeception\Module\Drupal7\Submodules
 */
trait FieldTrait
{

    /**
     * Grab a list of all fields.
     *
     * This is simply a wrapper around field_info_field_map().
     *
     * @return array
     *   Information about an entity type, or all entities if one was passed in.
     */
    public function grabFieldList()
    {
        // Drupal 7 prior to 7.22 doesn't have the field_info_field_map function, so we need to manually implement if
        // if it doesn't exist. We could just use fallback, but I'd rather stick with core functions where I can.
        if (function_exists('field_info_field_map')) {
            return field_info_field_map();
        }

        // ToDo: Double check that this will work in Drupal 7 < 7.22
        $cache = _field_info_field_cache();
        return $cache->getFieldMap();
    }

    /**
     * Grab the information about a field instance attached to a bundle.
     *
     * This is simple a wrapper around field_info_instance.
     *
     * @param string $entityType
     *   The entity type the bundle is attached to.
     * @param string $fieldName
     *   The field name (i.e. field_image)
     * @param string $bundleName
     *   The bundle name you are looking on.
     * @return array|null
     *   An array containing the output of field_info_instance or null if the field instance doesn't exist.
     */
    public function grabFieldInstance($entityType, $fieldName, $bundleName)
    {
        return field_info_instance($entityType, $fieldName, $bundleName);
    }

    /**
     * Check that a field base exists.
     *
     * @param string $fieldName
     *   The field name you are looking for (i.e. field_image).
     */
    public function seeFieldExists($fieldName)
    {
        $fieldList = $this->grabFieldList();

        $this->assertContains($fieldName, array_keys($fieldList));
    }

    /**
     * Check that a field base does not exist.
     *
     * @param string $fieldName
     *   The field name you are looking for (i.e. field_image).
     */
    public function dontSeeFieldExists($fieldName)
    {
        $fieldList = $this->grabFieldList();

        $this->assertNotContains($fieldName, array_keys($fieldList));
    }

    /**
     * Check that an entity bundle has a field instance attached.
     *
     * @param string $entityType
     *   The entity type the bundle is attached to.
     * @param string $fieldName
     *   The field name (i.e. field_image)
     * @param string $bundleName
     *   The bundle name you are looking on.
     *
     * @return void
     */
    public function seeBundleHasField($entityType, $fieldName, $bundleName)
    {
        $fieldInfo = $this->grabFieldInstance($entityType, $fieldName, $bundleName);

        $this->assertNotNull($fieldInfo);
    }

    /**
     * Check that an entity bundle does not have a field instance attached.
     *
     * @param string $entityType
     *   The entity type the bundle is attached to.
     * @param string $fieldName
     *   The field name (i.e. field_image)
     * @param string $bundleName
     *   The bundle name you are looking on.
     *
     * @return void
     */
    public function dontSeeBundleHasField($entityType, $fieldName, $bundleName)
    {
        $fieldInfo = $this->grabFieldInstance($entityType, $fieldName, $bundleName);

        $this->assertNull($fieldInfo);
    }
}
