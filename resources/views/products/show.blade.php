@extends('layouts.master')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="container">
      <div class="card p-2 mb-2">
        <div class="row">
          <div class="col-md-6">
            <div>
              <i class="fas fa-table"></i>Details of <b>{{$product->name}}</b>
            </div>
            <img class="img-thumbnail" src="{{ asset('/images/product/'.$product->image_name)}}" alt="Card image cap">
          </div>
          <div class="col-md-6">
            <h5 class="card-title">Details of {{$product->name}}</h5>
            <ul>
              <li>Product Type: {{$product->types->type_name}}</li>
              <li>Product Categories: {{$product->categories->cat_name}}</li>
              <li>Price: {{$product->price}}</li>
            </ul>
            <p class="card-text">{{$product->description}}</p>
          </div>
          <div class="col-md-12 my-3 text-center">
            <a href="{{ route('product.index')}}" class="btn btn-primary">Back To List</a>
            <a href="{{ route('product.edit', $product->id)}}" class="btn btn-primary">Edit Product</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection