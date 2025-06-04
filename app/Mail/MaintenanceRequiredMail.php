<?php

namespace App\Mail;

use App\Models\Machine; 
use App\Models\Service; 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MaintenanceRequiredMail extends Mailable 
{
    use Queueable, SerializesModels;

    public Machine $machine;
    public Service $service; 

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Machine $machine
     * @param \App\Models\Service $service
     * @return void
     */
    public function __construct(Machine $machine, Service $service)
    {
        $this->machine = $machine;
        $this->service = $service;
    }

    /**
     * Get the message envelope.
     * Define el asunto del correo y, opcionalmente, remitentes, destinatarios CC/BCC.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alerta: Mantenimiento Requerido para Máquina',
        );
    }

    /**
     * Get the message content definition.
     * Especifica la vista Markdown que se usará para el cuerpo del correo.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.maintenance.required', 
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