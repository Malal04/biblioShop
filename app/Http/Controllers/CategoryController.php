<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  // Afficher la liste des catégories
  public function index()
  {
    $categories = Categorie::all();
    return view('dashboard.categorie.cIndex', compact('categories'));
  }

  // Afficher le formulaire de création
  public function create()
  {
    return view('dashboard.categorie.cCreate');
  }

  // Enregistrer une nouvelle catégorie
  public function store(Request $request)
  {
    $request->validate([
      'nom' => 'required|string|max:255',
    ]);

    Categorie::create([
      'nom' => $request->nom,
    ]);

    return redirect()->route('dashboard.categorie.cIndex')->with('success', 'Catégorie ajoutée avec succès!');
  }

  // Afficher le formulaire d'édition
  public function edit($id)
  {
    $category = Categorie::findOrFail($id);
    return view('dashboard.categorie.cEdit', compact('category'));
  }

  // Mettre à jour une catégorie existante
  public function update(Request $request, $id)
  {
    $request->validate([
        'nom' => 'required|string|max:255',
    ]);

    $category = Categorie::findOrFail($id);
    $category->update([
        'nom' => $request->nom,
    ]);

    return redirect()->route('dashboard.categorie.cIndex')->with('success', 'Catégorie mise à jour avec succès!');
  }

  // Supprimer une catégorie
  public function destroy($id)
  {
    $category = Categorie::findOrFail($id);
    $category->delete();

    return redirect()->route('dashboard.categorie.cIndex')->with('success', 'Catégorie supprimée avec succès!');
  }

}
