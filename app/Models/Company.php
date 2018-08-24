<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'companies';
    protected $fillable = [
        'name',
        'fullname',
        'email',
        'skype',
        'tel1',
        'tel2',
        'tel_emergency',
        'street',
        'street2',
        'postcode',
        'notes',
        'status',
        'zone_id',
        'country_id',
        'city_id',
        'type_id'
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

    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id');
    }
}