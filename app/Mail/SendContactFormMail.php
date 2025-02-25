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

    public $name, $company_name, $email, $phone, $bericht;
    public function __construct($name, $company_name, $email, $phone, $bericht)
    {
        $this->name = $name;
        $this->company_name = $company_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->bericht = $bericht;


    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact formulier verzonden',
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
