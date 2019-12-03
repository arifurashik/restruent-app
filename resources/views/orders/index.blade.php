@extends('layouts.master')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="container">
      {{-- /// --}}
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Orders
          <a href="{{ route('orders.create')}}" class="btn btn-success btn-sm float-right">Create Order</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> No. </th>
                  <th> Order No. </th>
                  <th> Type </th>
                  <th> Items </th>
                  <th> Price </th>
                  <th> Discount(%)</th>
                  <th> Total </th>
                  <th width="170"> Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th> No. </th>
                  <th> Order No. </th>
                  <th> Type </th>
                  <th width="200"> Items </th>
                  <th> {{$total_price}} </th>
                  <th width="100"> Discount(%)</th>
                  <th> {{$sub_total}} </th>
                  <th width="170"> Action</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach( $order as $orders )
                <tr>
                  <td>{{$loop->iteration}} </td>
                  <td>{{$orders->order_no}}</td>
                  <td>{{$orders->order_type}}</td>
                  <td class="data_ul">
                    @php
                    $items = json_decode($orders->items);
                    if (isset($items)) {
                    // echo "<b>Single Item</b>";
                    echo '<p>
                      <a class="btn btn-outline-success btn-sm" data-toggle="collapse"
                        href="#multiCollapseExample1' . $loop->index . '" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample1">Single Item</a>
                    </p>
                    <div class="collapse multi-collapse" id="multiCollapseExample1' . $loop->index . '">';
                      echo "<ul>";
                        foreach ($items as $key => $value) {
                        $data = explode(':', $value);
                        $product_id = $data[0];
                        $quantity = $data[1];
                        foreach ($products as $product) {
                        if ($product_id == $product->id) {
                        echo "<li>" . $product->name . "(" . $quantity . ")</li>";
                        }
                        }
                        }
                        echo "</ul>";
                      }
                      echo '</div>';

                    //Package item
                    $package_items = json_decode($orders->packages);
                    if (isset($package_items)) {
                    echo '<p>
                      <a class="btn btn-outline-success btn-sm" data-toggle="collapse"
                        href="#multiCollapseExample2' . $loop->index . '" role="button" aria-expanded="false"
                        aria-controls="multiCollapseExample1">Packages</a>
                    </p>
                    <div class="collapse multi-collapse" id="multiCollapseExample2' . $loop->index . '">';
                      echo "<ul>";
                        foreach ($package_items as $key => $value) {
                        $package_data = explode(':', $value);
                        $package_id = $package_data[0];
                        $quantity = $package_data[1];
                        foreach ($packages as $package) {
                        if ($package_id == $package->id) {
                        echo "<b>" . $package->package_name . "(" . $quantity . ")</b>";
                        echo "<ul>";
                          $package_items = json_decode($package->items);
                          foreach ($package_items as $key => $value) {
                          $data = explode(':', $value);
                          $product_id = $data[0];
                          $quantity = $data[1];
                          foreach ($products as $product) {
                          if ($product_id == $product->id) {
                          echo "<li>" . $product->name . "(" . $quantity . ")</li>";
                          }
                          }
                          }
                          echo "</ul>";
                        }
                        }
                        }
                        echo "</ul>
                    </div>";
                    }
                    @endphp
                  </td>
                  <td>{{$orders->price}}</td>
                  <td>{{$orders->discount}}</td>
                  <td>{{$orders->total}}</td>

                  <td>
                    <a href="{{ route('orders.show',$orders->id)}}" class="btn btn-success btn-sm">Details</a>

                    <a href="{{ route('orders.edit',$orders->id)}}" class="btn btn-primary btn-sm">Edit</a>

                    <a href="#deleteModal{{$orders->id}}" data-toggle="modal" class="btn btn-danger btn-sm"> Delete </a>
                    <!--Delete  Modal -->
                    <div class="modal fade" id="deleteModal{{$orders->id}}" tabindex="-1" role="dialog"
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
                            Are you sure want to delete <b>{{$orders->customer_name->name}}'s</b> Order ?
                          </div>
                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{ route('orders.destroy',$orders->id) }}" method="POST">
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
      {{-- /// end container--}}
    </div>
  </div>
</div>



@endsection