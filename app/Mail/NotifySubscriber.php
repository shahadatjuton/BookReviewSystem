<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class NotifySubscriber extends Mailable
{
    use Queueable, SerializesModels;
    public $pendingPost;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pendingPost)
    {
        $this->pendingPost =$pendingPost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */



    public function build()
    {
        $pendingPost = $this->pendingPost;
        return $this->view('email',compact('pendingPost'));
    }
}
