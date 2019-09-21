<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class BaseNotification extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $title = null, string $body = null, array $actions = [])
    {
        $this->title = $title;
        $this->body = $body;
        $this->actions = $actions;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($notifiable->pushSubscriptions()->count() > 0) return [WebPushChannel::class];

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
        $message = new MailMessage;

        // Append the Title if it is defined
        if (!empty($this->title)) {
            $message = $message->line($this->title);
        }

        // Append each action, if any are defined.
        if (!empty($this->actions)) {
            foreach ($this->actions as $action) {
                $message = $message->action($action[0], $action[1]);
            }
        }

        // Append a body, if it is defined
        if (!empty($this->body)) {
            $message = $message->line($this->body);
        }

        return $message;
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        $message = new WebPushMessage;

        // Append the Title if it is defined
        if (!empty($this->title)) {
            $message = $message->title($this->title);
        }

        // Append each action, if any are defined.
        if (!empty($this->actions)) {
            foreach ($this->actions as $action) {
                $message = $message->action($action[0], $action[1]);
            }
        }

        // Append a body, if it is defined
        if (!empty($this->body)) {
            $message = $message->body($this->body);
        }

        // Add additional default options
        $message = $message->data(['id' => $notification->id])
            ->badge(url('/icons/icon-hdpi.png'));

        return $message;
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
            'to' => $notifiable->id,
            'title' => $this->title ?? 'Untitled Notification',
            'body' => $this->body
        ];
    }
}
