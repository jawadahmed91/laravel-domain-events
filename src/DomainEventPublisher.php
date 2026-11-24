<?php

declare(strict_types=1);

namespace JawadAhmed\DomainEvents;

use Illuminate\Contracts\Events\Dispatcher;

final class DomainEventPublisher
{
    public function __construct(private readonly Dispatcher $events) {}

    public function publish(object $aggregate): int
    {
        if (! method_exists($aggregate, 'releaseEvents')) {
            return 0;
        }
        $recordedEvents = $aggregate->releaseEvents();
        foreach ($recordedEvents as $event) {
            $this->events->dispatch($event);
        }
        return count($recordedEvents);
    }
}
