<?php

namespace App\Traits;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Cart_item;
use App\Product;
use App\Product_image;

trait CartOptions
{
    //add to cart function - add products in cart using session if user not login
    public function AddToCartSession($prod,$qty) {
        $product = Product::findOrFail($prod->id);
        $image = url(Product_image::ProductMainImage($product->id));
        $cart_item = Cart::instance('cart')->content()->where('id', $product->id)->first();

        $qty < 1 ? $qty = 1 : $qty;
        if($cart_item) {
            if(($qty + $cart_item->qty) > $product->quantity) { //check if total qty is over product quantity
                return Session::flash('error', $product->name.' doesn\'t have enough quantity in stock');
            }
            else {
                return Cart::instance('cart')->update($cart_item->rowId, ($qty + $cart_item->qty));
            }
        }
        else {
            if($qty <= $product->quantity) {
                Cart::instance('cart')->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $qty,
                    'price' => $product->price,
                    'weight' => 0,
                    'options' => ['image' => $image]
                ]);
            }
            else {
                return Session::flash('error', $product->name.' doesn\'t have enough quantity in stock');
            }
        }
    }

    //add to cart function - add products in cart using database if user login
    public function AddToCartDatabase($user,$prod,$qty) {
        $product = Product::findOrFail($prod->id);
        $image = url(Product_image::ProductMainImage($product->id));
        $cart_item = Cart_item::where(['user_id' => $user->id, 'product_id' => $product->id])->first();

        $qty < 1 ? $qty = 1 : $qty;
        if($cart_item) {
            if(($qty + $cart_item->qty) > $product->quantity) { //check if total qty is over product quantity
                return Session::flash('error', $product->name.' doesn\'t have enough quantity in stock');
            }
            else {
                $cart_item->update(['qty' => ($qty + $cart_item->qty)]);
            }
        }
        else {
            if($qty <= $product->quantity) {
                Cart_item::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'qty' => $qty,
                    'price' => $product->price,
                    'options' => ['image' => $image]
                ]);
            }
            else {
                return Session::flash('error', $product->name.' doesn\'t have enough quantity in stock');
            }
        }
    }

    public function RemoveCartFromSessionToDatabase() {
        $cart_items = Cart::instance('cart')->content();
        if($cart_items->count() > 0) {
            foreach($cart_items as $item) {
                $prod = Cart_item::Where(['user_id' => Auth::user()->id, 'product_id' => $item->id])->first();
                if($prod) {
                    $prod->update(['qty' => ($item->qty + $prod->qty)]);
                }
                else {
                    Cart_item::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $item->id,
                        'name' => $item->name,
                        'qty' => $item->qty,
                        'price' => $item->price,
                        'options' => $item->options
                    ]);
                }
            }

            Cart::instance('cart')->destroy();
        }
    }

    //update product quantity in cart session
    public function UpdateCartSession($row_id, $quantity)
    {
        $cart_item = Cart::instance('cart')->get($row_id);
        $product = Product::Where('id',$cart_item->id)->first();
        
        if($quantity <= $product->quantity) {
            Cart::instance('cart')->update($row_id, $quantity);
        }
        else {
            Session::flash('error', $product->name.' doesn\'t have enough quantity in stock');
        }
    }

    //update product quantity in cart database
    public function UpdateCartDatabase($row_id, $quantity)
    {
        $cart_item = Cart_item::findOrFail($row_id);
        $product = Product::Where('id',$cart_item->product_id)->first();
        
        if($quantity <= $product->quantity) {
            $cart_item->update(['qty' => $quantity]);
        }
        else {
            Session::flash('error', $product->name.' doesn\'t have enough quantity in stock');
        }
    }

    //remove product from cart session
    public function RemoveFromCartSession($row_id)
    {
        Cart::instance('cart')->remove($row_id);
        if(Cart::instance('cart')->count() == 0) {
            Cart::instance('cart')->destroy();
        }   
    }

    //remove product from cart database
    public function RemoveFromCartDatabase($row_id)
    {
        $cart_item = Cart_item::findOrFail($row_id);
        $cart_item->delete();
    }

    //clear all product from cart session
    public function ClearCartSession()
    {
        Cart::instance('cart')->destroy();
    }

    //clear all product from cart database
    public function ClearCartDatabase()
    {
        $cart_items = Cart_item::Where('user_id', Auth::user()->id)->get();
        $cart_items->each->delete();
    }

}
