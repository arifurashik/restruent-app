@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-sm-12">


    <!-- DataTables Example -->
    <div class="card mt-3 mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i> Total Stock
        <a href="{{ route('stockdetails.create')}}" class="btn btn-sm btn-success float-right">Add Stock</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Updated Time</th>
                <th width="150">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Updated Time</th>
                <th width="150">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($stocks as $stock)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                  @if($stock->product)
                  {{$stock->product->name}}
                  @endif
                </td>
                <td>{{$stock->quantity}}</td>
                <td>{{$stock->updated_at}}</td>
                <td>
                  <a href="{{ route('totalstocks.edit',$stock->id)}}" class="btn btn-sm btn-primary">Edit</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted"></div>
    </div>
  </div>
</div>
@endsection