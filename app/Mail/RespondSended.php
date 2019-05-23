<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RespondSended extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job)
    {
       $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.respondsended')->subject("Вы приглашены на работу");
    }
}
