<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
   

    public function rentalApplications()
    {
        return $this->hasMany(RentalApplication::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id'); // Ensure 'owner_id' is the correct foreign key
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}