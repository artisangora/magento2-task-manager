<?php

namespace Artisangora\Task\Model\ResourceModel\Task;


use Artisangora\Task\Api\Data\TaskInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = TaskInterface::ENTITY_ID;


    protected function _construct()
    {
        $this->_init(\Artisangora\Task\Model\Task::class, \Artisangora\Task\Model\ResourceModel\Task::class);
    }
}