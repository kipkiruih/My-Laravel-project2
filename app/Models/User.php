<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function rentalApplications()
{
    return $this->hasMany(RentalApplication::class, 'tenant_id');
}

public function isTenant()
{
    return $this->role === 'tenant';
}
public function bookmarks()
{
    return $this->hasMany(Bookmark::class, 'tenant_id');
}
public function isOwner()
{
    return $this->role === 'owner';
}
// In app/Models/User.php
public function rentedProperties()
{
    return $this->hasManyThrough(
        Property::class,       // Final model (Property)
        RentalApplication::class, // Intermediate table (rental_applications)
        'tenant_id',           // Foreign key on rental_applications table
        'id',                  // Foreign key on properties table
        'id',                  // Primary key on users table
        'property_id'          // Foreign key on rental_applications table
    )->where('rental_applications.status', 'Approved'); // Only show approved rentals
}
public function tenant()
{
    return $this->hasOne(Tenant::class);
}
public function payments()
{
    return $this->hasMany(Payment::class, 'tenant_id');
}
public function reviews()
{
    return $this->hasMany(Review::class);
}


}