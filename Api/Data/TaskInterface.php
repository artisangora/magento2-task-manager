<?php

namespace Artisangora\Task\Api\Data;


interface TaskInterface
{
    const ENTITY_ID = 'entity_id';
    const TITLE = 'title';
    const CONTENT = 'content';

    /**
     * @return int
     */
    public function getId();


    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     *
     * @return TaskInterface
     */
    public function setTitle(string $title): TaskInterface;

    /**
     * @return string|null
     */
    public function getContent(): ?string;

    /**
     * @param string $content
     *
     * @return TaskInterface
     */
    public function setContent(string $content): TaskInterface;
}