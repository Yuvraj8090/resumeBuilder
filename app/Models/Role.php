<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
    ];

    /**
     * Get the users that belong to the role.
     * Assuming you will link them later.
     */
    public function users()
    {
        // If using a pivot table (Many-to-Many)
        // return $this->belongsToMany(User::class);
        
        // If using a role_id column on users table (One-to-Many)
        return $this->hasMany(User::class);
    }
}