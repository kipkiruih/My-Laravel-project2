<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentPaymentReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Rent Payment Reminder')
        ->line('Dear ' . $notifiable->name . ',')
        ->line('Your rent is due soon. Please make a payment via M-Pesa.')
        ->action('Pay Now', url('/tenant/pay'))
        ->line('Thank you for choosing Bingwa Homes.');
}
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your rent is due soon. Please make a payment via M-Pesa.',
            'action_url' => url('/tenant/pay'),
            'type' => 'rent_reminder'
        ];
    }
}
