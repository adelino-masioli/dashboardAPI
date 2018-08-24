<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SchoolAccommodation extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'school_accommodations';
    protected $fillable = [
        'name',
        'description',
        'status',
        'school_id',
        'type_id'
    ];

    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\SchoolAccommodationType', 'type_id');
    }
}
