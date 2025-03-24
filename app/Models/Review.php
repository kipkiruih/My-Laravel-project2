<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'property_id', 'rating', 'review'];

    public $timestamps = true; // Ensure timestamps are enabled
    public function user()
    {
        return $this->belongsTo(User::class);
    }
public function tenant()
    {
        return $this->belongsTo(Tenant::class);

    }
    
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}

