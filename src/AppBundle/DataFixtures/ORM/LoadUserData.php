<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('Obi-Wan Kenobi');
        $user->setEmail('jedi@cleanphp.lt');
        $user->setPassword($this->encodePassword($user, 'cleanphp'));
        $user->setRole('ROLE_ADMIN');
        $user->setAccessToken('JEDI');
        $this->addReference('user.obi', $user);
        $manager->persist($user);

        $user = new User();
        $user->setName('Chewbacca');
        $user->setEmail('wookie@cleanphp.lt');
        $user->setPassword($this->encodePassword($user, 'cleanphp'));
        $this->addReference('user.wookie', $user);
        $manager->persist($user);

        $user = new User();
        $user->setName('Yoda');
        $user->setEmail('yoda@cleanphp.lt');
        $user->setPassword($this->encodePassword($user, 'cleanphp'));
        $user->setRole('ROLE_JEDI');
        $user->setAccessToken('MASTER');
        $this->addReference('user.yoda', $user);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

    private function encodePassword(User $user, $pass)
    {
        $encoder = $this->container->get('security.password_encoder');
        return $encoder->encodePassword($user, $pass);
    }
}
