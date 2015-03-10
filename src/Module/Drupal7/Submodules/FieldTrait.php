<?php namespace Codeception\Module\Drupal7\Submodules;

use Codeception\Util\Shared\Asserts;

/**
 * Class FieldTrait
 * @package Codeception\Module\Drupal7\Submodules
 */
trait FieldTrait
{

    use Asserts;

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
     * Check that a field base exists.
     *
     * @param $fieldName
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
     * @param $fieldName
     *   The field name you are looking for (i.e. field_image).
     */
    public function dontSeeFieldExists($fieldName)
    {
        $fieldList = $this->grabFieldList();

        $this->assertNotContains($fieldName, array_keys($fieldList));
    }
}
