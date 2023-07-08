<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class VerificationCode extends Mailable
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
            subject: 'Verification Code',
            from: new Address('adanyfn@gmail.com', 'Bopi University Madiun')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // dd($this->reciv);
        return new Content(
            view: 'admin.verif.email',
            with: ["nama" => $this->reciv["mhs_nm"], "jurusan" => $this->reciv["mhs_kd_jurusan"], "nim" => $this->reciv["mhs_NIM"]]
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
