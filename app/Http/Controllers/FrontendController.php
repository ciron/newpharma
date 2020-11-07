<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\Product;
use App\Category;
use App\cart;
use App\Review;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::where('status',1)->latest()->get();
        $sliderProduct = Product::where('status',1)->latest()->limit(3)->get();
        $Categories = Category::where('status',1)->latest()->get();
        return View('pages.index',compact('products','Categories','sliderProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function details($product_id)
     {
        // $proAvail =Product::where('product_id',$product_id)->where('product_quantity',$product_quantity)->get();
        // if ($proAvail >=1)
        // {
        //    return $product_quantity;
        // }else{
        //     echo 'out of stock';
        // }
        // $cart = cart::latest()->where('user_ip',request()->ip())->where('product_id',$product_id)->get();
        $review= Review::all()->where('product_id',$product_id)->first();
         $product =Product::find($product_id);
         $category_id=$product->category_id;
         $related_pro=Product::where('category_id',$category_id)->where('id','!=',$product_id)->latest()->get();

         return view('pages.preview',compact('product','related_pro','review'));
     }
    public function create(Request $request,$product_id)
    {
        return request()->ip();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check=cart::where('product_id',$request->product_id)->where('user_ip',request()->ip())->first();
        if($check){
            cart::where('product_id',$request->product_id)->where('user_ip',request()->ip())->update([
                'qty'=> $request->qty,
            ]);
            return redirect()->back()->with('success','Product update into cart');
        }else{
            cart::insert([
                'product_id'=>$request->product_id,
                'qty'=>$request->qty,
                'price'=>$request->price,
                'user_ip'=>request()->ip()
            ]);
            return redirect()->back()->with('cartadd','Product Added into cart');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function show(Frontend $frontend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function edit(Frontend $frontend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frontend $frontend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frontend $frontend)
    {
        //
    }
    public function storing(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'cus_review' => 'required',
                'rating' => 'required',

            ],
            [
                'cus_review.required' => 'Please give Your Comment About product',
                'rating.required' => 'Please select rating point',
            ]
            );
            Review::insert([
                    'user_id' => Auth::id(),
                    'product_id' =>$request->product_id,
                    'cus_review' =>$request->cus_review,
                    'rating' =>$request->rating,
                    'created_at' =>Carbon::now(),
                ]);
                return redirect()->back()->with('wishadd','Thank You for your Compliment');


        }else{
            return redirect()->route('login')->with('wishlogin','At first login your account');
        }
    }

}
