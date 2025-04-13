<?php

namespace App\Http\Controllers;

use App\Mail\NouveauLivreMail;
use App\Models\Categorie;
use App\Models\Livre;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images','public');
        }

        $livre = Livre::create($data);

        $users = User::where('role', 'client')->get();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new NouveauLivreMail($livre));
        }
        return redirect()->route('dashboard.livre.lIndex')->with('success', 'Livre ajouté avec succès.');
    }

    public function edit($id)
    {
        $livre = Livre::findOrFail($id);
        $categories = Categorie::all();
        return view('dashboard.livre.lEdit', compact('livre', 'categories'));
    }

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

        if ($request->hasFile('image')) {
            if ($livre->image && Storage::exists($livre->image)) {
                Storage::delete($livre->image);
            }
            $data['image'] = $request->file('image')->store('images','public');
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

    public function search(Request $request)
    {
        $search = $request->input('search');
        $livres = Livre::where('titre', 'like', "%{$search}%")->get();
        return view('dashboard.livre.lindex', compact('livres'));
    }
    
}
