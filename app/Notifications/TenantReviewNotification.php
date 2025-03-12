<?php
namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class TenantReviewNotification extends Notification
{
    use Queueable;

    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Notify via database and email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Property Review')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A tenant has left a review for your property.')
            ->line('Property: ' . $this->review->property->title)
            ->line('Review: "' . $this->review->review . '"')
            ->action('View Review', url('/properties/' . $this->review->property_id))
            ->line('Thank you for using Bingwa Homes!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'A tenant has reviewed your property: "' . $this->review->review . '"',
            'url' => url('/properties/' . $this->review->property_id),
        ];
    }
}
