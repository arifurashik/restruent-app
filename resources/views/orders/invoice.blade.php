<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
  <title> Invoice | {{ config('app.name', 'Invoice') }}</title>
  <!-- Main CSS-->
  {!! HTML::style('assets/css/invoice.css') !!}
  <style>
    .total span {
      color: darkmagenta;
    }
  </style>
</head>

<body>

  <!-- Print Button -->
  <a href="javascript:window.print()" class="print-button">Print this invoice</a>

  <!-- Invoice -->
  <div id="invoice">

    <!-- Client & Supplier -->
    <div class="row">
      <div class="col-md-12 text-center mb-3">
        <h1 style="color:coral"><b>Mohammadpur cafe<b></h1>
      </div>
      <div class="col-md-6">
        <div id="logo">
          <h2>Invoice</h2>
        </div>
      </div>
      <div class="col-md-6 text-right">
        <div><b>Order Id:#</b>{{$orders->order_no}}</div>
        <div><b>Created By:</b> {{$orders->customer_name->name}}</div>
      </div>
    </div>


    <!-- Invoice -->
    <div class="row">
      <div class="col-md-6">
        <div class="">
          <h3 style="color:coral">Single Item List</h3>
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
      <div class="col-md-6">
        <div class="py-2">
          <h3 style="color:coral">Package List</h3>
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
    </div><!-- end row -->
    <!-- new row -->
    <div class="row">
      <div class="col-sm-6 total">
        <h5>Price: <span>{{$orders->price}} Tk.</span></h5>
        <h5>Discount: <span>{{$orders->discount}} %</span></h5>
        <h5>Total With Vat: <span>{{$orders->total}} Tk. ( {{$orders->vat}} %)</span></h5>
      </div>
    </div><!-- end row -->

    <!-- Footer -->
    <div class="row text-center">
      <div class="col-md-12">
        <ul id="footer">
          <li><strong>Suplier:</strong> <span>Mohammadpur cafe.</span></li>
          <li>01717-796906</li>
        </ul>
      </div>
    </div>
    <!-- End Footer -->
  </div>
</body>

</html>