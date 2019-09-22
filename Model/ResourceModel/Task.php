<?php

namespace Artisangora\Task\Model\ResourceModel;


use Artisangora\Task\Api\Data\TaskInterface;
use Artisangora\Task\Setup\InstallSchema;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Task extends AbstractDb
{
    protected $_idFieldName = TaskInterface::ENTITY_ID;

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(InstallSchema::TABLE, TaskInterface::ENTITY_ID);
    }
}