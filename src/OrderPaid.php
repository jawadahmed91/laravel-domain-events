<?php

declare(strict_types=1);

namespace JawadAhmed\DomainEvents;

use DateTimeImmutable;

final readonly class OrderPaid
{
    public function __construct(public int $orderId, public int $amountInCents, public DateTimeImmutable $occurredAt) {}
}
