<?php

namespace AppBundle\Service;

use AppBundle\Serializer\TaskApiSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class BaseService
 *
 * @package AppBundle\Service
 */
class BaseService
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * BaseService constructor.
     */
    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher
    ) {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param TaskApiSerializer $serializer
     */
    public function setSerializer(TaskApiSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function serialize($data)
    {
        return $this->serializer->serialize($data);
    }
}
