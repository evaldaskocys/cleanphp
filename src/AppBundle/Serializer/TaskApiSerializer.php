<?php

namespace AppBundle\Serializer;

use AppBundle\Entity\Task;

/**
 * Class TaskSerializer
 *
 * @package AppBundle\Serializer
 */
class TaskApiSerializer
{
    /**
     * @param Task $task
     * @return array
     */
    public function serialize(Task $task)
    {
        return [
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'status' => $task->getStatus(),
            'priority' => $task->getPriority(),
            'dateCreated' => $task->getDateCreated()->format(\DateTime::ISO8601),
            'dateUpdated' => ($task->getDateUpdated()) ? $task->getDateUpdated()->format(\DateTime::ISO8601) : null,
            'author' => (string) $task->getAuthor(),
            'assignee' => (string) $task->getAssignee(),
        ];
    }
}
