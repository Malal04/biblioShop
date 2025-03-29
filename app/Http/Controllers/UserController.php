<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
     // Afficher tous les utilisateurs
     public function index()
     {
        $users = User::all();
        return view('dashboard.user.uIndex', compact('users'));
     }
 
     // Afficher le formulaire de création
     public function create()
     {
        return view('dashboard.user.uCreate');
     }
 
     // Créer un nouvel utilisateur
     public function store(Request $request)
     {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:gestionnaire,client,admin',
         ]);
 
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
         ]);
 
         return redirect()->route('dashboard.user.uIndex');
     }
 
     // Afficher le formulaire de modification
     public function edit($id)
     {
        $user = User::findOrFail($id);
        return view('dashboard.user.uEdit', compact('user'));
     }
 
     // Mettre à jour l'utilisateur
     public function update(Request $request, $id)
     {
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:gestionnaire,client,admin',
         ]);
 
         $user = User::findOrFail($id);
         $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
         ]);
 
         return redirect()->route('dashboard.user.uIndex');
     }
 
     // Supprimer un utilisateur
     public function destroy($id)
     {
        $user = User::findOrFail($id);
        $user->delete();
 
        return redirect()->route('dashboard.user.uIndex');
     }
}
