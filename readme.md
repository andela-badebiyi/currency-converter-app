## Currency Converter
This is a simple currency converter app that makes use of the public fixer.io api to make conversions between different currencies.

## Requirements
- PHP ([Official Website](http://php.net))
- Composer ([Official Website](https://getcomposer.org))
- Laravel ([Official Website](https://laravel.com))

## Installation
- Clone repo
- cd into directory and run `composer install`
- navigate to .env file to edit database configuration to your taste
- generate application key by running `php artisan key:generate`
- run migrations by running `php artisan migrate`
- start application with `php artisan serve`

## Tests
- To run unit and functional tests run `phpunit` in the root directory.
- To run end-to-end tests run `php artisan dusk` in the root directory.