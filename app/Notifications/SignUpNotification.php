<?php

namespace App\Notifications;

use App\Models\Code;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignUpNotification extends Notification
{
    use Queueable;

    public Code $code;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Code $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Welcome to Tranzie')
                    ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
                    ->line('Thank you for signing up for a Tranzie account.')
                    ->line('You will need to verify your account to be able to fully enjoy our services.')
                    ->action('Verify Email', url('/verify-email/' . $this->code->code ) )
                    ->line('Tranzie Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
