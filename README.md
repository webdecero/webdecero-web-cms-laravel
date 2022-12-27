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
MANAGER_DEBUG=false
#es_MX
MANAGER_SET_LOCALE="en_US"
MANAGER_TITLE="Manager Meta Title"
MANAGER_FAVICON="Pages/assets/favicon/favicon-16x16.png"
MANAGER_SITE_NAME="CMS WebDeCero"
MANAGER_SIDEBAR_LOGO="https://webdecero.com/Pages/assets/img/logo-charge.png"
MANAGER_REDIRECT_AUTH="/dashboard"
MANAGER_REDIRECT_LOGOUT="/login"


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

#### Create Administrator user for CMS

```
php artisan webcms:admin

```

## AQUí Voy

In this new major release which supports the new mongodb PHP extension, we also moved the location of the Model class and replaced the MySQL model class with a trait.

Please change all `Jenssegers\Mongodb\Model` references to `Jenssegers\Mongodb\Eloquent\Model` either at the top of your model files, or your registered alias.

### Extend Model User

Extend User Model whith MongoBD `app/User.php`:

```php
<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Webdecero\WEBCMS\Manager\Models\User;

class User extends User{

    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

```

## Examples

### Basic Usage

**Retrieving All Models**

```php
$users = User::all();
```

**Retrieving A Record By Primary Key**

```php
$user = User::find('517c43667db388101e00000f');
```

**Wheres**

```php
$users = User::where('votes', '>', 100)->take(10)->get();
```

**Or Statements**

```php
$users = User::where('votes', '>', 100)->orWhere('name', 'John')->get();
```

**And Statements**

```php
$users = User::where('votes', '>', 100)->where('name', '=', 'John')->get();
```

**Using Where In With An Array**

```php
$users = User::whereIn('age', [16, 18, 20])->get();
```

When using `whereNotIn` objects will be returned if the field is non existent. Combine with `whereNotNull('age')` to leave out those documents.

**Using Where Between**

```php
$users = User::whereBetween('votes', [1, 100])->get();
```

**Where null**

```php
$users = User::whereNull('updated_at')->get();
```

**Order By**

```php
$users = User::orderBy('name', 'desc')->get();
```

**Offset & Limit**

```php
$users = User::skip(10)->take(5)->get();
```

**Distinct**

Distinct requires a field for which to return the distinct values.

```php
$users = User::distinct()->get(['name']);
// or
$users = User::distinct('name')->get();
```

Distinct can be combined with **where**:

```php
$users = User::where('active', true)->distinct('name')->get();
```

**Advanced Wheres**

```php
$users = User::where('name', '=', 'John')->orWhere(function($query)
    {
        $query->where('votes', '>', 100)
              ->where('title', '<>', 'Admin');
    })
    ->get();
```

**Group By**

Selected columns that are not grouped will be aggregated with the \$last function.

```php
$users = Users::groupBy('title')->get(['title', 'name']);
```

**Aggregation**

_Aggregations are only available for MongoDB versions greater than 2.2._

```php
$total = Order::count();
$price = Order::max('price');
$price = Order::min('price');
$price = Order::avg('price');
$total = Order::sum('price');
```

Aggregations can be combined with **where**:

```php
$sold = Orders::where('sold', true)->sum('price');
```

Aggregations can be also used on subdocuments:

```php
$total = Order::max('suborder.price');
...
```

**NOTE**: this aggreagtion only works with single subdocuments (like embedsOne) not subdocument arrays (like embedsMany)

**Like**

```php
$user = Comment::where('body', 'like', '%spam%')->get();
```

**Incrementing or decrementing a value of a column**

Perform increments or decrements (default 1) on specified attributes:

```php
User::where('name', 'John Doe')->increment('age');
User::where('name', 'Jaques')->decrement('weight', 50);
```

The number of updated objects is returned:

```php
$count = User->increment('age');
```

You may also specify additional columns to update:

```php
User::where('age', '29')->increment('age', 1, ['group' => 'thirty something']);
User::where('bmi', 30)->decrement('bmi', 1, ['category' => 'overweight']);
```

**Soft deleting**

When soft deleting a model, it is not actually removed from your database. Instead, a deleted_at timestamp is set on the record. To enable soft deletes for a model, apply the SoftDeletingTrait to the model:

```php
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class User extends Eloquent {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
```

For more information check http://laravel.com/docs/eloquent#soft-deleting

### MongoDB specific operators

**Exists**

Matches documents that have the specified field.

```php
User::where('age', 'exists', true)->get();
```

**All**

Matches arrays that contain all elements specified in the query.

```php
User::where('roles', 'all', ['moderator', 'author'])->get();
```

**Size**

Selects documents if the array field is a specified size.

```php
User::where('tags', 'size', 3)->get();
```

**Regex**

Selects documents where values match a specified regular expression.

```php
User::where('name', 'regex', new \MongoDB\BSON\Regex("/.*doe/i"))->get();
```

**NOTE:** you can also use the Laravel regexp operations. These are a bit more flexible and will automatically convert your regular expression string to a MongoDB\BSON\Regex object.

