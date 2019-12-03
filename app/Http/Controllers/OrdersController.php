<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Package;
use App\Product;
use App\TotalStocks;
use App\User;
use Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
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
        $products = Product::all();
        $packages = Package::all();
        $sub_total = Orders::sum('total');
        $total_price = Orders::sum('price');
        $order = Orders::latest()->get();
        return view('orders.index', compact('order', 'products', 'packages', 'sub_total', 'total_price'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $status = [
            'Active' => 'Active',
            'Inactive' => 'Inactive',
        ];

        $products = Product::all();
        $packages = Package::all();

        if (Auth::user()->role == 1) {
            $users = User::all();
        } else {
            $users = User::whereIn('id', [Auth::id()])->get();
        }
        return view('orders.create', compact('products', 'packages', 'users', 'status'));
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
            'customer_id' => 'required',
            'price' => 'required',
            'total' => 'required',

        ]);

        $data = [
            'customer_id' => $request->get('customer_id'),
            'order_no' => $request->get('order_no'),
            'items' => json_encode($request->items),
            'packages' => json_encode($request->packages),
            'price' => $request->get('price'),
            'vat' => $request->get('vat'),
            'discount' => $request->get('discount'),
            'total' => $request->get('total'),
            'order_type' => $request->get('order_type'),
            'status' => $request->get('status'),

        ];

        $order = new Orders($data);
        $order->save();

        if ($request->items) {

            foreach ($request->items as $key => $value) {

                $item_data = explode(':', $value);
                $product_id = $item_data[0];
                $quantity = $item_data[1];

                $totalstocks = TotalStocks::where('product_id', $product_id)->first();

                if ($totalstocks) {
                    $stock_data = [
                        'quantity' => $totalstocks->quantity - $quantity,
                    ];

                    $totalstocks->update($stock_data);
                }
            }
        }

        if ($request->packages) {
            foreach ($request->packages as $key => $value) {

                $package_data = explode(':', $value);
                $package_id = $package_data[0];
                $package_quantity = $package_data[1];

                $package = Package::find($package_id);
                $package_items = json_decode($package->items);

                foreach ($package_items as $key => $value) {
                    $product_data = explode(':', $value);
                    $product_id = $product_data[0];
                    $quantity = $product_data[1];

                    $totalstocks = TotalStocks::where('product_id', $product_id)->first();
                    if ($totalstocks) {

                        $stock_data = [
                            'quantity' => $totalstocks->quantity - ($quantity * $package_quantity),
                        ];

                        $totalstocks->update($stock_data);
                    }
                }
            }
        }
        return \Redirect::route('orders.index')->with('message', 'New Order Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders, $id)
    {
        $products = Product::all();
        $packages = Package::all();
        $orders = Orders::find($id);
        return view('orders.show', compact('orders', 'products', 'packages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders, $id)
    {
        $order_type = [
            'Online' => 'Online',
            'Offline' => 'Offline',
        ];

        $status = [
            'Active' => 'Active',
            'Inactive' => 'Inactive',
        ];

        $orders = Orders::find($id);
        $products = Product::all();
        $packages = Package::all();

        if (Auth::user()->role == 1) {
            $users = User::all();
        } else {
            $users = User::whereIn('id', [Auth::id()])->get();
        }

        return view('orders.edit', compact('orders', 'products', 'packages', 'users', 'order_type', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required',
            'price' => 'required',
            'total' => 'required',

        ]);

        $order = Orders::find($id);

        $data = [
            'customer_id' => $request->get('customer_id'),
            'order_no' => $request->get('order_no'),
            'items' => json_encode($request->items),
            'packages' => json_encode($request->packages),
            'price' => $request->get('price'),
            'vat' => $request->get('vat'),
            'discount' => $request->get('discount'),
            'total' => $request->get('total'),
            'order_type' => $request->get('order_type'),
            'status' => $request->get('status'),

        ];

        //single data old if nothing change 

        $old_item = json_decode($order->items);
        if (isset($old_item)) {

            foreach ($old_item as $key => $value) {
                $item_data1 = explode(':', $value);
                $old_product_id = $item_data1[0];
                $old_quantity = $item_data1[1];


                $totalstocks = TotalStocks::where('product_id', $old_product_id)->first();

                if ($totalstocks) {

                    $stock_data = [
                        'quantity' => $totalstocks->quantity + $old_quantity,
                    ];

                    $totalstocks->update($stock_data);
                }
            }
        }


        //new data change if change 

        if (isset($request->items)) {

            foreach ($request->items as $key => $value) {
                $item_data2 = explode(':', $value);
                $new_product_id = $item_data2[0];
                $new_quantity = $item_data2[1];

                $totalstocks = TotalStocks::where('product_id', $new_product_id)->first();

                if ($totalstocks) {

                    $stock_data = [
                        'quantity' => $totalstocks->quantity - $new_quantity,
                    ];

                    $totalstocks->update($stock_data);
                }
            }
        }


        //old package nothing change



        $old_packages = json_decode($order->packages);
        if (isset($old_packages)) {

            foreach ($old_packages as $key => $value) {

                $package_items = explode(':', $value);
                $old_package_id = $package_items[0];
                $old_package_quantity = $package_items[1];

                $package = Package::find($old_package_id);

                $package_items = json_decode($package->items);


                if (isset($package_items)) {

                    foreach ($package_items as $key => $value) {

                        $package_items1 = explode(':', $value);
                        $old_product_id1 = $package_items1[0];
                        $old_product_quantity = $package_items1[1];

                        $quantity_calculation = $old_product_quantity * $old_package_quantity;

                        $totalstocks = TotalStocks::where('product_id', $old_product_id1)->first();


                        if ($totalstocks) {

                            $stock_data = [
                                'quantity' => $totalstocks->quantity + $quantity_calculation,
                            ];

                            $totalstocks->update($stock_data);
                        }
                    }
                }
            }
        }



        //new data if change 
        if (isset($request->packages)) {

            foreach ($request->packages as $key => $value) {

                $package_items1 = explode(':', $value);
                $new_package_id = $package_items1[0];
                $new_package_quantity = $package_items1[1];

                $package = Package::find($new_package_id);

                $package_items_new = json_decode($package->items);


                if (isset($package_items_new)) {

                    foreach ($package_items_new as $key => $value) {

                        $package_items2 = explode(':', $value);
                        $old_product_id2 = $package_items2[0];
                        $old_product_quantity = $package_items2[1];

                        $quantity_calculation = $old_product_quantity * $new_package_quantity;

                        $totalstocks = TotalStocks::where('product_id', $old_product_id2)->first();


                        if ($totalstocks) {

                            $stock_data = [
                                'quantity' => $totalstocks->quantity - $quantity_calculation,
                            ];

                            $totalstocks->update($stock_data);
                        }
                    }
                }
            }
        }


        $order->update($data);
        return \Redirect::route('orders.index')->with('message', 'Order Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders, $id)
    {
        $order = Orders::find($id);
        //single data old if nothing change
        $old_item = json_decode($order->items);
        if (isset($old_item)) {

            foreach ($old_item as $key => $value) {
                $item_data1 = explode(':', $value);
                $old_product_id = $item_data1[0];
                $old_quantity = $item_data1[1];

                $totalstocks = TotalStocks::where('product_id', $old_product_id)->first();

                if ($totalstocks) {

                    $stock_data = [
                        'quantity' => $totalstocks->quantity + $old_quantity,
                    ];

                    $totalstocks->update($stock_data);
                }
            }
        }

        //old package nothing change
        $old_packages = json_decode($order->packages);
        if (isset($old_packages)) {

            foreach ($old_packages as $key => $value) {

                $package_items = explode(':', $value);
                $old_package_id = $package_items[0];
                $old_package_quantity = $package_items[1];

                $package = Package::find($old_package_id);

                $package_items = json_decode($package->items);

                if (isset($package_items)) {

                    foreach ($package_items as $key => $value) {

                        $package_items1 = explode(':', $value);
                        $old_product_id1 = $package_items1[0];
                        $old_product_quantity = $package_items1[1];

                        $quantity_calculation = $old_product_quantity * $old_package_quantity;

                        $totalstocks = TotalStocks::where('product_id', $old_product_id1)->first();

                        if ($totalstocks) {

                            $stock_data = [
                                'quantity' => $totalstocks->quantity + $quantity_calculation,
                            ];

                            $totalstocks->update($stock_data);
                        }
                    }
                }
            }
        }

        $order->delete();

        return \Redirect::route('orders.index')->with('message', 'Order Deleted Successfully!');
    }
    public function invice($id)
    {
        $orders = Orders::find($id);
        $products = Product::all();
        $packages = Package::all();
        return view('orders.invoice', compact('orders', 'products', 'packages'));
    }
}
