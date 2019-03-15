<?php
/**
 * Created by PhpStorm.
 * User: jody
 * Date: 2019-03-10
 * Time: 21:42
 */

namespace App\Infrastructure\Share\Bus;


use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

class QueryBus
{
    use HandleTrait;

    /**
     * QueryBus constructor.
     */
    public function __construct(MessageBusInterface $messengerQueryBus)
    {
        $this->messageBus = $messengerQueryBus;
    }

    /**
     * @param object The query to dispatch.
     *
     * @return mixed The handler returned value.
     */
    public function dispatch($query)
    {
        Assert::endsWith(get_class($query), 'Query');

        return $this->handle($query);
    }
}