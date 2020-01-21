<?php


namespace stonkeep\ModelFields\Tests;

use Illuminate\Database\Eloquent\Model;
use stonkeep\ModelFields\ModelFieldsTrait;

class User extends Model
{
//    protected $table = 'users';
    protected $guarded = ['id'];
    protected $hidden = ['password'];
    private $hiddenFields = ['field2'];
    use ModelFieldsTrait;
}
