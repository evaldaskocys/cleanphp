<?php

namespace AppBundle\Service;

use AppBundle\Serializer\UserApiSerializer;
use AppBundle\Entity\User;

/**
 * Class UserService
 *
 * @package AppBundle\Service
 */
class UserService
{
    /**
     * @var UserApiSerializer
     */
    private $serializer;

    /**
     * UserService constructor.
     *
     * @param UserApiSerializer $serializer
     */
    public function __construct(UserApiSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize(User $user)
    {
        return $this->serializer->serialize($user);
    }
}
