<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use TelegramNotifications\Messages\TelegramCollection;
use TelegramNotifications\Messages\TelegramMessage;
use TelegramNotifications\TelegramChannel;

class LaravelTelegramNotification extends Notification
{
    use Queueable;

    protected $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $arr)
    {
        $this->data = $arr;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram() {

        return (new TelegramCollection())
            ->message(['text' => $this->data['text']])
            ->location(['latitude' => $this->data['latitude'], 'longitude' => $this->data['longitude']])
            ->photo(['photo' => $this->data['photo'], 'caption' => $this->data['photo_caption']]);
//
//        return (new TelegramMessage())
//            ->text($this->data['text']);
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
