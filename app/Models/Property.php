<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'title',
        'image',
        'description', 
        'price', 
        'location', 
        'owner_id', 
        'status', 
        'property_type',
        'tenant_id'
    ];

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function ratings(){
        return $this->hasMany(Review::class);}
    
     public function averageRating()
{
    return round($this->ratings()->avg('rating') ?? 0, 1);
}

}