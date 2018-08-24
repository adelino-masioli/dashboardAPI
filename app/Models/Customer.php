<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'middle_name',
        'last_name',
        'sex',
        'nationality',
        'email',
        'tel',
        'tel_mobile',
        'tel_emergency',
        'tel_emergency_dec',
        'street',
        'street2',
        'postcode',
        'notes',
        'notes_private',
        'webmidia_uid',
        'status',
        'country_id',
        'zone_id',
        'city_id',
        'type_id',
        'webmidia_id'
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
    public function webmidia()
    {
        return $this->belongsTo('App\Models\Webmidia', 'webmidia_id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\CustomerType', 'type_id');
    }

}
