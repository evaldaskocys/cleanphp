<?php

namespace AppBundle\Event;

use AppBundle\Entity\Task;
use Symfony\Component\EventDispatcher\Event;

class TaskCreated extends Event
{
    const NAME = 'task.created';

    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getTask()
    {
        return $this->task;
    }
}
