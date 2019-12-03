@extends('layouts.master')

@section('content')

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Packages
    <a href="{{ route('package.create')}}" class="btn btn-success btn-sm float-right">Create Package</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> No. </th>
            <th> Package Name </th>
            <th> Package Items </th>
            <th> Price </th>
            <th> Image </th>
            <th width="180"> Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th> No. </th>
            <th> Package Name </th>
            <th> Package Items </th>
            <th> Price </th>
            <th> Image </th>
            <th width="150"> Action</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach( $packages as $package )
          <tr>
            <td>{{$loop->iteration}} </td>
            <td>{{$package->package_name}} </td>
            <td>
              <?php
              $items = json_decode($package->items);
              foreach ($items as $key => $value) {
              $data = explode(':', $value);
              $product_id = $data[0];
              $quantity = $data[1];

              foreach ($products as $product) {
              if ($product_id == $product->id) {
              echo $product->name . "(" . $quantity . ")</br>";
              }
              }
              }
              ?>
            </td>
            <td>{{$package->price}}</td>
            <td><img src="{{ asset('/images/package/'.$package->package_image)}}" alt="image" width='100' height='80' />
            </td>
            <td>
              <a href="{{ route('package.show',$package->id)}}" class="btn btn-primary btn-sm">Details</a>
              <a href="{{ route('package.edit',$package->id)}}" class="btn btn-primary btn-sm">Edit</a>
              <a href="#deleteModal{{$package->id}}" data-toggle="modal" class="btn btn-danger btn-sm"> Delete </a>
              <!--Delete  Modal -->
              <div class="modal fade" id="deleteModal{{$package->id}}" tabindex="-1" role="dialog"
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
                      Are you sure want to delete {{$package->package_name}} ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <form action="{{ route('package.destroy',$package->id) }}" method="POST">
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