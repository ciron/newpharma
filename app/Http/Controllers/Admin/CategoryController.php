<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Category;

class CategoryController extends Controller
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
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));
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
            'category_name' => 'required|unique:categories,category_name',

        ],
        [
            'category_name.required' => 'Please fillup this filed',
        ]
        );
        Category::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message','Category Added Successfully');
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
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
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
            'category_name' => 'required|unique:categories,category_name',

        ],
        [
            'category_name.required' => 'Please fillup this filedssss',
        ]
        );
        $cat_id = $request->id;
        Category::find($cat_id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->Route('admin.category')->with('catupdate','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('delete','Category Deleted Successfully');
    }
    public function inactive($id)
    {
        Category::find($id)->update(['status'=>'0']);
        return redirect()->back()->with('inactive','Category Inactive Successfully');
    }
    public function active($id)
    {
        Category::find($id)->update(['status'=>'1']);
        return redirect()->back()->with('active','Category Active Successfully');
    }
}
