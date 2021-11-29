<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\MailManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\PasswordResetConfirmationEmail;

final class SendPasswordResetConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $passwordResetToken
     * @return void
     */
    public function __construct(
        private Model $model,
        private string $passwordResetToken
    ) {}

    /**
     * Execute the job.
     *
     * @param \Illuminate\Mail\MailManager $mailManager
     * @return void
     */
    public function handle(MailManager $mailManager): void
    {
        $mailManager->to($this->model)->send(
            new PasswordResetConfirmationEmail($this->model, $this->passwordResetToken)
        );
    }
}
