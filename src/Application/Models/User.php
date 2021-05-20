<?php


namespace App\Application\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable=['username','email','password','fullname'];
}