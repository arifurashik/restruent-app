@extends('layouts.master')

@section('content')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="container">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Edit {{$orders->customer_name->name}}'s Order</div>

        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{ $error }}
        </div>
        @endforeach
        <div class="card-body">

          @foreach($errors->all() as $error)
          <div class="alert alert-danger">
            {{ $error }}
          </div>
          @endforeach


          {!! Form::model($orders, array(
          'route' => ['orders.update',$orders->id],
          'method' =>'put' ,
          'class' => 'form',
          'novalidate' => 'novalidate',
          'files' => true,
          )) !!}
          {!! Form::hidden('order_no') !!}
          <div class="form-group">
            {!! Form::label('Coustomer') !!}
            {!! Form:: select('customer_id', $users->pluck('name','id'),null, array('class'=>'form-control'))!!}
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
                    <h4 class="modal-title">Package Items</h4>
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

          <ul id="added_item">

            <?php
            $items = json_decode($orders->items);
            if (isset($items)) {
                foreach ($items as $key => $value) {

                    $data = explode(':', $value);

                    $product_id = $data[0];
                    $quantity = $data[1];

                    foreach ($products as $product) {
                        if ($product_id == $product->id) {
                            echo "<li>" . $product->name . " X " . $quantity . " = " . $quantity * $product->price . " BDT<input type='hidden' name='items[]' value='" . $value . "' />  <button  class='btn btn-sm text-danger' id='remove' >x</button></li>";
                        }
                    }
                }
            }
            ?>

          </ul>

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

          <ul id="added_packages">


            <?php
            $packages_data = json_decode($orders->packages);

            if (isset($packages_data)) {

                foreach ($packages_data as $key => $value) {

                    $data = explode(':', $value);

                    $package_id = $data[0];
                    $package_quantity = $data[1];

                    foreach ($packages as $package) {
                        if ($package_id == $package->id) {
                            echo "<li>" . $package->package_name . " X " . $package_quantity . " = " . $package_quantity * $package->price . " BDT <input type='hidden' name='packages[]' value='" . $value . "' />  <button  class='btn btn-sm text-danger' id='remove' >x</button></li>";
                        }
                    }
                }
            }
            ?>

          </ul>


          <div class="form-group">
            {!! Form::label('Total Price') !!}
            {!! Form::text('price', old('cat_id'),array('class'=>'form-control sub_total')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Vat ( % )') !!}
            {!! Form::number('vat', null, array('class'=>'form-control vat')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Discount ( % )') !!}
            {!! Form::number('discount', null, array('class'=>'form-control discount')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Total') !!}
            {!! Form::number('total', null, array('class'=>'form-control total')) !!}
          </div>

          <div class="form-group">
            {!! Form::label('Order type') !!}
            {!! Form:: select('order_type', $order_type,null, array('class'=>'form-control'))!!}
          </div>

          <div class="form-group">
            {!! Form::label('Status') !!}
            {!! Form:: select('status', $status, null, array('class'=>'form-control'))!!}
          </div>

          <div class="form-group">
            {!! Form::submit('Update Order', array('class'=>'btn btn-primary')) !!}
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