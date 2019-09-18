<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Overview

Diary Tag Laravel application, initial build.

## Launching Docker

- `docker-compose up -d`
- `docker-compose www composer update`
- `docker-compose www php artisan migrate`

## Compiling Assets

- `docker-compose exec www npm install`
- `docker-compose exec www npx audiosprite -f howler2 -o public/audio/audiosprites -u /audio resources/audio/*.wav`
- `docker-compose exec www npm run prod`

To watch assets in development (with hot reloading):

- `docker-compose exec www npm run watch`
