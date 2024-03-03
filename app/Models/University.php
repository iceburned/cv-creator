<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function cv()
    {

    }

    public  function users()
    {
        return $this->belongsToMany(User::class, 'universities_users', 'user_id', 'university_id')
            ->withPivot('scores');
    }
}
