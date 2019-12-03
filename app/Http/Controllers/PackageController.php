<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Package;
use App\Product;
use File;
use Image;

class PackageController extends Controller
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
        $packages = Package::latest()->get();
        $products = Product::all();
        return view('package.index', compact('packages', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('package.create', compact('products'));
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
            'package_name' => 'required|max:191',
            'package_image' => 'sometimes|file|image|max:1000',
            'price' => 'required',
            'description' => 'max:191',
        ]);

        //image savice
        if ($request->hasFile('package_image')) {

            $image = $request->file('package_image'); //Get File
            $nameslug = Str::slug($request->package_name);
            $currentDate = Carbon::now()->toDateString();

            $imgname = $nameslug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(400, 400)->save(public_path('images/package/' . $imgname));
        } else {
            $imgname = 'package_default_image.jpg';
        };

        $items = json_encode($request->items);

        $data = [
            'package_name' => $request->get('package_name'),
            'package_image' => $imgname,
            'items' => $items,
            'price' => $request->get('price'),
            'description' => $request->get('description'),
        ];

        $package = new Package($data);
        $package->save();

        return \Redirect::route('package.index')->with('message', 'New Package Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::find($id);
        $products = Product::all();
        return view('package.show', compact('package', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $packages = Package::find($id);
        $products = Product::all();
        return view('package.edit', compact('packages', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'package_name' => 'required|max:191',
            'package_image' => 'sometimes|file|image|max:1000',
            'price' => 'required',
            'description' => 'max:255',

        ]);
        $package = Package::find($id);

        if ($request->hasFile('package_image')) {
            $image = $request->file('package_image'); //Get File
            $nameslug = Str::slug($request->package_name);
            $currentDate = Carbon::now()->toDateString();

            $imgname = $nameslug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (public_path('images/package/' . $package->package_image) && $package->package_image != 'package_default_image.jpg') {
                File::delete(public_path('images/package/' . $package->package_image));
            }

            Image::make($image)->resize(400, 400)->save(public_path('images/package/' . $imgname));
        } else {
            $imgname = $package->package_image;
        };

        $items = json_encode($request->items);

        $data = [
            'package_name' => $request->get('package_name'),
            'package_image' => $imgname,
            'items' => $items,
            'price' => $request->get('price'),
            'description' => $request->get('description'),

        ];

        $package->update($data);

        return \Redirect::route('package.index')->with('message', 'Package Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        if (public_path('images/package/' . $package->package_image) && $package->package_image != 'package_default_image.jpg') {
            File::delete(public_path('images/package/' . $package->package_image));
        }
        $package->delete();

        return \Redirect::route('package.index')->with('message', 'Package Deleted Successfully!');
    }
}