```php
User::where('name', 'regexp', '/.*doe/i'))->get();
```

And the inverse:

```php
User::where('name', 'not regexp', '/.*doe/i'))->get();
```

**Type**

Selects documents if a field is of the specified type. For more information check: http://docs.mongodb.org/manual/reference/operator/query/type/#op._S_type

```php
User::where('age', 'type', 2)->get();
```

**Mod**

Performs a modulo operation on the value of a field and selects documents with a specified result.

```php
User::where('age', 'mod', [10, 0])->get();
```

**Near**

**NOTE:** Specify coordinates in this order: `longitude, latitude`.

```php
$users = User::where('location', 'near', [
	'$geometry' => [
        'type' => 'Point',
	    'coordinates' => [
	        -0.1367563,
            51.5100913,
        ],
    ],
    '$maxDistance' => 50,
]);
```

**GeoWithin**

```php
$users = User::where('location', 'geoWithin', [
	'$geometry' => [
        'type' => 'Polygon',
	    'coordinates' => [[
            [
                -0.1450383,
                51.5069158,
            ],
            [
                -0.1367563,
                51.5100913,
            ],
            [
                -0.1270247,
                51.5013233,
            ],
            [
                -0.1450383,
                51.5069158,
            ],
        ]],
    ],
]);
```

**GeoIntersects**

```php
$locations = Location::where('location', 'geoIntersects', [
    '$geometry' => [
        'type' => 'LineString',
        'coordinates' => [
            [
                -0.144044,
                51.515215,
            ],
            [
                -0.129545,
                51.507864,
            ],
        ],
    ],
]);
```

**Where**

Matches documents that satisfy a JavaScript expression. For more information check http://docs.mongodb.org/manual/reference/operator/query/where/#op._S_where

### Inserts, updates and deletes

Inserting, updating and deleting records works just like the original Eloquent.

**Saving a new model**

```php
$user = new User;
$user->name = 'John';
$user->save();
```

You may also use the create method to save a new model in a single line:

```php
User::create(['name' => 'John']);
```

**Updating a model**

To update a model, you may retrieve it, change an attribute, and use the save method.

```php
$user = User::first();
$user->email = 'john@foo.com';
$user->save();
```

_There is also support for upsert operations, check https://github.com/jenssegers/laravel-mongodb#mongodb-specific-operations_

**Deleting a model**

To delete a model, simply call the delete method on the instance:

```php
$user = User::first();
$user->delete();
```

Or deleting a model by its key:

```php
User::destroy('517c43667db388101e00000f');
```

For more information about model manipulation, check http://laravel.com/docs/eloquent#insert-update-delete

### Dates

Eloquent allows you to work with Carbon/DateTime objects instead of MongoDate objects. Internally, these dates will be converted to MongoDate objects when saved to the database. If you wish to use this functionality on non-default date fields, you will need to manually specify them as described here: http://laravel.com/docs/eloquent#date-mutators

Example:

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    protected $dates = ['birthday'];

}
```

Which allows you to execute queries like:

```php
$users = User::where('birthday', '>', new DateTime('-18 years'))->get();
```

### Relations

Supported relations are:

-   hasOne
-   hasMany
-   belongsTo
-   belongsToMany
-   embedsOne
-   embedsMany

Example:

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    public function items()
    {
        return $this->hasMany('Item');
    }

}
```

And the inverse relation:

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Item extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User');
    }

}
```

The belongsToMany relation will not use a pivot "table", but will push id's to a **related_ids** attribute instead. This makes the second parameter for the belongsToMany method useless. If you want to define custom keys for your relation, set it to `null`:

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    public function groups()
    {
        return $this->belongsToMany('Group', null, 'user_ids', 'group_ids');
    }

}
```

Other relations are not yet supported, but may be added in the future. Read more about these relations on http://laravel.com/docs/eloquent#relationships

### EmbedsMany Relations

If you want to embed models, rather than referencing them, you can use the `embedsMany` relation. This relation is similar to the `hasMany` relation, but embeds the models inside the parent object.

**REMEMBER**: these relations return Eloquent collections, they don't return query builder objects!

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    public function books()
    {
        return $this->embedsMany('Book');
    }

}
```

You can access the embedded models through the dynamic property:

```php
$books = User::first()->books;
```

The inverse relation is auto*magically* available, you don't need to define this reverse relation.

```php
$user = $book->user;
```

Inserting and updating embedded models works similar to the `hasMany` relation:

```php
$book = new Book(['title' => 'A Game of Thrones']);

$user = User::first();

$book = $user->books()->save($book);
// or
$book = $user->books()->create(['title' => 'A Game of Thrones'])
```

You can update embedded models using their `save` method (available since release 2.0.0):

```php
$book = $user->books()->first();

$book->title = 'A Game of Thrones';

$book->save();
```

You can remove an embedded model by using the `destroy` method on the relation, or the `delete` method on the model (available since release 2.0.0):

```php
$book = $user->books()->first();

$book->delete();
// or
$user->books()->destroy($book);
```

If you want to add or remove an embedded model, without touching the database, you can use the `associate` and `dissociate` methods. To eventually write the changes to the database, save the parent object:

```php
$user->books()->associate($book);

