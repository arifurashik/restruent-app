@extends('layouts.master')

@section('content')

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Product Type
    <a href="{{route('product-type.create')}}" class="btn btn-success btn-sm float-right"> Create Type</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> No. </th>
            <th>Type Name</th>
            <th> Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th> No. </th>
            <th>Type Name</th>
            <th> Action</th>
          </tr>
        </tfoot>

        <tbody>
          @foreach( $types as $type )
          <td> {{$loop->iteration}} </td>
          <td> {{$type->type_name}}</td>

          <td> <a href="{{ route('product-type.edit',$type->id)}}" class="btn btn-success btn-sm"> Edit </a> ||
            <a href="#deleteModal{{$type->id}}" data-toggle="modal" class="btn btn-danger btn-sm"> Delete </a>
            <!--Delete  Modal -->
            <div class="modal fade" id="deleteModal{{$type->id}}" tabindex="-1" role="dialog"
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
                    Are you sure want to delete {{$type->type_name}} ?
                  </div>
                  <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('product-type.destroy',$type->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" name="submit" class="btn btn-danger">Parmanent Delete</button>
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

@endsection