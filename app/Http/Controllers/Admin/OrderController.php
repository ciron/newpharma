<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Auth;
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
        $orderdeatilss = DB::table('orders')
        ->join('order_deatils','order_deatils.order_id','=','orders.id')
        ->join('shipping_details','shipping_details.order_id','=','orders.id')
        ->select('orders.*','order_deatils.*','shipping_details.*')
        ->where('status',1)
        ->get();
       // dd($orderdeatils);
     return view('admin.order.manage',compact('orderdeatilss'));

    }

    public function indexpending()
    {
        $orderdeatils = DB::table('orders')
        ->join('order_deatils','order_deatils.order_id','=','orders.id')
        ->join('shipping_details','shipping_details.order_id','=','orders.id')
        ->select('orders.*','order_deatils.*','shipping_details.*')
        ->where('status',0)
        ->get();
       // dd($orderdeatils);
     return view('admin.order.pending',compact('orderdeatils'));

    }

    /**
     * Show the form for creating a new resource.indexpending
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function aprove($order_id)
    {
        $check=Order::all()->where('id',$order_id)->where('status',0)->first();

        if($check){
            Order::where('id',$order_id)->increment('status');

            return redirect()->back()->with('sucsess','Shifted');
        }else{

            return redirect()->back()->with('sucsess','failed');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
