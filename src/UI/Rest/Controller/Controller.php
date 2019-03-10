<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-08
 * Time: 11:21
 */

namespace App\UI\Rest\Controller;


use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class Controller
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var MessageBusInterface
     */
    protected $commandBus;

    /**
     * @var MessageBusInterface
     */
    protected $queryBus;

    /**
     * SignUpController constructor.
     * @param SerializerInterface $serializer
     * @param MessageBusInterface $commandBus
     * @param MessageBusInterface $queryBus
     */
    public function __construct(SerializerInterface $serializer, MessageBusInterface $commandBus, MessageBusInterface $queryBus)
    {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param array $context
     * @return object
     */
    public function deserialize($data, string $type, array $context = [])
    {
        return $this->serializer->deserialize($data, $type, 'json', $context);
    }

    /**
     * @param mixed $data
     * @param array $context
     * @return string
     */
    public function serialize($data, array $context = []): string
    {
        return $this->serializer->serialize($data, 'json', $context);
    }
}