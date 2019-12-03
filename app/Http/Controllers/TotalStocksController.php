<?php

namespace App\Http\Controllers;

use App\TotalStocks;
use App\Product;
use Illuminate\Http\Request;

class TotalStocksController extends Controller
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
        $stocks = TotalStocks::latest()->get();
        return view('totalstocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/totalstocks');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockDetails  $stockDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = TotalStocks::find($id);
        $products = Product::all();
        return view('totalstocks.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TotalStocks  $totalStocks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required'
        ]);
        $stock = TotalStocks::find($id);
        $data = [
            'product_id' => $request->get('product_id'),
            'quantity' => $request->get('quantity'),
        ];
        $stock->update($data);
        return redirect('/totalstocks')->with('message', 'Stock Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TotalStocks  $totalStocks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { }
}