$user->save();
```

Like other relations, embedsMany assumes the local key of the relationship based on the model name. You can override the default local key by passing a second argument to the embedsMany method:

```php
return $this->embedsMany('Book', 'local_key');
```

Embedded relations will return a Collection of embedded items instead of a query builder. Check out the available operations here: https://laravel.com/docs/master/collections

### EmbedsOne Relations

The embedsOne relation is similar to the embedsMany relation, but only embeds a single model.

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Book extends Eloquent {

    public function author()
    {
        return $this->embedsOne('Author');
    }

}
```

You can access the embedded models through the dynamic property:

```php
$author = Book::first()->author;
```

Inserting and updating embedded models works similar to the `hasOne` relation:

```php
$author = new Author(['name' => 'John Doe']);

$book = Books::first();

$author = $book->author()->save($author);
// or
$author = $book->author()->create(['name' => 'John Doe']);
```

You can update the embedded model using the `save` method (available since release 2.0.0):

```php
$author = $book->author;

$author->name = 'Jane Doe';
$author->save();
```

You can replace the embedded model with a new model like this:

```php
$newAuthor = new Author(['name' => 'Jane Doe']);
$book->author()->save($newAuthor);
```

### MySQL Relations

If you're using a hybrid MongoDB and SQL setup, you're in luck! The model will automatically return a MongoDB- or SQL-relation based on the type of the related model. Of course, if you want this functionality to work both ways, your SQL-models will need use the `Jenssegers\Mongodb\Eloquent\HybridRelations` trait. Note that this functionality only works for hasOne, hasMany and belongsTo relations.

Example SQL-based User model:

```php
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class User extends Eloquent {

    use HybridRelations;

    protected $connection = 'mysql';

    public function messages()
    {
        return $this->hasMany('Message');
    }

}
```

And the Mongodb-based Message model:

```php
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Message extends Eloquent {

    protected $connection = 'mongodb';

    public function user()
    {
        return $this->belongsTo('User');
    }

}
```

### Raw Expressions

These expressions will be injected directly into the query.

```php
User::whereRaw(['age' => array('$gt' => 30, '$lt' => 40)])->get();
```

You can also perform raw expressions on the internal MongoCollection object. If this is executed on the model class, it will return a collection of models. If this is executed on the query builder, it will return the original response.

```php
// Returns a collection of User models.
$models = User::raw(function($collection)
{
    return $collection->find();
});

// Returns the original MongoCursor.
$cursor = DB::collection('users')->raw(function($collection)
{
    return $collection->find();
});
```

Optional: if you don't pass a closure to the raw method, the internal MongoCollection object will be accessible:

```php
$model = User::raw()->findOne(['age' => array('$lt' => 18)]);
```

The internal MongoClient and MongoDB objects can be accessed like this:

```php
$client = DB::getMongoClient();
$db = DB::getMongoDB();
```

### MongoDB specific operations

**Cursor timeout**

To prevent MongoCursorTimeout exceptions, you can manually set a timeout value that will be applied to the cursor:

```php
DB::collection('users')->timeout(-1)->get();
```

**Upsert**

Update or insert a document. Additional options for the update method are passed directly to the native update method.

```php
DB::collection('users')->where('name', 'John')
                       ->update($data, ['upsert' => true]);
```

**Projections**

You can apply projections to your queries using the `project` method.

```php
DB::collection('items')->project(['tags' => ['$slice' => 1]])->get();
DB::collection('items')->project(['tags' => ['$slice' => [3, 7]]])->get();
```

**Projections with Pagination**

```php
$limit = 25;
$projections = ['id', 'name'];
DB::collection('items')->paginate($limit, $projections);
```

**Push**

Add items to an array.

```php
DB::collection('users')->where('name', 'John')->push('items', 'boots');
DB::collection('users')->where('name', 'John')->push('messages', ['from' => 'Jane Doe', 'message' => 'Hi John']);
```

If you don't want duplicate items, set the third parameter to `true`:

```php
DB::collection('users')->where('name', 'John')->push('items', 'boots', true);
```

**Pull**

Remove an item from an array.

```php
DB::collection('users')->where('name', 'John')->pull('items', 'boots');
DB::collection('users')->where('name', 'John')->pull('messages', ['from' => 'Jane Doe', 'message' => 'Hi John']);
```

**Unset**

Remove one or more fields from a document.

```php
DB::collection('users')->where('name', 'John')->unset('note');
```

You can also perform an unset on a model.

```php
$user = User::where('name', 'John')->first();
$user->unset('note');
```

### Query Caching

You may easily cache the results of a query using the remember method:

```php
$users = User::remember(10)->get();
```

_From: http://laravel.com/docs/queries#caching-queries_

### Query Logging

By default, Laravel keeps a log in memory of all queries that have been run for the current request. However, in some cases, such as when inserting a large number of rows, this can cause the application to use excess memory. To disable the log, you may use the `disableQueryLog` method:

```php
DB::connection()->disableQueryLog();
```

_From: http://laravel.com/docs/database#query-logging_
