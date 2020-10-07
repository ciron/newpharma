<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
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
        //
    }
    public function addproduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.add', compact('categories', 'brands'));
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
        $request->validate(
            [
                'product_name' => 'required|max:255|unique:products,product_name',
                'product_code' => 'required|max:255|unique:products,product_code',
                'product_quantity' => 'required|max:255',
                'category_id' => 'required|max:255',
                'brand_id' => 'required|max:255',
                'price' => 'required|max:255',
                'short_description' => 'required',
                'long_description' => 'required',
                'image_one' => 'required|max:255|mimes:jpg,jpeg,png,gif',
                'image_two' => 'required|max:255|mimes:jpg,jpeg,png,gif',
                'image_three' => 'required|max:255|mimes:jpg,jpeg,png,gif',
            ],
            [
                'product_name.required' => 'Medicine name is required',
                'product_code.required' => 'Medicine Code is required',
                'product_quantity.required' => 'Medicine Quantity is required',
                'category_id.required' => 'Medicine  category is required',
                'brand_id.required' => 'Medicine Brand is required',
                'price.required' => 'Medicine price is required',
                'short_description.required' => 'Short Description is required',
                'long_description.required' => 'Long Description is required',
                'image_one.required' => 'Main image  is required',
                'image_two.required' => 'preview 1 image  is required',
                'image_three.required' => 'Preview 2 image is required',
            ]
        );
        $image_one = $request->file('image_one');
        $name_gen = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
        $image_url1 = 'frontend/img/product/upload/' . $name_gen;

        $image_two = $request->file('image_two');
        $name_gen = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
        $image_url2 = 'frontend/img/product/upload/' . $name_gen;

        $image_three = $request->file('image_three');
        $name_gen = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
        $image_url3 = 'frontend/img/product/upload/' . $name_gen;

        Product::insert([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_quantity' => $request->product_quantity,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_one' => $image_url1,
            'image_two' => $image_url2,
            'image_three' => $image_url3,
            'created_at' => Carbon::now(),

        ]);
        return redirect()->back()->with('message', 'Medicine Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products = Product::latest()->get();
        return view('admin.product.manage', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
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
        $request->validate(
            [
                'product_name' => 'required|max:255',
                'product_code' => 'required|max:255',
                'product_quantity' => 'required|max:255',
                'category_id' => 'required|max:255',
                'brand_id' => 'required|max:255',
                'price' => 'required|max:255',
                'short_description' => 'required',
                'long_description' => 'required',
            ]);
        $id = $request->id;
        Product::find($id)->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_quantity' => $request->product_quantity,
            'price' => $request->price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'updated_at' => Carbon::now(),

        ]);
        return redirect()->Route('show.product')->with('medupdate', 'Medicine Update Successfully');
    }
    public function updateimage(Request $request){
        $product_id = $request->id;
        $old_one=$request->img_one;
        $old_two=$request->img_two;
        $old_three=$request->img_three;


        if($request->has('image_one') && $request->has('image_two') && $request->has('image_three')){
            unlink($old_one);
            unlink($old_two);
            unlink($old_three);
            $image_one = $request->file('image_one');
            $name_gen = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url1 = 'frontend/img/product/upload/' . $name_gen;
            Product::findOrFail($product_id)->update([
                'image_one' =>$image_url1,
                'updated_at' => Carbon::now(),
            ]);
            $image_two = $request->file('image_two');
            $name_gen = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url2 = 'frontend/img/product/upload/' . $name_gen;
            Product::findOrFail($product_id)->update([
                'image_two' =>$image_url2,
                'updated_at' => Carbon::now(),
            ]);
            $image_three = $request->file('image_three');
            $name_gen = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url3 = 'frontend/img/product/upload/' . $name_gen;
            Product::findOrFail($product_id)->update([
                'image_three' =>$image_url3,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->Route('show.product')->with('medupdate', 'All image Update Successfully');
         }

         if($request->has('image_one') && $request->has('image_two')){
            unlink($old_one);
            unlink($old_two);
            $image_one = $request->file('image_one');
            $name_gen = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url1 = 'frontend/img/product/upload/' . $name_gen;

            $image_two = $request->file('image_two');
            $name_gen = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url2 = 'frontend/img/product/upload/' . $name_gen;

            Product::findOrFail($product_id)->update([
                'image_one' =>$image_url1,
                'image_two' =>$image_url2,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->Route('show.product')->with('medupdate', '1st & 2nd image Update Successfully');
         }

         if($request->has('image_one') && $request->has('image_three')){
            unlink($old_one);
            unlink($old_three);
            $image_one = $request->file('image_one');
            $name_gen = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url1 = 'frontend/img/product/upload/' . $name_gen;

            $image_three = $request->file('image_three');
            $name_gen = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url3 = 'frontend/img/product/upload/' . $name_gen;

            Product::findOrFail($product_id)->update([
                'image_one' =>$image_url1,
                'image_three' =>$image_url3,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->Route('show.product')->with('medupdate', '1st & 3rd image Update Successfully');
         }

         if($request->has('image_two') && $request->has('image_three')){
            unlink($old_two);
            unlink($old_three);
            $image_two = $request->file('image_two');
            $name_gen = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url2 = 'frontend/img/product/upload/' . $name_gen;

            $image_three = $request->file('image_three');
            $name_gen = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
            $image_url3 = 'frontend/img/product/upload/' . $name_gen;

            Product::findOrFail($product_id)->update([
                'image_two' =>$image_url2,
                'image_three' =>$image_url3,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->Route('show.product')->with('medupdate', '2nd & 3rd image Update Successfully');
         }

        if($request->has('image_one') ){
        unlink($old_one);
        $image_one = $request->file('image_one');
        $name_gen = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
        $image_url1 = 'frontend/img/product/upload/' . $name_gen;
        Product::findOrFail($product_id)->update([
            'image_one' =>$image_url1,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->Route('show.product')->with('medupdate', '1st image Update Successfully');
     }

     if($request->has('image_two') ){
        unlink($old_two);
        $image_two = $request->file('image_two');
        $name_gen = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
        $image_url2 = 'frontend/img/product/upload/' . $name_gen;
        Product::findOrFail($product_id)->update([
            'image_two' =>$image_url2,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->Route('show.product')->with('medupdate', '2nd image Update Successfully');
     }

     if($request->has('image_three') ){
        unlink($old_three);
        $image_three = $request->file('image_three');
        $name_gen = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(270, 270)->save('frontend/img/product/upload/' . $name_gen);
        $image_url3 = 'frontend/img/product/upload/' . $name_gen;
        Product::findOrFail($product_id)->update([
            'image_three' =>$image_url3,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->Route('show.product')->with('medupdate', '3rd image Update Successfully');
     }


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allProduct =Product::findOrFail($id);
        $img_one = $allProduct->image_one;
        $img_two = $allProduct->image_two;
        $img_three = $allProduct->image_three;

        unlink($img_one);
        unlink($img_two);
        unlink($img_three);
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'Medicine Deleted Successfully');
    }
    public function inactive($id)
    {
        Product::find($id)->update(['status' => '0']);
        return redirect()->back()->with('inactive', 'Medicine Inactive Successfully');
    }
    public function active($id)
    {
        Product::find($id)->update(['status' => '1']);
        return redirect()->back()->with('active', 'Medicine Active Successfully');
    }
}
