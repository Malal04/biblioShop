<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Livre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    // Afficher la liste des livres
    public function index()
    {
        $livres = Livre::with('categorie')->get();
        return view('dashboard.livre.lindex', compact('livres'));
    }

    // Afficher le formulaire de création d'un livre
    public function create()
    {
        $categories = Categorie::all();
        return view('dashboard.livre.lcreate', compact('categories'));
    }

    // Enregistrer un nouveau livre
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->all();

        // Si une image est envoyée, on la sauvegarde et on ajoute son chemin
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('livres_images');
        }

        Livre::create($data);

        return redirect()->route('dashboard.livre.lIndex')->with('success', 'Livre ajouté avec succès.');
    }

    // Afficher le formulaire pour modifier un livre
    public function edit($id)
    {
        $livre = Livre::findOrFail($id);
        $categories = Categorie::all();
        return view('dashboard.livre.lEdit', compact('livre', 'categories'));
    }

    // Mettre à jour un livre
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $livre = Livre::findOrFail($id);
        $data = $request->all();

        // Si une image est envoyée, on la sauvegarde et on ajoute son chemin
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($livre->image && Storage::exists($livre->image)) {
                Storage::delete($livre->image);
            }
            $data['image'] = $request->file('image')->store('livres_images');
        }

        $livre->update($data);

        return redirect()->route('dashboard.livre.lIndex')->with('success', 'Livre modifié avec succès.');
    }

    // Supprimer un livre
    public function destroy($id)
    {
        $livre = Livre::findOrFail($id);

        // Supprimer l'image associée
        if ($livre->image && Storage::exists($livre->image)) {
            Storage::delete($livre->image);
        }

        $livre->delete();

        return redirect()->route('dashboard.livre.lIndex')->with('success', 'Livre supprimé avec succès.');
    }
}
