@extends('layouts.master')

@section('content')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="container">
      <div class="card p-2 mb-2">
        <div class="row">
          <div class="col-md-6">
            <i class="fas fa-table"></i>
            Details of <b>{{$package->package_name}}</b>
            <img class="img-thumbnail" src="{{ asset('/images/package/'.$package->package_image)}}"
              alt="Card image cap">
          </div>
          <div class="col-md-6">
            <h4 class="card-title">Details of {{$package->package_name}}</h4>
            <h5>Items</h5>
            <ul>
              <?php
                $items = json_decode($package->items);
                foreach($items as $key => $value){
                    $data = explode(':', $value);
                    $product_id =$data[0];
                    $quantity =$data[1];
                    foreach($products as $product){
                        if ($product_id == $product->id) {
                            echo"<li>".$product->name."(".$quantity.")</li>";
                        }
                    }
                }
            ?>
            </ul>
            <h4>Package Name: {{$package->package_name}}</h4>
            <h3>Price: {{$package->price}}</h3>
            <p class="card-text">Description: {{$package->description}}</p>
          </div>
          <div class="col-md-12 my-3 text-center">
            <a href="{{ route('package.index')}}" class="btn btn-primary">Back To List</a>
            <a href="{{ route('package.edit', $package->id)}}" class="btn btn-primary">Edit Package</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection