<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Domain\Bus\Query;
use App\Shared\Domain\Bus\QueryBus;
use App\Shared\Domain\Bus\Response;
use InvalidArgumentException;
use ReflectionException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class QueryBusSymphonyMessenger implements QueryBus
{
    /**
     * @throws ReflectionException
     */
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    public function ask(Query $query): Response|null
    {
        try {
            /** @var HandledStamp $stamp */
            $stamp = $this->bus->dispatch($query)->last(HandledStamp::class);

            return $stamp->getResult();
        } catch (NoHandlerForMessageException $e) {
            throw new InvalidArgumentException(sprintf('The query has not a valid handler: %s', $query::class));
        }
    }
}
