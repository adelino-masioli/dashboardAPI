<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SchoolContact extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'school_contacts';
    protected $fillable = [
        'name',
        'nickname',
        'occupation',
        'phone_number',
        'skype',
        'email',
        'ismain',
        'notes',
        'status',
        'school_id'
    ];

    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }
}
