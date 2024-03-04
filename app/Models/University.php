<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'accreditation',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
