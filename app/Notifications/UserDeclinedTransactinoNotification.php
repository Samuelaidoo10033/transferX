<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDeclinedTransactinoNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
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
        $logoUrl = public_path('images/tranzielogo.png');

        return (new MailMessage)
            ->subject('Transaction Declined')
            ->markdown('vendor.mail.transaction.user_decline_notification', [
                'transaction' => $this->transaction,
                'logoUrl' => $logoUrl,
            ])
            ->attach($logoUrl, [
                'as' => 'tranzielogo.png',
                'mime' => 'image/png',
            ]);
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
