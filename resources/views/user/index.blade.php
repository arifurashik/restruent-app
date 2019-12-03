@extends('layouts.master')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="container">

      <div class="card">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Product Category
          <a href="{{ route('users.create')}}" class="btn btn-success btn-sm float-right">Create User</a>
        </div>

        <div class="card-body">
          @include('partials.message')
          <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-center">
              <tr>
                <th scope="col"> No. </th>
                <th scope="col"> Name</th>
                <th scope="col"> Email</th>
                <th scope="col"> Action</th>
              </tr>
            </thead>
            <tfoot class="text-center">
              <tr>
                <th scope="col"> No. </th>
                <th scope="col"> Name</th>
                <th scope="col"> Email</th>
                <th scope="col"> Action</th>
              </tr>
            </tfoot>

            <tbody class="text-center">
              @foreach( $users as $user )
              <tr>
                <td scope="row"> {{$loop->iteration}} </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                  <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a> |
                  <a href="{{ route('users.password',$user->id)}}" class="btn btn-primary btn-sm">Manage Password</a> |
                  <a href="#deleteModal{{$user->id}}" data-toggle="modal" class="btn btn-danger btn-sm"> Delete </a>
                  <!--Delete  Modal -->
                  <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" role="dialog"
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
                          Are you sure you want to delete user {{$user->name}} ?
                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <form action="{{ route('users.destroy',$user->id)}}" method="POST">
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
        <div class="card-footer small text-muted"></div>

      </div>
    </div>
  </div>
  @endsection