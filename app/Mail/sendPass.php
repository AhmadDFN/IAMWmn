<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class sendPass extends Mailable
{
    use Queueable, SerializesModels;
    public $reciv;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->reciv = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Congratulations',
            from: new Address('adanyfn@gmail.com', 'Bopi University Madiun')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.verif.verif',
            with: [
                "nama" => $this->reciv["mhs_nm"],
                "email" => $this->reciv["mhs_email"],
                "jurusan" => $this->reciv["jurusan"]->jurusan_nm,
                "nim" => $this->reciv["mhs_NIM"],
                "pass" => $this->reciv["pass"],
                // "id" => $this->reciv["id"],
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
