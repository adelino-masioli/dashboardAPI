<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Currency extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'currencies';
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'decimal_places',
        'value',
        'status'
    ];
}
