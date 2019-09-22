<?php

namespace Artisangora\Task\Model;


use Artisangora\Task\Api\Data\TaskInterface;
use Artisangora\Task\Setup\InstallSchema;
use Magento\Framework\Model\AbstractModel;

class Task extends AbstractModel implements TaskInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = InstallSchema::TABLE;

    /**
     * @var string
     */
    protected $_cacheTag = InstallSchema::TABLE;

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = InstallSchema::TABLE
    ;

    protected function _construct()
    {
        $this->_init(\Artisangora\Task\Model\ResourceModel\Task::class);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @param string $title
     *
     * @return TaskInterface
     */
    public function setTitle(string $title): TaskInterface
    {
        $this->setData(self::TITLE, $title);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @param string $content
     *
     * @return TaskInterface
     */
    public function setContent(string $content): TaskInterface
    {
        $this->setData(self::CONTENT, $content);
        return $this;
    }

}