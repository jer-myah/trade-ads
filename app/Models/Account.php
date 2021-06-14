<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Account extends Model
{

    use HasFactory, Uuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'main_balance',
        'trading_balance'
    ];
    
}
