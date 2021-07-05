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
        'initial_duration',
        'duration'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'total_increment',
        'percentage',
        'total_decrement',
        'top-amount',
        'top_sale',
        'voluntary-amount',
        'voluntary_sale',
        'shared_with'
    ];
}
