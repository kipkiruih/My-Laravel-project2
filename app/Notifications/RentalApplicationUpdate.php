<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\RentalApplication;

class RentalApplicationUpdate extends Notification
{
    use Queueable;

    protected $rentalApplication;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(RentalApplication $rentalApplication, $status)
    {
        $this->rentalApplication = $rentalApplication;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast']; // Send via email, save to DB, and broadcast for real-time
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->subject('Rental Application Status Update')
            ->line('Your rental application for ' . ($this->rentalApplication->property->title ?? 'a property') . ' has been ' . strtolower($this->status) . '.')
            ->line('Message from the owner: ' . ($this->rentalApplication->message ?? 'No additional message.'))
            ->action('View Application', route('tenant.rental_applications.show', $this->rentalApplication->id))
            ->line('Thank you for using Bingwa Homes.');
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toDatabase($notifiable)
    {
        return [
            'application_id' => $this->rentalApplication->id ?? null,
            'property' => $this->rentalApplication->property->title ?? 'Unknown Property',
            'status' => $this->status ?? 'Pending',
            'message' => 'Your rental application for ' . ($this->rentalApplication->property->title ?? 'a property') . ' has been ' . strtolower($this->status) . '.',
            'url' => route('tenant.rental_applications.show', ['rental_application' => $this->rentalApplication->id]),
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'application_id' => $this->rentalApplication->id ?? null,
            'property' => $this->rentalApplication->property->title ?? 'Unknown Property',
            'status' => $this->status ?? 'Pending',
            'message' => 'Your rental application for ' . ($this->rentalApplication->property->title ?? 'a property') . ' has been ' . strtolower($this->status) . '.',
        ]);
    }
}
