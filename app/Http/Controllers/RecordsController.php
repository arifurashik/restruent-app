<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Package;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

// use App\User;
// use App\TotalStocks;

class RecordsController extends Controller
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
        $order = Orders::whereDate('created_at', Carbon::today())->latest()->get();
        $sub_total = Orders::whereDate('created_at', Carbon::today())->sum('total');
        $total_price = Orders::whereDate('created_at', Carbon::today())->sum('price');
        $title = "Today's Order Records";

        return view('records.index', compact('order', 'products', 'packages', 'sub_total', 'total_price', 'title'));
    }

    public function custom_records(Request $request)
    {

        if ($request->date1 && $request->date2) {
            $date1 = $request->date1;
            $date2 = $request->date2;

            $order = Orders::whereBetween('created_at', [$date1, $date2])->latest()->get();

            $sub_total = Orders::whereBetween('created_at', [$date1, $date2])->sum('total');
            $total_price = Orders::whereBetween('created_at', [$date1, $date2])->sum('price');

            $products = Product::all();
            $packages = Package::all();
            $title = "Between Two Date Records";
            return view('records.custom_records', compact('order', 'products', 'packages', 'sub_total', 'total_price', 'title'));
        } else if ($request->month) {

            // $month = date("m", strtotime($request->month));
            $month = $request->month;
            $order = Orders::whereMonth('created_at', $month)->latest()->get();
            $sub_total = Orders::whereMonth('created_at', $month)->sum('total');
            $total_price = Orders::whereMonth('created_at', $month)->sum('price');

            $products = Product::all();
            $packages = Package::all();
            $title = "Monthly Order Records";

            return view('records.custom_records', compact('order', 'products', 'packages', 'sub_total', 'total_price', 'title'));
        } else if ($request->year) {

            $year = $request->year;
            $order = Orders::whereYear('created_at', $year)->latest()->get();
            $sub_total = Orders::whereYear('created_at', $year)->sum('total');
            $total_price = Orders::whereYear('created_at', $year)->sum('price');

            $products = Product::all();
            $packages = Package::all();
            $title = "Yearly Order Records";

            return view('records.custom_records', compact('order', 'products', 'packages', 'sub_total', 'total_price', 'title'));
        } else {
            $products = Product::all();
            $packages = Package::all();
            $order = Orders::whereDate('created_at', Carbon::today())->latest()->get();
            $sub_total = Orders::whereDate('created_at', Carbon::today())->sum('total');
            $total_price = Orders::whereDate('created_at', Carbon::today())->sum('price');
            $title = "Today's Order Records";

            return view('records.custom_records', compact('order', 'products', 'packages', 'sub_total', 'total_price', 'title'));
        }
    }
    //end class
}
