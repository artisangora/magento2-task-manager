<?php

namespace Artisangora\Task\Api\Data;


use Magento\Framework\Api\SearchResultsInterface;

interface TaskSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Artisangora\Task\Api\Data\TaskInterface[]
     */
    public function getItems();

    /**
     * @param \Artisangora\Task\Api\Data\TaskInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}