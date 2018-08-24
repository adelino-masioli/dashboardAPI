<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cities';
    protected $fillable = [
        'name',
        'zone_id'
    ];

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone', 'zone_id');
    }
}
