<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;


class Advert extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'advert_package_id',
        'advert_category_id',
        'title',
        'description',
        'amount',
        'image',
        'phone',
        'user_id',
    ];


}
