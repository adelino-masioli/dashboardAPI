<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Commission extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'commissions';
    protected $fillable = [
        'value',
        'status',
        'school_id',
        'item_type_id',
        'company_id'
    ];

    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\ItemType', 'item_type_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}