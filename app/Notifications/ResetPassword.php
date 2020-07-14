<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $token; //自加

    public function __construct($token)
    {
        $this->token=$token; //自加
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
            ->greeting('您好：')
            ->subject('重設密碼')
            ->line('這是一封密碼重設郵件，如果是您本人操作，請點擊下面按鈕繼續：')
            ->action('重設密碼', url(route('password.reset', [$this->token, 'email='.encrypt($notifiable->email)], false)))
            ->line('如果您並沒有執行此操作，您可以忽略此郵件。')
            ->salutation('謝謝');
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
