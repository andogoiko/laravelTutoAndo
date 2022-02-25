<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profession extends Model
{
    //
    protected $fillable = [
        'title',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public $timestamps = false;
}
