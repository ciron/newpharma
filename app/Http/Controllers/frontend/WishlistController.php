<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::where('user_id',Auth::id())->Latest()->get();
        return view('pages.wish',compact('wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        if(Auth::check()){
            $check=Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->where('quantity',1)->first();
            if($check){
                return redirect()->back()->with('wishalredy','Product Already Added into Wishlist');
            }else{
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' =>$product_id,
                    'quantity' => 1,
                ]);
                return redirect()->back()->with('wishadd','Product Added into Wishlist');
            }

        }else{
            return redirect()->route('login')->with('wishlogin','At first login your account');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        if(Auth::check()){
            $check=Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->where('quantity',1)->first();
            if($check){
                return redirect()->back()->with('wishalredy','Product Already Added into Wishlist');
            }else{
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' =>$product_id,
                    'quantity' => 1,
                ]);
                return redirect()->back()->with('wishadd','Product Added into Wishlist');
            }

        }else{
            return redirect()->route('login')->with('wishlogin','At first login your account');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Wishlist::find($id)->delete();
        return redirect()->back()->with('delete','Wishlist remove Successfully');
    }
}
