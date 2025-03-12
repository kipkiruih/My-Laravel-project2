<?php
namespace App\Events;

use App\Models\RentalApplication;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class RentalApplicationUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $application;

    public function __construct(RentalApplication $application)
    {
        $this->application = $application;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->application->tenant_id);
    }

    public function broadcastWith()
    {
        return [
            'message' => "Your rental application status has been updated.",
            'status' => $this->application->status
        ];
    }
}
