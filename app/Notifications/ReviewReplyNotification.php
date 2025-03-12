<?php
namespace App\Notifications;

use App\Models\ReviewReply;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class ReviewReplyNotification extends Notification
{
    use Queueable;

    protected $reply;

    public function __construct(ReviewReply $reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Notify via database and email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Reply to Your Review')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A property owner has replied to your review.')
            ->line('Review: "' . $this->reply->review->review . '"')
            ->line('Reply: "' . $this->reply->reply . '"')
            ->action('View Reply', url('/properties/' . $this->reply->review->property_id))
            ->line('Thank you for using Bingwa Homes!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'A property owner has replied to your review: "' . $this->reply->reply . '"',
            'url' => url('/properties/' . $this->reply->review->property_id),
        ];
    }
}
