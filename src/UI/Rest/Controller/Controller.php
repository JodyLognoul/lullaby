<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-08
 * Time: 11:21
 */

namespace App\UI\Rest\Controller;


use App\Infrastructure\Share\Bus\CommandBus;
use App\Infrastructure\Share\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

abstract class Controller extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @var QueryBus
     */
    protected $queryBus;

    /**
     * SignUpController constructor.
     * @param SerializerInterface $serializer
     * @param CommandBus $commandBus
     * @param QueryBus $queryBus
     */
    public function __construct(SerializerInterface $serializer, CommandBus $commandBus, QueryBus $queryBus)
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
    public function serialize($data, $format = 'json', array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }
}