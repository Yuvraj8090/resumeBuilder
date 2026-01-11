<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable; // Optional: Keep if using Fortify
use Laravel\Jetstream\HasProfilePhoto;        // Optional: Keep if using Jetstream
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;        // Handles 'profile_photo_path'
    use TwoFactorAuthenticatable; // Handles 'two_factor_secret', etc.
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',             // <--- YOUR NEW FIELD
        'profile_photo_path',  // Often handled by the Trait, but good to have if manual
        'current_team_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime', // Helpful for your specific column
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Relationship: A User belongs to one Role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Helper: Check if user has a specific role
     */
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }
    // Inside class User extends Authenticatable
public function resumes()
{
    return $this->hasMany(Resume::class);
}
}