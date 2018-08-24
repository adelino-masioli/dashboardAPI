<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SchoolTransfer extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'school_fees';
    protected $fillable = [
        'name',
        'price',
        'notes',
        'status',
        'school_id'
    ];

    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }
}
