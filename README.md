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

## Requirements

- PHP 8.3+
- Laravel components 13.x

## License

MIT
