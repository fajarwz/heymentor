<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePending extends Notification implements ShouldQueue
{
    use Queueable;

    private string $paymentRoute;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $paymentRoute)
    {
        $this->paymentRoute = $paymentRoute;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Thank you for your purchase. Please complete the payment within the next 24 hours. Click the button below to go to the payment page.')
                    ->action('Complete The Payment', $this->paymentRoute)
                    ->line('Thank you for using our service!');
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
}
