<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;

class ProductTypeController extends Controller
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
        $types = ProductType::latest()->get();
        return view('product-type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product-type.create');
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
            'type_name' => 'required',

        ]);

        $data = [
            'type_name' => $request->get('type_name'),

        ];

        $ProductType = new ProductType($data);
        $ProductType->save();

        return \Redirect::route('product-type.index')->with('message', 'New Type Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = ProductType::find($id);

        return view('product-type.edit', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required',

        ]);

        $data = [
            'type_name' => $request->get('type_name'),

        ];

        $ProductType = ProductType::find($id);

        $ProductType->update($data);

        return \Redirect::route('product-type.index')->with('message', 'Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ProductType = ProductType::find($id);
        $ProductType->delete();
        return \Redirect::route('product-type.index')->with('message', 'Type Deleted Successfully!');
    }
}
