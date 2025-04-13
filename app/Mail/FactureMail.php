<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureMail extends Mailable
{
    use Queueable, SerializesModels;
    use Queueable, SerializesModels;

    public $commande;

    public function __construct($commande)
    {
        $this->commande = $commande;
        
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.facture', ['commande' => $this->commande]);

        return $this->subject('Votre facture - BiblioShop')
            ->view('emails.facture')
            ->attachData(
                $pdf->output(),
                $this->commande->user->name . '-' . $this->commande->id . '.pdf'
            );
    }



}
