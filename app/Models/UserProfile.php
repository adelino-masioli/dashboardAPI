<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserProfile extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_profiles';
    protected $fillable = [
        'firstname',
        'lastname',
        'birthday',
        'user_id',
        'user_type_id'
    ];

    public function user() {
        return $this->belongsTo('App\Http\User', 'user_id');
    }

    public function user_type() {
        return $this->belongsTo('App\Http\UserType', 'user_type_id');
    }

}
