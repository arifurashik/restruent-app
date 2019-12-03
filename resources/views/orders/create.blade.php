@extends('layouts.master')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="container">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Add Order
        </div>

        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{ $error }}
        </div>
        @endforeach
        <div class="card-body">
          {!! Form::open(array(
          'route' => 'orders.store',
          'class' => 'form',
          'novalidate' => 'novalidate',
          'files' => true,
          )) !!}
          {!! Form::hidden('order_no', mt_rand(1000000, 9999999)) !!}
          <div class="form-group">
            {!! Form::label('Order By') !!}
            <select name="customer_id" class="form-control">
              @foreach ($users as $user)
              <option value="{{ $user->id }}" {{ $user->id==Auth::id() ? 'selected': '' }}>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Add Items
            </button>
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Single Items</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    <select id="item">
                      <option value="">Select Item</option>
                      @foreach( $products as $product )
                      <option value="{{$product->id}}">{{$product->name}} = {{$product->price}}</option>
                      @endforeach
                    </select>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" />
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <p class="message mr-auto text-danger"></p>
                    <button type="button" id="add_item" class="btn btn-primary">Add Item</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end model -->
          </div>
          <!-- package item modal -->
          <ul id="added_item"></ul>
          <div class="form-group">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
              Add Package
            </button>
            <!-- The Modal -->
            <div class="modal fade" id="myModal1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Package Items</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                    <select id="packages">
                      <option value="">Select Item</option> -->
                      @foreach( $packages as $package )
                      <option value="{{$package->id}}">{{$package->package_name}} = {{$package->price}}</option>
                      @endforeach
                    </select>
                    <input type="number" name="package_quantity" id="package_quantity" placeholder="Quantity" />
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <p class="message1 mr-auto text-danger"></p>
                    <button type="button" id="add_package" class="btn btn-primary">Add package</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end model -->
          </div>

          <ul id="added_packages"></ul>

          <div class="form-group">
            {!! Form::label('Total Price') !!}
            {!! Form::text('price', old('price'),array('class'=>'form-control sub_total')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Vat ( % )') !!}
            {!! Form::number('vat', 15, array('class'=>'form-control vat')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Discount ( % )') !!}
            {!! Form::number('discount', 0, array('class'=>'form-control discount')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Total') !!}
            {!! Form::number('total', 0, array('class'=>'form-control total')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Order type') !!}
            <select name="order_type" class="form-control">
              <option value="Offline">Offline Order</option>
              <option value="Online">Online Order</option>
            </select>
          </div>

          <div class="form-group">
            {!! Form::label('Status') !!}
            {!! Form:: select('status', $status, null, array('class'=>'form-control'))!!}
          </div>

          <div class="form-group">
            {!! Form::submit('Submit', array('class'=>'btn btn-primary')) !!}
            <a href="{{ route('orders.index')}}" class="btn btn-primary">Back To List</a>
          </div>
          {!! Form::close() !!}
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
  </div>
</div>
@endsection