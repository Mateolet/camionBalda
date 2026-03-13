<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo contacto desde web',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto',
            with: $this->data,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
