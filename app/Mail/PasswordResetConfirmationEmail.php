<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

final class PasswordResetConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private Model $model,
        private string $passwordResetToken,
    ) {}

    /**
     * Build the message.
     *
     * @return \App\Mail\PasswordResetConfirmationEmail
     */
    public function build(): PasswordResetConfirmationEmail
    {
        return $this->view('emails.password-reset')->with([
            'passwordResetToken' => $this->passwordResetToken
        ]);
    }
}
