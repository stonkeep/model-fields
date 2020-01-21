# Laravel Model Fields
this is a Laravel package that returns the fields of the model or returns the data of the array passed by parameter referring to the fields of the model 

- [Installation](#installation)
- [Usage](#usage)

## Installation
`composer require stonkeep/model-fields`
## Usage
add the trait to the laravel model

```php
class User extends Model
{
\\ ...
    protected $guarded = ['id'];
    protected $hidden = ['password'];
    private $hiddenFields = ['field2'];
    use ModelFieldsTrait;
\\ ...
}
```
the private $hiddenFields property will be used for custom fields that you don't want if returned

call the `fields()` function inside the trait to return the model fields that will be used to update or create
```php
//Get User fields
$fields = User::fields();
//Return 
[
    0 => "email",
    1 => "field1",
    2 => "field3",
    //don't show id
    //don't show password
    //don't show field2
    //don't show dates
];
```
The return will **not** show **$guarded, $dates, $hidden and $hiddenFields**

If you pass an array of values the method will return the same fields filled
```php
$data = User::find(1)->toArray();
$fields = User::fields($data);
//Return 
[
    "email" => "hello@orchestraplatform.com",
    "field1" => "field1",
    "field3" => "field3",
];
```
Then you can pass on `update()` and `create()` methods

```php
User::create(User::fields($data));
or
User::find(1)->update(User::fields($data));
```
