<?php

namespace App\Mail\Api\V1\Wink;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The token for the reset.
     *
     * @var string
     */
    public $token;

    /**
     * New instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset your password')
            ->view('wink.emails.password', [
                'link' => route('wink.password.reset', ['token' => $this->token]),
            ]);
    }
}
