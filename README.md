# laravel-migrations-enum-change
A small trait that makes it easier to update enum fields with new values inside your migration files.

Since there is not out of the box solution for this, this trait makes it easier as you don't have to remember the query syntax and write it down each time.

## Available methods
1. `protected function setTable(string $table): void`. This method allows you to set the table for the migrations once, so you can update multiple enum columns without the need to specify the table name each time. You can of course run this multiple times to affect multiple tables.
2. `protected function updateDBEnum(string $column, array $values): void`. This method does the actual update. For convenience, you just need to pass the column name and the array of values, and it takes care of converting that to a query

## How to install
You can install this as the composer package by running
```
composer require lyyka/laravel-migrations-enum-change
```
in your project directory.

## Sample usage
In your `up()` migration method:
```php
...

use \lyyka\UpdatesEnumField;

/**
* Run the migrations.
*
* @return void
*/
public function up()
{
    $this->setTable('my_table');
    $this->updateDBEnum('my_column', ["value1", "value2"]);
}

...
```
