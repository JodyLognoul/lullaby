<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-15
 * Time: 23:21
 */

namespace App\UI\Web\Controller;


use App\Infrastructure\Share\Bus\CommandBus;
use App\Infrastructure\Share\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Controller extends AbstractController
{
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
     * @param CommandBus $commandBus
     * @param QueryBus $queryBus
     */
    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }
}