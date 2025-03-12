<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Activitylog\Traits\LogsActivity;
//use Spatie\Activitylog\LogOptions;

class RentalApplication extends Model
{
    use HasFactory;
    //use LogsActivity;

  //  protected static $logAttributes = ['status'];
    //protected static $logName = 'rental_application';

   // public function getActivitylogOptions(): LogOptions
   // {
     //   return LogOptions::defaults()
       //     ->logOnly(['status'])
        //    ->useLogName('rental_application');
    //}
    protected $fillable = ['tenant_id', 'property_id', 'status', 'message'];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function property()
{
    return $this->belongsTo(Property::class, 'property_id');
}    public function owner()
{
    return $this->belongsTo(User::class, 'owner_id'); // Assuming owners are stored in the users table
}

}

