<?php

namespace AppBundle\Serializer;

use AppBundle\Entity\User;

class NewUserApiSerializer
{
    public function serialize(User $user)
    {
        return [
            'name' => $user->getName(),
            'phone' => $user->getPhone(),
        ];
    }
}
