<p align="center"><img src="https://webdecero.com/Pages/assets/img/logo-webdecero.svg"></p>

# Webcms CMS (Laravel + MongoDB + Vuejs)

[![Latest Stable Version](http://img.shields.io/github/release/jenssegers/laravel-mongodb.svg)](https://packagist.org/packages/jenssegers/mongodb) [![Total Downloads](http://img.shields.io/packagist/dm/jenssegers/mongodb.svg)](https://packagist.org/packages/jenssegers/mongodb) [![Build Status](http://img.shields.io/travis/jenssegers/laravel-mongodb.svg)](https://travis-ci.org/jenssegers/laravel-mongodb) [![Coverage Status](http://img.shields.io/coveralls/jenssegers/laravel-mongodb.svg)](https://coveralls.io/r/jenssegers/laravel-mongodb?branch=master) [![Donate](https://img.shields.io/badge/donate-paypal-blue.svg)](https://www.paypal.me/jenssegers)

CMS Drag&Drop whith Laravel, Vue.js, MongoDB combination _This library extends the original Laravel classes._

## Table of contents

-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Install Artisan Commands](#Install-Artisan-Commands)
-   [Examples](#examples)

## Installation

Make sure you have the MongoDB PHP driver installed. You can find installation instructions at http://php.net/manual/en/mongodb.installation.php

**WARNING**: The old mongo PHP driver is not supported.

### Laravel version Compatibility

| Laravel | Package |
| :------ | :------ |
| 8.x     | 0.1.x   |

Installation using composer:

```
composer require webdecero/web-cms
```

Add the service provider to `config/app.php`:

```php
Webdecero\Webcms\CMSServiceProvider::class,
```

## Configuration

In this new major release which supports the new mongodb PHP extension, we also moved the location of the Model class and replaced the MySQL model class with a trait.

### Env File

```

DB_CONNECTION=mongodb
DB_HOST=localhost
DB_AUTHENTICATION_DATABASE=**your database authentication, for global authentication use admin**
DB_DATABASE=**your database**
DB_USERNAME=**your username**
DB_PASSWORD=**your password**
DB_PORT=27017

```

### Edit config file database.php

Change your default database connection name in `config/database.php`:

And add a new mongodb connection:

```php
'mongodb' => [
    'driver' => 'mongodb',
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', 27017),
    'database' => env('DB_DATABASE', 'homestead'),
    'username' => env('DB_USERNAME', 'homestead'),
    'password' => env('DB_PASSWORD', 'secret'),
    'options' => [
        // here you can pass more settings to the Mongo Driver Manager
        // see https://www.php.net/manual/en/mongodb-driver-manager.construct.php under "Uri Options" for a list of complete parameters that you can use
        'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
    ]
],
```

### Edit config file auth.php

Change your default database connection name in `config/auth.php`:

**Add Authentication Guards**

```php
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false

        ],
        'admin' => [
            'driver' => 'passport',
            'provider' => 'admin',
            'hash' => true
        ]
    ],
```

**Add User Providers**

```php
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model' => Webdecero\Webcms\Models\Admin::class,
        ],
    ],
```
### Edit config file cors.php
  
Add path for api-manager routes in array paths:

```php
'paths' => ['api-manager/*'],
```


## Install Artisan Commands

#### Create the encryption keys for API authentication

```
php artisan passport:install

```

Or individual comand configuration:

```php
php artisan passport:keys
```

```php
php artisan passport:client --personal --name='Personal Access Client Webcms'
```

<!-- ```php
php artisan passport:client --password --provider=admin --name='Password Grant Client Webcms'
``` -->

#### Install setup for Webcms

With this command the necessary components for Webcms are initialized, such as the site, configurations and an administrator user to be able to enter the system:

```
php artisan webcms:install
```


#### Create Administrator user for Webcms

```
php artisan webcms:admin

```

