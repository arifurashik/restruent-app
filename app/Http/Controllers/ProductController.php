<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Category;
use App\Product;
use App\ProductType;
use File;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $category = Category::all();
        $type = ProductType::all();
        return view('products.create', compact('category', 'type'));
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
            'name' => 'required',
            'type_id' => 'required',
            'cat_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'product_image' => 'sometimes|file|image|max:1000'
        ]);


        //image savice
        if ($request->hasFile('product_image')) {

            $image = $request->file('product_image'); //Get File
            $nameslug = Str::slug($request->name);
            $currentDate = Carbon::now()->toDateString();

            $imgname = $nameslug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(400, 400)->save(public_path('images/product/' . $imgname));
        } else {
            $imgname = 'product_default_image.jpg';
        };
        //save Image to database
        $data = [
            'name' => $request->get('name'),
            'type_id' => $request->get('type_id'),
            'cat_id' => $request->get('cat_id'),
            'image_name' =>  $imgname,
            'price' => $request->get('price'),
            'description' => $request->get('description'),
        ];

        $product = new Product($data);
        $product->save();
        return \Redirect::route('product.index')->with('message', 'New Product Created Successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $type = ProductType::all();

        return view('products.edit', compact('product', 'category', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type_id' => 'required',
            'cat_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'product_image' => 'sometimes|file|image|max:1000'

        ]);
        $product = Product::find($id);

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image'); //Get File
            $nameslug = Str::slug($request->name);
            $currentDate = Carbon::now()->toDateString();

            $imgname = $nameslug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (public_path('images/product/' . $product->image_name) && $product->image_name != 'product_default_image.jpg') {
                File::delete(public_path('images/product/' . $product->image_name));
            }
            Image::make($image)->resize(400, 400)->save(public_path('images/product/' . $imgname));
        } else {
            $imgname = $product->image_name;
        };

        //update data to database
        $data = [
            'name' => $request->get('name'),
            'type_id' => $request->get('type_id'),
            'cat_id' => $request->get('cat_id'),
            'image_name' =>  $imgname,
            'price' => $request->get('price'),
            'description' => $request->get('description'),
        ];
        $product->update($data);
        return \Redirect::route('product.index')->with('message', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::find($id);
        if (public_path('images/product/' . $Product->image_name) && $Product->image_name != 'product_default_image.jpg') {
            File::delete(public_path('images/product/' . $Product->image_name));
        }
        $Product->delete();
        return \Redirect::route('product.index')->with('message', 'Product Deleted Successfully!');
    }
}
