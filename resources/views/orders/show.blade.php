@extends('layouts.master')

@section('content')
<div>
  <div class="card-header"><i class="fas fa-table"></i> Order Details
    <a href="{{ route('orders.invoice', $orders->id) }}" class="btn btn-sm btn-primary float-right" target="_blank">See
      Invoice</a>
  </div>
  <div class="card">
    <div class="card-body">
      <p><b>Order Id:#</b>{{$orders->order_no}}</p>
      <p><b>Created By:</b> {{$orders->customer_name->name}}</p>
    </div>
  </div>

  <div class="row my-1">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body py-2">
          <h3>Single Item List</h3>
          @php
          $items = json_decode($orders->items);
          if (isset($items)) {
          echo "<ul>";
            foreach ($items as $key => $value) {

            $data = explode(':', $value);

            $product_id = $data[0];
            $quantity = $data[1];

            foreach ($products as $product) {
            if ($product_id == $product->id) {
            echo "<li>" . $product->name . "(" . $quantity . ")</li>";
            }
            }
            }
            echo "</ul>";
          }
          @endphp
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body py-2">
          <h3>Package List</h3>
          @php
          $package_items = json_decode($orders->packages);
          if (isset($package_items)) {
          echo "<ul>";
            foreach ($package_items as $key => $value) {

            $data = explode(':', $value);
            $package_id = $data[0];
            $quantity = $data[1];

            foreach ($packages as $package) {
            if ($package_id == $package->id) {
            echo "<li><b>" . $package->package_name . "(" . $quantity . ")</b></li>";
            echo "<ul>";
              $package_items = json_decode($package->items);

              foreach ($package_items as $key => $value) {
              $data = explode(':', $value);
              $product_id = $data[0];
              $quantity = $data[1];

              foreach ($products as $product) {
              if ($product_id == $product->id) {
              echo "<li>" . $product->name . "(" . $quantity . ")</li>";
              }
              }
              }
              echo "</ul>";
            }
            }
            }
            echo "</ul>";
          }
          @endphp
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body py-2">
          <h4>Price: {{$orders->price}} tk.</h4>
          <h5>Discount: {{$orders->discount}} %</h5>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body py-2">
          <h5>Total With Vat: {{$orders->total}} tk. ( {{$orders->vat}} %)</h5>
          <h5>Status: {{$orders->status}}</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer small text-muted"></div>
</div>
<div class="col-sm-6 my-2">
  <a href="{{ route('orders.index')}}" class="btn btn-sm btn-primary">Back To Order List</a>
  <a href="{{ route('orders.edit', $orders->id) }}" class="btn btn-sm btn-primary">Edit Order</a>
</div>


@endsection