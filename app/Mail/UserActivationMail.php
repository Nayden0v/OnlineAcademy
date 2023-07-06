<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $activationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public function __construct($name, $activationUrl)
    {
        $this->activationUrl = $activationUrl;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.activate')->with([
            'activationUrl' => $this->activationUrl,
            'name' => $this->name,
        ]);
    }
    
}
