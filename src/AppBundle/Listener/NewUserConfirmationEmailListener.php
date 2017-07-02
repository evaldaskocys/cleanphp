<?php

namespace AppBundle\Listener;

use AppBundle\Event\UserCreated;
use Swift_Mailer;

class NewUserConfirmationEmailListener
{
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onUserCreated(UserCreated $event)
    {
        $user = $event->getUser();
        if ($email = $user->getEmail()) {
            $body = "Labas";
            $message = \Swift_Message::newInstance()
                ->setSubject('User Created')
                ->setFrom('notifications@cleanphp.lt')
                ->setTo($email)
                ->setBody($body, 'text/plain');
        }
    }
}
