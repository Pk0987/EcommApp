<?php

namespace App\Notifications;

use App\Http\Controllers\AdminController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SentEmailNotification extends Notification
{
    use Queueable;
    private $details;
    /**
     * Create a new notification instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
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
        $mailMessage = (new MailMessage)
            ->subject($this->details['subject'])
            ->greeting($this->details['greeting'])
            ->line($this->details['content'])
            ->action($this->details['button'], $this->details['url'])
            ->line($this->details['footer']);

        // Attach the invoice PDF if it exists
        if (!empty($this->details['file'])) {
            $mailMessage->attach($this->details['file'], [
                'as' => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $mailMessage;
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
