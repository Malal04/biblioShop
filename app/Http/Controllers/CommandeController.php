<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotificationMail;
use App\Mail\FactureMail;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\Livre;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    public function passerCommande(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté pour passer une commande.'], 403);
        }

        $user = Auth::user();
        $livres = $request->input('livres');

        if (empty($livres)) {
            return response()->json(['message' => 'Aucun livre sélectionné.'], 400);
        }

        $commande = Commande::create([
            'user_id' => $user->id,
            'statut' => 'en attente',
            'prix_total' => 0,
        ]);

        $total = 0;

        foreach ($livres as $item) {
            $livre = Livre::find($item['id']);

            if (!$livre) {
                continue;
            }

            $quantite = isset($item['quantite']) ? intval($item['quantite']) : 1;

            if ($quantite > $livre->stock) {
                return response()->json([
                    'message' => "Le stock du livre '{$livre->titre}' est insuffisant. Disponible : {$livre->stock}",
                ], 400);
            }

            $prixTotal = $livre->prix * $quantite;
            $total += $prixTotal;

            DetailCommande::create([
                'commande_id' => $commande->id,
                'livre_id' => $livre->id,
                'quantite' => $quantite,
                'prix' => $prixTotal,
            ]);

            // Réduction du stock
            $livre->stock -= $quantite;
            $livre->save();
        }

        $commande->update(['prix_total' => $total]);

        Mail::to('mamadou1502@gmail.com')->send(new AdminNotificationMail($commande));

        return response()->json([
            'message' => 'Commande passée avec succès.',
            'commande_id' => $commande->id,
            'total' => $total
        ], 201);
    }
   
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté pour passer une commande.'], 403);
        }

        $user = Auth::user();

        // Récupérer les commandes avec les détails et les livres
        $commandes = $user->commandes()
            ->with(['details.livre']) 
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('public.page.commande', compact('commandes'));//
    }

    public function validerCommander(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté pour valider une commande.'], 403);
        }

        $commande = Commande::with(['details', 'user'])->findOrFail($request->commande_id);

        if ($commande->statut === 'payée') {
            return response()->json([
                'message' => 'Cette commande est déjà payée et ne peut plus être validée.'
            ], 400);
        }

        // Simuler le paiement
        Paiement::create([
            'commande_id' => $commande->id,
            'montant' => $commande->prix_total,
            'date_paiement' => Carbon::now(),
        ]);

        $commande->update([
            'statut' => 'payée',
            'date_paiement' => Carbon::now(),
        ]);

        Mail::to($commande->user->email)->send(new FactureMail($commande));

        Mail::to('mamadou1502@gmail.com')->send(new AdminNotificationMail($commande));



        return response()->json([
            'message' => 'Commande validée avec succès. La facture a été envoyée.'
        ]);
    }
    
    public function updateStatut(Request $request, Commande $commande)
    {
        $request->validate([
            'statut' => 'required|string|in:en cours,envoyée,livrée',
        ]);

        $commande->statut = $request->statut;
        $commande->save();

        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès.');
    }

    public function show($id)
    {
        $commande = Commande::with(['user', 'details.livre'])->findOrFail($id);
        return view('dashboard.content.commande', compact('commande'));
    }


}



