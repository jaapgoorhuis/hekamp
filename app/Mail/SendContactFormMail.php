<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $bericht, $subject;
    public function __construct($name, $email, $bericht, $subject)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->bericht = $bericht;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Contact Form Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.sendContactForm',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
