<?php namespace Codeception\Module\Drupal7\Submodules;

use Codeception\Module;
use Codeception\Module\Contracts\EntitySubmodule as EntitySubmoduleContract;

class EntitySubModule extends Module implements EntitySubmoduleContract
{

    /**
     * { @inheritdoc }
     */
    public function seeEntityExists($entity)
    {
        // TODO: Implement seeEntityExists() method.
    }

    /**
     * { @inheritdoc }
     */
    public function seeEntityHasBundle($entity, $bundle)
    {
        // TODO: Implement seeEntityHasBundle() method.
    }

    /**
     * { @inheritdoc }
     */
    public function seeEntityHasViewMode($entity, $viewMode)
    {
        // TODO: Implement seeEntityHasViewMode() method.
    }

    /**
     * { @inheritdoc }
     */
    public function grabEntityInfo($entityType = null)
    {
        // TODO: Implement grabEntityInfo() method.
    }
}
