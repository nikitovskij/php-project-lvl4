<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailTrapTest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = "<html lang='en'>
        <head><title>Local host</title></head>
        <body><h1>Test message from localhost</h1></body>
        </html>";

        return $this->from('mail@example.com', 'Mailtrap')
            ->subject('Mailtrap test')
            ->html($message);
    }
}
