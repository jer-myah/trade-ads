<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;


class Link extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'link',
        'advert_id',
        'duration',
        'total_hours'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guard = [
        'total_increment',
        'percentage',
        'total_decrement',
        'top_amount',
        'top_sale',
        'voluntary_amount',
        'voluntary_sale',
        'shared_with'
    ];

    public function advert()
    {
        return $this->belongsTo(Advert::class);
    }
}
