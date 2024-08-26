<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // ** This is mass-assign. It's a security feature to prevent unintended mass-assignment ** //
    protected $fillable = ['title','description','long_description'];
    //protected $guarded = []; 
    //If you have a model which has quite a lot of attributes, a lot of columns, let say 20 or 30
    //and u dont want to put all of them inside Fillable, you can instead say that let say 
    // 'password'
    // using $fillable is more secure 

    // Configure what is the key it should use to resolve
    // public function getRouteKeyName()
    // {

    // }

    // ** This is custom method ** //
    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
}
