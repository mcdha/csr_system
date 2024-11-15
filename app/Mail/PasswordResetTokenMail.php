<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetTokenMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $password_reset_token;
    private $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $password_reset_token)
    {
        $this->password_reset_token = $password_reset_token;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'AAP CSR System: Reset Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.password_reset_token',
            with: [
                'user' => $this->user,
                'password_reset_token' => $this->password_reset_token
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
