<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\cart;

class CartController extends Controller
{

    public function index(){
        $carts = cart::latest()->where('user_ip',request()->ip())->get();
        $subtotal = cart::all()->where('user_ip',request()->ip())->sum(function ($t){
            return $t->qty*$t->price;
        });
        return view('pages.cart',compact('carts','subtotal'));
    }


    public function store(Request $request){
        $check=cart::where('product_id',$request->product_id)->where('user_ip',request()->ip())->first();
        if($check){
            cart::where('product_id',$request->product_id)->where('user_ip',request()->ip())->increment('qty');
            return redirect()->back()->with('success','Product Added into cart');
        }else{
            cart::insert([
                'product_id'=>$request->product_id,
                'qty'=>1,
                'price'=>$request->price,
                'user_ip'=>request()->ip()
            ]);
            return redirect()->back()->with('cartadd','Product Added into cart');
        }
    }
    public function show($id){
        cart::where('id',$id)->where('user_ip',request()->ip())->delete();
        return redirect()->back()->with('cartdel','Product delete into cart');
    }
    public function update(Request $request){
        return $request->id;
    }
    public function edit(Request $request, $id){
        cart::where('id',$id)->where('user_ip',request()->ip())->update([
            'qty'=> $request->qty,
        ]);
        return redirect()->back()->with('cartup','Product Update into cart');
    }

}
