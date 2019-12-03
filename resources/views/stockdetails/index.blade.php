@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <!-- DataTables Example -->
    <div class="card mt-3 mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i> Stock Details
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
                <th>Date</th>
                <th width="150">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Actions</th>
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
                <td>{{$stock->created_at}}</td>
                <td>
                  <a href="{{ route('stockdetails.edit',$stock->id)}}" class="btn btn-primary btn-sm">Edit</a> ||
                  <a href="#deleteModal{{$stock->id}}" data-toggle="modal" class="btn btn-danger btn-sm"> Delete </a>
                  <!--Delete  Modal -->
                  <div class="modal fade" id="deleteModal{{$stock->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure want to delete Stock ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <form action="{{ route('stockdetails.destroy', $stock->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger">Parmanent Delete</button>
                            {!! Form::hidden('product_id', $stock->product_id) !!}
                            {!! Form::hidden('quantity', $stock->quantity) !!}
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
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