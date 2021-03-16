Backend Laravel: PHP API backend with Laravel 8 + JWT token
===========================================================

| CI - CD - Coverage | Status |
| ------------------ | ------ |
| Scrutinizer | [![Build Status](https://scrutinizer-ci.com/g/sineverba/backend-laravel/badges/build.png?b=master)](https://scrutinizer-ci.com/g/sineverba/backend-laravel/build-status/master) |
| Scrutinizer Quality Score | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sineverba/backend-laravel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sineverba/backend-laravel/?branch=master) |
| Scrutinizer Code Coverage | [![Code Coverage](https://scrutinizer-ci.com/g/sineverba/backend-laravel/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sineverba/backend-laravel/?branch=master)                 |
| Style CI | [![StyleCI](https://github.styleci.io/repos/348120568/shield?branch=master)](https://github.styleci.io/repos/348120568?branch=master) |

If you like this project or use it, **Star it!**. Your stars motivate developers to continue to develop it.

## Dependencies versions

| Dependency | Version |
| ---------- | ------- |
| PHP | 8 |
| Composer | 2 |
| Laravel | 8 |

## How setup it

```bash
$ cp .env.example .env
$ php artisan key:generate
$ docker-compose build app
$ docker-compose up -d
$ docker-compose exec app composer install
$ docker-compose exec app php artisan key:generate
```

## How to contribute
See `CONTRIBUTING.md` on how to contribute. Every contribute will be fully credited.

## Test
`$ composer test`
