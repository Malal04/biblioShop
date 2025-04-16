<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandeDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public function __construct($commande)
    {
        $this->commande = $commande;
    }
    
    public function build()
    {
        return $this->subject('Détails de votre commande')
                    ->markdown('emails.commande.details');
    }
}
