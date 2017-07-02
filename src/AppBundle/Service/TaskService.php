<?php

namespace AppBundle\Service;

use AppBundle\Entity\Task;
use AppBundle\Event\TaskCreated;

/**
 * Class TaskService
 *
 * @package AppBundle\Service
 */
class TaskService extends BaseService
{
    public function create(Task $task)
    {
        $this->em->persist($task);
        $this->em->flush();

        $event = new TaskCreated($task);
        $this->dispatcher->dispatch($event::NAME, $event);

    }
}
