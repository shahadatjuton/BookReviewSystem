<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyPublisher extends Notification
{
    use Queueable;
    public $pendingPost;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pendingPost)
    {
        $this->pendingPost = $pendingPost;
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
            ->line('Assalamu Alaikum  '. $this->pendingPost->user->name)
            ->line('Your post is approved.')
            ->line('To check details click on button.')
            ->line('Title: '.$this->pendingPost->title)
            ->action('Notification Action', url(route('publisher.post.show', $this->pendingPost->id)))
            ->line('Thank you for using our application!');
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
