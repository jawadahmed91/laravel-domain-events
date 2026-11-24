<?php

declare(strict_types=1);

namespace JawadAhmed\DomainEvents;

use DateTimeImmutable;
use DomainException;

final class Order
{
    use RecordsDomainEvents;

    private bool $paid = false;

    public function __construct(public readonly int $id, public readonly int $totalInCents) {}

    public function markPaid(?DateTimeImmutable $paidAt = null): void
    {
        if ($this->paid) {
            throw new DomainException('The order has already been paid.');
        }
        $this->paid = true;
        $this->record(new OrderPaid($this->id, $this->totalInCents, $paidAt ?? new DateTimeImmutable()));
    }

    public function isPaid(): bool
    {
        return $this->paid;
    }
}
