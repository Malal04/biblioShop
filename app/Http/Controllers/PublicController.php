<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Livre;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $categories = Categorie::all();
        $livres = Livre::latest()->take(12)->get(); 
        $nouveaux = Livre::where('views', true)->take(10)->get(); 
        $populaires = Livre::orderBy('views', 'desc')->take(10)->get(); 
        $vendus = Livre::orderBy('sales_count', 'desc')->take(10)->get();
 
        return view('public.page.index', compact('categories', 'livres', 'nouveaux', 'populaires', 'vendus'));
    }

    public function categorie(Categorie $categorie)
    {
        $books = Livre::where('categorie_id', $categorie->id)->get();
        return view('public.page.categorie', compact('categorie', 'books'));
    }

    public function showCategory(Request $request, $id)
    {
        $category = Categorie::findOrFail($id);
        $books = Livre::where('categorie_id', $id)->get();

        // Base query
        $booksQuery = Livre::where('categorie_id', $id);

        // Tri par prix
        if ($request->filled('price')) {
            if ($request->price === 'low_to_high') {
                $booksQuery->orderBy('prix', 'asc');
            } elseif ($request->price === 'high_to_low') {
                $booksQuery->orderBy('prix', 'desc');
            }
        }

        $books = $booksQuery->get();

        return view('public.page.categorie', compact('category', 'books'));

    }


    public function show(Livre $livre)
    {
        // Incrémenter les vues
        $livre->incrementViews();

        // Suggestions de la même catégorie
        $livresSimilaires = Livre::where('categorie_id', $livre->categorie_id)
            ->where('id', '!=', $livre->id)
            ->latest()
            ->take(4)
            ->get();

        return view('public.page.detail', compact('livre', 'livresSimilaires'));
    }

    public function services()
    {
        return view('public.page.service');
    }


    public function livre_index()
{
    return view('public.page.livre', [
        'nouveaux' => Livre::latest()->take(6)->get(),
        'meilleuresVentes' => Livre::orderByDesc('sales_count')->take(6)->get(),
        'populaires' => Livre::orderByDesc('views')->take(6)->get(),
    ]);
}


    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
