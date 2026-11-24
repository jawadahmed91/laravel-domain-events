<?php

declare(strict_types=1);

namespace Tests;

use DateTimeImmutable;
use DomainException;
use Illuminate\Contracts\Events\Dispatcher;
use JawadAhmed\DomainEvents\DomainEventPublisher;
use JawadAhmed\DomainEvents\Order;
use JawadAhmed\DomainEvents\OrderPaid;
use PHPUnit\Framework\TestCase;

final class DomainEventPublisherTest extends TestCase
{
    public function test_it_publishes_recorded_events_once(): void
    {
        $paidAt = new DateTimeImmutable('2026-11-24T09:30:00+05:00');
        $order = new Order(42, 12900);
        $order->markPaid($paidAt);
        $dispatcher = $this->createMock(Dispatcher::class);
        $dispatcher->expects(self::once())->method('dispatch')->with(self::callback(fn (object $event): bool => $event instanceof OrderPaid && $event->orderId === 42));
        $publisher = new DomainEventPublisher($dispatcher);
        self::assertSame(1, $publisher->publish($order));
        self::assertSame(0, $publisher->publish($order));
        self::assertTrue($order->isPaid());
    }

    public function test_an_order_cannot_be_paid_twice(): void
    {
        $order = new Order(7, 5000);
        $order->markPaid();
        $this->expectException(DomainException::class);
        $order->markPaid();
    }
}
