<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCancelled extends Mailable
{
    use Queueable, SerializesModels;

    // Dati dell'ordine passati alla mail
    public function __construct(
        public string $userName,
        public array $items,
        public float $total,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Cancelled — Presto.it',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order-cancelled',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
