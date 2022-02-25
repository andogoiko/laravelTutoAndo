<?php

namespace App;

use App\Models\Profession;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /* para hacer que los booleanos sean booleanos y no tinyInt */

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function profession(){
        return $this->belongsTo(Profession::class);
    }

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function findByEmail($email){
        return static::where(compact($email))->first();
    }
}
