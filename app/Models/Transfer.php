<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id',
        'email',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
