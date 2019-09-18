<?php

namespace Artisangora\Task\Api;


use Artisangora\Task\Api\Data\TaskInterface;

interface TaskRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Artisangora\Task\Api\Data\TaskSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \Artisangora\Task\Api\Data\TaskInterface $task
     * @return \Artisangora\Task\Api\Data\TaskInterface
     */
    public function save(\Artisangora\Task\Api\Data\TaskInterface $task);

    /**
     * @param $id
     *
     * @return TaskInterface|null
     */
    public function getById($id);

    /**
     * @param TaskInterface $task
     *
     * @return bool
     */
    public function delete(TaskInterface $task);

    /**
     * @param int $id
     *
     * @return bool
     */
    public function deleteById(int $id);
}