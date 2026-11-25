# Laravel Domain Events


A framework-friendly implementation of recorded domain events for Laravel 13. An aggregate records business facts, and an application service publishes them through Laravel's event dispatcher after persistence.


## Features


- Event recording inside domain aggregates
- Each recorded event released exactly once
- Laravel Dispatcher contract integration
- Business rules independent from infrastructure
- PHPUnit coverage


## Install and test


Run composer install and composer test.


For guaranteed external delivery, combine domain events with a transactional outbox instead of dispatching to a broker inside a database transaction.


## Add this to an existing Laravel project

1. Copy `RecordsDomainEvents.php`, `DomainEventPublisher.php`, and the relevant event classes from `src/` into `app/Domain/`.
2. Change their namespaces from `JawadAhmed\DomainEvents` to your application's domain namespace.
3. Add the `RecordsDomainEvents` trait to an aggregate and call `record()` whenever a completed business operation creates a domain fact.
4. Create immutable event objects containing the identifiers and values listeners require. Avoid placing full Eloquent models or secrets in an event payload.
5. Persist the aggregate inside a database transaction. Publish its recorded events only after the write commits successfully.
6. Inject `DomainEventPublisher` into the application service and call `publish($aggregate)` once. Releasing the events clears them so they are not published twice in the same process.
7. Register Laravel listeners for each event with attributes, discovery, or your event service provider. Queue slow listeners and enable after-commit dispatch when they depend on committed records.
8. Use a transactional outbox when an event must reliably reach an external broker or service despite process failure.
9. Copy `tests/DomainEventPublisherTest.php` into your test suite, update its namespace and imports, and run `php artisan test`.
10. Test that the business operation records the correct event, publishing dispatches it once, and a failed transaction does not trigger external work.

## Requirements


- PHP 8.3+
- Laravel components 13.x


## License


MIT

