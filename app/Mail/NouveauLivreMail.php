<?php

namespace App\Mail;

use App\Models\Livre;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouveauLivreMail extends Mailable
{
    use Queueable, SerializesModels;

    public $livre;

    public function __construct(Livre $livre)
    {
        $this->livre = $livre;
    }

    public function build()
    {
        return $this->subject('📚 Nouveau livre disponible sur BiblioShop')
            ->view('emails.nouveau_livre');
    }
}
