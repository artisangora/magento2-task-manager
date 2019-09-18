<?php

namespace Artisangora\Task\Block;


use Artisangora\Task\Model\ResourceModel\Task\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Index extends Template
{

    /**
     * @var CollectionFactory
     */
    private $taskCollectionFactory;

    public function __construct(CollectionFactory $taskCollectionFactory, Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->taskCollectionFactory = $taskCollectionFactory;
    }

    /**
     * @return \Magento\Framework\DataObject[]
     */
    public function getTasks()
    {
        $task = $this->taskCollectionFactory->create();

        return $task->getItems();
    }
}