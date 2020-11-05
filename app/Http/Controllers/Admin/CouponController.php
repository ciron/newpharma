<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index',compact('coupons'));
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
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'coupon_discount' => 'required',

        ],
        [
            'coupon_name.required' => 'Please fillup this filed',
            'coupon_discount.required' => 'Please fillup discount filed',
        ]
        );
        Coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message','Coupon Added Successfully');
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
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'coupon_discount' => 'required',

        ],
        [
            'coupon_name.required' => 'Please fillup this filedssss',
            'coupon_discount.required' => 'Please fillup discount filed',
        ]
        );
        $coupon_id = $request->id;
        Coupon::find($coupon_id)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->Route('admin.coupon')->with('coupupdate','Coupon Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return redirect()->back()->with('delete','Coupon Deleted Successfully');
    }
    public function inactive($id)
    {
        Coupon::find($id)->update(['status'=>'0']);
        return redirect()->back()->with('inactive','Coupon Inactive Successfully');
    }
    public function active($id)
    {
        Coupon::find($id)->update(['status'=>'1']);
        return redirect()->back()->with('active','Coupon Active Successfully');
    }
}
