<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SchoolContent extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'school_contents';
    protected $fillable = [
        'mappinglink',
        'description',
        'checkin_times',
        'area_activities',
        'driving_directions',
        'airports',
        'othertransport',
        'policies_disclaimers',
        'notes',
        'status',
        'school_id',
        'language_id',
    ];


    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }
    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id');
    }
}
