<?php

declare(strict_types=1);

namespace JawadAhmed\DomainEvents;

trait RecordsDomainEvents
{
    private array $recordedEvents = [];

    final protected function record(object $event): void
    {
        $this->recordedEvents[] = $event;
    }

    final public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }
}
