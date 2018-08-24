<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Agency extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'agencies';
    protected $fillable = [
        'name',
        'fullname',
        'tel',
        'tel_emergency',
        'tel_fax',
        'email',
        'site',
        'city_name',
        'address',
        'address_complement',
        'postcode',
        'logo',
        'stars',
        'lat',
        'long',
        'approved',
        'notes_private',
        'status',
        'country_id',
        'zone_id',
        'city_id'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone', 'zone_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }
}
