<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AgencyImage extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'agency_images';
    protected $fillable = [
        'name',
        'url',
        'status',
        'agency_id',
        'type_id'
    ];

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency', 'agency_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\AgencyPropType', 'type_id');
    }
}
