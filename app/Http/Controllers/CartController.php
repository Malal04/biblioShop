<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;

class CartController extends Controller
{
    public function getCart()
    {
        return response()->json(session('cart', []));
    }

    public function addToCart(Request $request)
    {
        $cart = session('cart', []);

        $book = Livre::findOrFail($request->id);

        if ($book->stock < 1) {
            return response()->json(['message' => 'Stock épuisé'], 400);
        }

        $index = collect($cart)->search(fn ($item) => $item['id'] === $book->id);

        if ($index !== false) {
            if ($cart[$index]['quantity'] < $book->stock) {
                $cart[$index]['quantity']++;
            } else {
                return response()->json(['message' => 'Stock insuffisant'], 400);
            }
        } else {
            $cart[] = [
                'id' => $book->id,
                'name' => $book->titre,
                'price' => $book->prix,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);

        return response()->json($cart);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session('cart', []);

        $cart = array_filter($cart, function ($item) use ($request) {
            return $item['id'] != $request->id;
        });

        session(['cart' => array_values($cart)]);

        return response()->json($cart);
    }

    public function decreaseQuantity(Request $request)
    {
        $cart = session('cart', []);

        $index = collect($cart)->search(fn ($item) => $item['id'] === $request->id);
        if ($index !== false && $cart[$index]['quantity'] > 1) {
            $cart[$index]['quantity']--;
        }

        session(['cart' => $cart]);

        return response()->json($cart);
    }

    public function placeOrder()
    {
        session()->forget('cart');
        return response()->json(['message' => 'Commande validée !']);
    }

    public function savePanier(Request $request)
    {
        // Sauvegarder le panier dans la session
        session(['cart' => $request->cart]);

        return response()->json(['success' => true]);
    }
    
}
