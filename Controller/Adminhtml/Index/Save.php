<?php

namespace Artisangora\Task\Controller\Adminhtml\Index;


use Artisangora\Task\Model\TaskFactory;
use Artisangora\Task\Model\TaskRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;


class Save extends Action
{

    /**
     * @var TaskFactory
     */
    private $taskFactory;
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @param Context        $context
     * @param TaskFactory    $taskFactory
     * @param TaskRepository $taskRepository
     */
    public function __construct(Context $context, TaskFactory $taskFactory, TaskRepository $taskRepository)
    {
        $this->taskFactory = $taskFactory;
        $this->taskRepository = $taskRepository;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\StateException
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getParams();

        if (!$data) {
            $this->messageManager->addErrorMessage(__('Data was not provided'));
            return $resultRedirect->setPath('*/*/');
        }

        $task = $this->taskFactory->create();
        $task->setTitle($data['title']);
        $task->setContent($data['content']);
        //TODO: Catch possible exceptions
        $this->taskRepository->save($task);
        $this->messageManager->addSuccessMessage(__('Task was created'));

        return $resultRedirect->setPath('*/*/');

    }
}