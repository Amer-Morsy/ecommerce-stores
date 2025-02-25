<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $products = auth()->user()
            ->wishlist()
            ->latest()
            ->paginate(PAGINATION_COUNT);

        return view('front.wishlists', compact('products'));
    }

    public function store()
    {

        if (!auth()->user()->wishlistHas(request('productId'))) {
            auth()->user()->wishlist()->attach(request('productId'));
            return response()->json(['status' => true, 'wished' => true]);
        }
        return response()->json(['status' => true, 'wished' => false]);
    }

    public function destroy()
    {
        auth()->user()->wishlist()->detach(request('productId'));
    }
}
