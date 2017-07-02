<?php

namespace spec\AppBundle\Serializer;

use AppBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NewUserApiSerializerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Serializer\NewUserApiSerializer');
    }

    function it_serializes_user_entity_to_array()
    {
        $name = 'Petras';
        $phone = '+37060012345';

        $user = new User();
        $user->setName($name)
            ->setPhone($phone);

        $this->serialize($user)->shouldReturn([
            'name' => $name,
            'phone' => $phone,
        ]);
    }

    function it_serializes_another_user_entity_to_array()
    {
        $name = 'Tomas';
        $phone = '+37060012346';

        $user = new User();
        $user->setName($name)
            ->setPhone($phone);

        $this->serialize($user)->shouldReturn([
            'name' => $name,
            'phone' => $phone,
        ]);
    }
}
