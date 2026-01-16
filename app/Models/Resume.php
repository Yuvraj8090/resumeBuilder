<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    // Allow mass assignment for all fields (id is protected by default)
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('start_date', 'desc');
    }

    public function education()
    {
        return $this->hasMany(Education::class)->orderBy('start_date', 'desc');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}