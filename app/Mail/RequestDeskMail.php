<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class RequestDeskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     *
     */
    public function __construct(){

    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->to('s11146723@student.usp.ac.fj')->subject('test')->html('<p>Test Form Shon</p>');
    }
}
