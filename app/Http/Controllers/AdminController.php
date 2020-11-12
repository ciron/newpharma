<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use App\Order;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //    todays sellll
        $todaysell=Order::where('status',1)->whereDate('created_at', Carbon::today())->get();
        $tota= $todaysell->count();
        $sum=$todaysell->sum('totallamount');

        // total sell
        $totalsell=Order::where('status',1)->get();
        $total= $totalsell->count();
        $sumatio=$totalsell->sum('totallamount');

                // month
        $month=Order::whereMonth('created_at', Carbon::now()->month)
        ->get();
        $wetotall=$month->count();
        $wesum=$month->sum('totallamount');
         // year
        $year=Order::whereYear('created_at', Carbon::now()->year)
        ->get();
        $yetotall=$year->count();
        $yesum=$year->sum('totallamount');


        return view('admin.home',compact('tota','sum','total','sumatio','wetotall','wesum','yetotall','yesum'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }


}
