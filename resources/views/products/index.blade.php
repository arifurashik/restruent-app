@extends('layouts.master')

@section('content')

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Products
    <a href="{{ route('product.create')}}" class="btn btn-success btn-sm float-right"> Create Product </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> No. </th>
            <th> Name</th>
            <th> Type</th>
            <th> Category</th>
            <th> Price</th>
            <th> Image</th>
            <th width="180"> Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th> No. </th>
            <th> Name</th>
            <th> Type</th>
            <th> Category</th>
            <th> Price</th>
            <th> Image</th>
            <th width="150"> Action</th>
          </tr>
        </tfoot>

        <tbody>
          @foreach( $products as $product )
          <tr>
            <td>{{$loop->iteration}} </td>
            <td>{{$product->name}} </td>
            <td>
              @if($product->types)
              {{$product->types->type_name}}
              @else
              Unidentified
              @endif
            </td>
            <td>
              @if($product->categories)
              {{$product->categories->cat_name}}
              @else
              Uncategorised
              @endif
            </td>
            <td>{{$product->price}}</td>
            <td>
              <img src="{{ asset('/images/product/'.$product->image_name)}}" alt="image" width='100' height='80' />
            </td>
            <td>
              <a href="{{ route('product.show',$product->id)}}" class="btn btn-primary btn-sm">Details</a>

              <a href="{{ route('product.edit',$product->id)}}" class="btn btn-primary btn-sm">Edit</a>

              <a href="#deleteModal{{$product->id}}" data-toggle="modal" class="btn btn-danger btn-sm"> Delete </a>
              <!--Delete  Modal -->
              <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog"
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
                      Are you sure want to delete {{$product->name}} ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route('product.destroy',$product->id) }}" method="POST">
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