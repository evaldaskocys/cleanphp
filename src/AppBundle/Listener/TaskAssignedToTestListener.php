<?php

namespace AppBundle\Listener;

use AppBundle\Event\TaskAssignedToTest;
use Swift_Mailer;
use Symfony\Component\Templating\EngineInterface;

class TaskAssignedToTestListener
{
    private $mailer;
    private $templating;

    public function __construct(Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function onTaskAssignedToTest(TaskAssignedToTest $event)
    {
        $task = $event->getTask();
        $assignee = $event->getAssignee();

        if ($email = $assignee->getEmail()) {

            $body = $this->templating->render(
                'emails/task_assigned_to_test.html.twig',
                [
                    'task' => $task,
                    'assignee' => $assignee,
                ]
            );

            $message = \Swift_Message::newInstance()
                ->setSubject('User Created')
                ->setFrom('notifications@cleanphp.lt')
                ->setTo($email)
                ->setBody($body, 'text/plain');
        }
    }
}
