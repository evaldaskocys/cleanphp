<?php

namespace AppBundle\Serializer;

use AppBundle\Entity\User;

/**
 * Class UserApiSerializer
 *
 * @package AppBundle\Serializer
 */
class UserApiSerializer
{
    /**
     * @param User $user
     * @return array
     */
    public function serialize(User $user)
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'phone' => $user->getPhone(),
            'email' => $user->getEmail(),
        ];
    }
}
