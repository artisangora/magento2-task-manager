<?php

namespace Artisangora\Task\Model;


use Artisangora\Task\Api\Data\TaskInterface;
use Artisangora\Task\Api\Data\TaskSearchResultsInterface;
use Artisangora\Task\Api\TaskRepositoryInterface;
use Artisangora\Task\Model\ResourceModel\Task\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var TaskFactory
     */
    private $taskFactory;
    /**
     * @var ResourceModel\Task
     */
    private $taskResource;
    /**
     * @var CollectionFactory
     */
    private $taskCollectionFactory;
    /**
     * @var TaskSearchResultFactory
     */
    private $taskSearchResultsFactory;

    public function __construct(
        TaskFactory $taskFactory,
        ResourceModel\Task $taskResource,
        ResourceModel\Task\CollectionFactory $taskCollectionFactory,
        TaskSearchResultFactory $taskSearchResultsFactory
    ){
        $this->taskFactory = $taskFactory;
        $this->taskResource = $taskResource;
        $this->taskCollectionFactory = $taskCollectionFactory;
        $this->taskSearchResultsFactory = $taskSearchResultsFactory;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return TaskSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->taskCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $searchResult = $this->taskSearchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    /**
     * @param TaskInterface $task
     *
     * @return TaskInterface
     * @throws StateException
     * @throws NoSuchEntityException
     */
    public function save(TaskInterface $task)
    {
        try {
            $this->taskResource->save($task);
        } catch (\Exception $exception) {
            throw new StateException(__('Unable to save task #%1', $task->getId()));
        }
        return $this->getById($task->getId());
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws StateException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @param $id
     *
     * @return TaskInterface|null
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $task = $this->taskFactory->create();
        $this->taskResource->load($task, $id);
        if (!$task->getId()) {
            throw new NoSuchEntityException(__('Requested task does not exist'));
        }

        return $task;
    }

    /**
     * @param TaskInterface $task
     *
     * @return bool
     * @throws StateException
     */
    public function delete(TaskInterface $task)
    {
        try {
            $this->taskResource->delete($task);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove task #%1', $task->getId()));
        }

        return true;
    }
}