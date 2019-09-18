<?php

namespace Artisangora\Task\Model\ResourceModel\Task;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Artisangora\Task\Model\Task::class, \Artisangora\Task\Model\ResourceModel\Task::class);
    }
}