<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;
use App\Models\Category;
use App\Models\Package;


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

    public function advertCategory()
    {
        return $this->belongsTo(AdvertCategory::class);
    }

    public function advertPackage()
    {
        return $this->belongsTo(AdvertPackage::class);
    }

}
