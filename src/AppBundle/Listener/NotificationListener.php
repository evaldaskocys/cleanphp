<?php

namespace AppBundle\Listener;

use AppBundle\Event\TaskCreated;
use Symfony\Component\Templating\EngineInterface;
use Swift_Mailer;

class NotificationListener
{
    private $mailer;
    private $templating;

    public function __construct(Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function onTaskCreated(TaskCreated $event)
    {
        $task = $event->getTask();
        if ($assignee = $task->getAssignee()) {
            $body = $this->templating->render(
                'emails/task_created.html.twig',
                [
                    'task' => $task,
                    'assignee' => $assignee,
                ]
            );
            $message = \Swift_Message::newInstance()
                ->setSubject('Task Created')
                ->setFrom('notifications@cleanphp.lt')
                ->setTo($assignee->getEmail())
                ->setBody($body, 'text/html');
        }
    }
}
