<?php

namespace App\Http\Controllers;

use App\StockDetails;
use App\Product;
use App\TotalStocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class StockDetailsController extends Controller
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
        $stocks = StockDetails::latest()->get();
        return view('stockdetails.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('stockdetails.create', compact('products'));
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
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $data = [
            'product_id' => $request->get('product_id'),
            'quantity' => $request->get('quantity'),
        ];

        $stock = new StockDetails($data);
        $stock->save();

        if (TotalStocks::where('product_id', Input::get('product_id'))->exists()) {
            $totlatstock = TotalStocks::where('product_id', Input::get('product_id'))->first();

            $updated_data = [
                'quantity' => ($totlatstock->quantity + Input::get('quantity'))
            ];

            $totlatstock->update($updated_data);
        } else {
            $totlatstock = new TotalStocks($data);
            $totlatstock->save();
        }
        $message = 'New Stock ' . $stock->product->name . ', Quantity: ' . $stock->quantity . ' added successfully!';
        return redirect()->back()->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockDetails  $stockDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = StockDetails::find($id);
        $products = Product::all();
        return view('stockdetails.edit', compact('stock', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockDetails  $stockDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $stock = StockDetails::find($id);

        if ($request->get('product_id') == $request->get('product_id_old')) {
            $totlatstock = TotalStocks::where('product_id', Input::get('product_id'))->first();
            $quantity = $request->get('quantity') - $request->get('quantity_old');

            $updated_data = [
                'quantity' => ($totlatstock->quantity + $quantity)
            ];
            $totlatstock->update($updated_data);
        } else {
            if (TotalStocks::where('product_id', Input::get('product_id'))->exists()) {
                //remove old
                $totlatstock_remove = TotalStocks::where('product_id', Input::get('product_id_old'))->first();
                $updated_data_remove = [
                    'quantity' => ($totlatstock_remove->quantity - $request->get('quantity_old'))
                ];
                $totlatstock_remove->update($updated_data_remove);
                //add new
                $totlatstock_new = TotalStocks::where('product_id', Input::get('product_id'))->first();
                $updated_data_new = [
                    'quantity' => ($totlatstock_new->quantity + $request->get('quantity'))
                ];

                $totlatstock_new->update($updated_data_new);
            } else {
                //remove old
                $totlatstock_remove = TotalStocks::where('product_id', Input::get('product_id_old'))->first();
                $updated_data_remove = [
                    'quantity' => ($totlatstock_remove->quantity - $request->get('quantity_old'))
                ];
                $totlatstock_remove->update($updated_data_remove);
                //add new
                $updated_data_new = [
                    'product_id' =>  $request->get('product_id'),
                    'quantity' =>  $request->get('quantity')
                ];

                $totlatstock_new = new TotalStocks($updated_data_new);
                $totlatstock_new->save();
            }
        }

        $data = [
            'product_id' => $request->get('product_id'),
            'quantity' => $request->get('quantity'),
        ];

        $stock->update($data);

        return redirect('/stockdetails')->with('message', 'Stock Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockDetails  $stockDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $stock = StockDetails::find($id);
        $stock->delete();

        if (TotalStocks::where('product_id', Input::get('product_id'))->exists()) {
            $totlatstock_new = TotalStocks::where('product_id', Input::get('product_id'))->first();
            $updated_data_new = [
                'quantity' => ($totlatstock_new->quantity - $request->get('quantity'))
            ];
            $totlatstock_new->update($updated_data_new);
        }

        return redirect('/stockdetails')->with('message', 'Stock Deleted successfully!');
    }
}
