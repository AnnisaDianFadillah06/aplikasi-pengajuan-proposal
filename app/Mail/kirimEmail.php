<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class kirimEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data_email;

    /**
     * Create a new message instance.
     */
    public function __construct($data_email)
    {
        $this->data_email = $data_email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hasil Review',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Tentukan tampilan berdasarkan nilai 'status_revisi'
        switch ($this->data_email['status_revisi']) {
            case 1: // Setujui
                $view = 'proposal_kegiatan.templateEmailSetuju';
                break;
            case 2: // Tolak
                $view = 'proposal_kegiatan.templateEmailTolak';
                break;
            case 3: // Revisi
            default:
                $view = 'proposal_kegiatan.templateEmailRevisi';
                break;
        }

        return new Content(
            view: $view,
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
