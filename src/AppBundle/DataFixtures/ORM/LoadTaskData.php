<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Task;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTaskData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $task = new Task();
        $task->setTitle('Send message to the Galaxy');
        $task->setAuthor($this->getReference('user.yoda'));
        $task->setAssignee($this->getReference('user.obi'));

        $manager->persist($task);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
