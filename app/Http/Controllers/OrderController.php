<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Frontend;
use App\Product;
use App\Category;
use App\cart;
use App\Review;
use App\Order;
use App\OrderDeatils;
use App\Wishlist;
use App\ShippingDetails;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $carts = cart::latest()->where('user_ip',request()->ip())->get();
            $subtotal = cart::all()->where('user_ip',request()->ip())->sum(function ($t){
                return $t->qty*$t->price;
            });

            Wishlist::truncate()->where('user_ip',request()->ip());
            // dd($carts);
            return view('pages.checkout',compact('carts','subtotal'));
        }else{
            return redirect()->route('login')->with('wishlogin','At first login your account');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Auth::check()){
            $request->validate([
                'cus_name'=>'required',
                'cus_phone'=>'required|max:11|min:11',
                'cus_address'=>'required',
                'cus_city'=>'required',
                'cus_email'=>'required',

            ],
            [
                'cus_name.required' => 'Please fill your name',
                'cus_phone.required' => 'Please give your Contact number',
                'cus_address.required' => 'Please give your Address',
                'cus_city.required' => 'Please give your City',
                'cus_email.required' => 'Please give your email',
            ]
            );
            $subtotal = cart::all()->where('user_ip',request()->ip())->sum(function ($t){
                return $t->qty*$t->price;
            });
            if (Session::has('coupon')){
                $discount=$subtotal*(Session()->get('coupon')['coupon_discount'] /100);
                $totall= $subtotal - $discount;
            } else{
                $totall=  $subtotal;
            }

            $data=array();
            $data['user_id']=Auth::id();
           $data['totallamount']=$totall;
           $data['status']=0;
           $data['created_at']=Carbon::now();

           $order_id =DB::table('orders')->insertGetId($data);

           $contents = cart::all();
           foreach ($contents as  $content) {
            $data=array();
            $data['order_id'] = $order_id;
            $data['product_name']=$content->product->product_name;
            $data['price']= $content->price;
            $data['qty']=$content->qty;
            $data['totallprice']=$content->price*$content->qty;
            $data['created_at'] =Carbon::now();
            DB::table('order_deatils')->insert($data);

            $data =array();
            $data['order_id'] =$order_id;
            $data['cus_name'] =$request->cus_name;
            $data['cus_phone'] =$request->cus_phone;
            $data['cus_address'] =$request->cus_address;
            $data['cus_city'] =$request->cus_city;
            $data['cus_email'] =$request->cus_email;
            $data['created_at'] =Carbon::now();
            $shipping = DB::table('shipping_details')->insert($data);


            //             'cus_name'=>,
            //             'cus_phone'=>$request->cus_phone,
            //             'cus_address'=>$request->cus_address,
            //             'cus_city'=>$request->cus_city,
            //             'cus_email'=>$request->cus_email,
           }

        //    $order_id= Order::insert([
        //         'user_id'=>Auth::id(),
        //         'totallamount'=> ,
        //         'status'=> 0,


        //     ]);
        //   $ship= ShippingDetails::insert([
        //             'order_id'=>$order_id,
        //             'cus_name'=>$request->cus_name,
        //             'cus_phone'=>$request->cus_phone,
        //             'cus_address'=>$request->cus_address,
        //             'cus_city'=>$request->cus_city,
        //             'cus_email'=>$request->cus_email,

        //     ]);

        //     $contents=cart::latest()->where('user_ip',request()->ip())->get();
        //     foreach ($contents as $content) {
        //         OrderDeatils::insert([
        //             'order_id'=>$order_id,
        //             'product_name'=>$content->product->product_name,
        //             'price'=>$content->price,
        //             'qty'=>$content->qty,
        //             'totallprice'=>$content->price*$content->qty,
        //         ]);
        //     }
            // dd($ship);
            if($shipping){
                cart::truncate()->where('user_ip',request()->ip());

                if (Session::has('coupon')){
                    Session::forget('coupon');
                }
                // dd($ship);
                return redirect()->route('order.product')->with('wishadd','Thank You for your Compliment');

            }
            return redirect()->back()->with('message','plese fill these filed');


        }else{
            return redirect()->route('login')->with('wishlogin','At first login your account');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $orderdeatils = DB::table('orders')
                        ->join('order_deatils','order_deatils.order_id','=','orders.id')
                        ->join('shipping_details','shipping_details.order_id','=','orders.id')
                        ->select('orders.*','order_deatils.*','shipping_details.*')
                        ->where('user_id',Auth::id())
                        ->get();
        // dd($orderdeatils);
        return view('pages.dashbord',compact('orderdeatils'));
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
        //
    }
}
