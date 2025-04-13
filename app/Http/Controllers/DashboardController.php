<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Livre;
use App\Models\Paiement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {

        if (!Auth::check()) {
            return response()->json(['message' => 'Vous devez être connecté pour passer une commande.'], 403);
        }

        $user = Auth::user();

        // Total des livres
        $totalLivres = Livre::count();

        // Total des catégories
        $totalCategories = Categorie::count();

        // Total des utilisateurs
        $totalUsers = User::count();

        // Commandes en cours de la journée
        $commandesEnCours = Commande::where('statut', 'en attente')
            ->whereDate('created_at', Carbon::today())
            ->count();

        // Commandes validées de la journée
        $commandesValidees = Commande::where('statut', 'payée')
            ->whereDate('created_at', Carbon::today())
            ->count();

        // Recettes journalières
        $recettesJournalières = Paiement::whereDate('date_paiement', Carbon::today())
            ->sum('montant');

        // Nombre de commandes par mois
        $commandesParMois = Commande::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Nombre de livres vendus par catégorie par mois
        $livresVendusParCategorieParMois = Commande::join('detail_commandes', 'commandes.id', '=', 'detail_commandes.commande_id')
            ->join('livres', 'livres.id', '=', 'detail_commandes.livre_id')
            ->join('categories', 'categories.id', '=', 'livres.categorie_id')
            ->selectRaw('categories.nom as category_name, MONTH(commandes.created_at) as month, SUM(detail_commandes.quantite) as total_books_sold')
            ->groupBy('category_name', 'month')
            ->orderBy('month', 'asc')
            ->get();

        // Récupérer toutes les commandes avec les détails associés
        $commandes = Commande::with(['user', 'details.livre', 'details.livre.categorie'])
            ->get();

        $recetteTotale = Paiement::sum('montant');

        $recettesParMois = Paiement::selectRaw('MONTH(date_paiement) as mois, SUM(montant) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        return view('dashboard.main.main', compact(
            'totalLivres',
            'totalCategories',
            'totalUsers',
            'commandesEnCours',
            'commandesValidees',
            'recettesJournalières',
            'recetteTotale',
            'commandesParMois',
            'livresVendusParCategorieParMois',
            'commandes',
            'recettesParMois'
        ));
    }

    
}
