@extends('layouts.master')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="container">
      <div class="card mb-2">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Update Package Informetion</div>
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          {{ $error }}
        </div>
        @endforeach
        <div class="card-body">
          {!! Form::model($packages, array(
          'method' =>'put' ,
          'route' => ['package.update',$packages->id],
          'class' => 'form',
          'novalidate' => 'novalidate',
          'files' => true,

          )) !!}

          <div class="form-group">
            {!! Form::label('Package Name') !!}
            {!! Form::text('package_name',old('package_name'),array('class'=>'form-control','placeholder'=>'Name')) !!}
          </div>

          <ul id="added_item">
            @php
            $items = json_decode($packages->items);
            foreach ($items as $key => $value) {
            $data = explode(':', $value);
            $product_id = $data[0];
            $quantity = $data[1];

            foreach ($products as $product) {
            if ($product_id == $product->id) {
            echo "<li>".$product->name." X ". $quantity ." = ".$quantity*$product->price." BDT <input type='hidden'
                name='items[]' value='".$value."'> <button class='btn btn-sm text-danger' id='remove'>x</button></li>";
            }
            }
            }
            @endphp
          </ul>
          <div class="form-group">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              Add Item
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
                    <select name="item" id="item">
                      <option value="">Select Item</option>
                      @foreach( $products as $product )
                      <option value="{{$product->id}}">{{$product->name}} = {{$product->price}} </option>
                      @endforeach
                    </select>
                    <input type="number" name="quantity" id="quantity" placeholder="Quantity" />
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" id="add_item" class="btn btn-primary" data-dismiss="modal">Add Item</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end model -->
          </div>

          <div class="form-group">
            {!! Form::label('Price') !!}
            {!! Form::text('price', old('cat_id'),array('class'=>'form-control sub_total')) !!}
          </div>
          <div class="form-group">
            {!! Form::label('Description') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('Package Image') !!}
            {!! Form::file('package_image',null) !!}
          </div>
          <div class="form-group">
            <img src="{{ asset('/images/package/'.$packages->package_image)}}" alt="image" width='100' height='100' />
          </div>
          <div class="form-group">
            {!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}
            <a href="{{ route('package.index')}}" class="btn btn-primary">Back To List</a>
          </div>
        </div>
        {!! Form::close() !!}
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
  </div>
</div>
@endsection