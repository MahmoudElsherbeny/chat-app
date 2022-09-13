<?php

namespace App\Traits;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Product;
use App\Wishlist_item;

trait WishlistOptions
{
    //add to wishlist function - add products in wishlist using session if user not login
    public function AddToWishlistSession($prod_id) {
        $product = Product::findOrFail($prod_id);
        $wishlist = Cart::instance('wishlist');
        $item = $wishlist->content()->where('id', $prod_id)->first();
        if(!$item) {
            $wishlist->add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'weight' => 0,
            ]);
        }
    }

    //add to cart function - add products in cart using database if user login
    public function AddToWishlistDatabase($prod_id, $user_id) {
        $product = Product::findOrFail($prod_id);
        $item = Wishlist_item::Where(['user_id' => $user_id, 'product_id' => $prod_id])->first();
        if(!$item) {
            Wishlist_item::create([
                'user_id' => $user_id,
                'product_id' => $product->id
            ]);
        }
    }

    public function RemoveWishlistFromSessionToDatabase() {
        $wishlist_items = Cart::instance('wishlist')->content();
        if($wishlist_items->count() > 0) {
            foreach($wishlist_items as $item) {
                $prod = Wishlist_item::Where(['user_id' => Auth::user()->id, 'product_id' => $item->id])->first();
                if(!$prod) {
                    Wishlist_item::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $item->id
                    ]);
                }
            }

            Cart::instance('wishlist')->destroy();
        }
    }

    //remove product from wishlist session
    public function RemoveFromWishlistSession($row_id)
    {
        Cart::instance('wishlist')->remove($row_id);
        if(Cart::instance('wishlist')->count() == 0) {
            Cart::instance('wishlist')->destroy();
        }   
    }

    //remove product from wishlist database
    public function RemoveFromWishlistDatabase($row_id)
    {
        $wishlist_item = Wishlist_item::findOrFail($row_id);
        $wishlist_item->delete();
    }

    //clear all product from wishlist session
    public function ClearWishlistSession()
    {
        Cart::instance('wishlist')->destroy();
    }

    //clear all product from cart database
    public function ClearWishlistDatabase()
    {
        $wishlist_items = Wishlist_item::Where('user_id', Auth::user()->id)->get();
        $wishlist_items->each->delete();
    }

}
