<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 21:41
 */

namespace App\Infrastructure\Share\Bus;

use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;


class CommandBus
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    public function __construct(MessageBusInterface $messengerCommandBus)
    {
        $this->commandBus = $messengerCommandBus;
    }

    public function dispatch($command): void
    {
        Assert::endsWith(get_class($command), 'Command');

        $this->commandBus->dispatch($command);
    }
}