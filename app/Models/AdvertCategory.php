<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class AdvertCategory extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }


}
