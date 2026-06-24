<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionPaymentDue extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Subscription $subscription)
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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/subscriptions/'.$this->subscription->id);

        return (new MailMessage)
            ->greeting('Hello')
            ->line("Your subscription payment of {$this->subscription->price} for {$this->subscription->title} is due today.")
            ->line('Please confirm payment is made.')
            ->action('Confirm payment', $url)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Payment due today',
            'message' => "Your subscription payment of {$this->subscription->price} is due today.",
            'subscription_id' => $this->subscription->id,
        ];
    }
}
