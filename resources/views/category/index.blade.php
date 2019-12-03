@extends('layouts.master')

@section('content')

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Product Category
    <a href="{{route('product-category.create')}}" class="btn btn-success btn-sm float-right"> Create Category</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col"> No. </th>
            <th scope="col"> Category Name</th>
            <th scope="col"> Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th scope="col"> No. </th>
            <th scope="col"> Category Name</th>
            <th scope="col"> Action</th>
          </tr>
        </tfoot>

        <tbody class="text-center">
          @foreach( $categories as $category )
          <tr>
            <td scope="row"> {{$loop->iteration}} </td>
            <td>{{$category->cat_name}}</td>
            <td>
              <a href="{{ route('product-category.edit',$category->id)}}" class="btn btn-primary btn-sm">Edit</a> ||
              <a href="#deleteModal{{$category->id}}" data-toggle="modal" class="btn btn-danger btn-sm"> Delete </a>
              <!--Delete  Modal -->
              <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog"
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
                      Are you sure want to delete {{$category->id}} ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route('product-category.destroy',$category->id)}}" method="POST">
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