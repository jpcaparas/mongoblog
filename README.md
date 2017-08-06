# Mongoblog

![Laravel feat. MongoDB](https://jenssegers.com/uploads/images/l4mongo.png.pagespeed.ce.KOh2Dt4xBA.png)

A simple, proof-of-concept Laravel blog application powered by a MongoDB ORM.

## Separated API and front-end

This is a RESTful application, whose API is **entirely decoupled** from its front-end (neat, eh?), meaning it is fully testable from a REST client like [Postman](https://www.getpostman.com/) or from PHPStorm's [built-in client](https://www.jetbrains.com/help/phpstorm/rest-client-tool-window.html).

To test the API endpoints on Postman:

1. Serve the application with `php artisan serve` or [Valet](https://laravel.com/docs/5.4/valet).
1. Seed the database with data fixtures by running `php migrate --seed`.
1. Get an overview of the `api/vi` routes by running `php artisan route:list`.
1. Download the Postman collection [here](https://gist.githubusercontent.com/jpcaparas/8277c34d975c5bcd2934664e2eee97a8/raw/bcdfedb9c3c87d962b789799950ef574ae3fb7ec/Mongoblog.postman_collection.json) and import the file into your Postman client.
1. Start testing (and remember to change environment variables as needed).

## System requirements

- PHP v7.x
- MongoDB v3.4
- nginx 1.10 or PHP's built-in web server

## Gotchas

> I'm having issues installing the `jenssegers/mongodb` package.

Run `php -m | grep mongodb` to confirm that the MongoDB PHP extension is installed.

If the above does not work, run `composer install --ignore-platform-reqs`.

---

> I'm getting `Class 'MongoDB\Driver\Manager' not found` when I run the application

Restart your web server. It probably has not loaded the `php-mongodb` extension yet.

> Can I revert back to MySQL/SQLite without issue?

Unfortunately, as this library is not officially supported by Laravel, it comes with integration issues here and there, a few which are:

- The inability to drop tables using `dropIfExists`.
- Missing polyfills on its drop-in Eloquent replacement.
- The inability to use a table's `id` column on the default query builder; you'll have to use `_id` -- the convention with which MongoDB stores primary keys. This has given me problems with validation rules:
  ```
  'post_id' => 'in:posts,id'
  ```
  ... does not work, so I have to replace it with:
  ```
   'post_id' => 'in:posts,_id'
  ```

I initially wanted to test _polymorphic_ relationships with the `Category` and `Comment` models, but just went with a _many-to-many_ due to the lack of documentation.

## Features & suggestions

View the _Projects_ page for a roadmap of things to come.

If you come across a bug, feel free to [open a new issue](https://github.com/jpcaparas/mongoblog/issues/new). For a bug specific to the MongoDB ORM, submit a ticket via [their GitHub page](https://github.com/jenssegers/laravel-mongodb).


## To-do

- Authentication
- Integration tests
- Back-end / forms
- Front-end / templates

For a comprehensive list of to-dos for the core functionality of the application, visit [the _Core features_ project page](https://github.com/jpcaparas/mongoblog/projects/1).
