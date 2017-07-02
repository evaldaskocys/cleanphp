<?php

namespace AppBundle\Event;

use AppBundle\Entity\Task;
use AppBundle\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class TaskAssignedToTest extends Event
{
    const NAME = 'task.assigned_to_test';

    private $task;
    private $assignee;

    public function __construct(Task $task, User $assignee)
    {
        $this->task = $task;
        $this->assignee = $assignee;
    }

    public function getTask()
    {
        return $this->task;
    }

    public function getAssignee()
    {
        return $this->assignee;
    }
}
