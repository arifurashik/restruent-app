@extends('layouts.master')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mt-3">
        <div class="card-header"><strong>Error!</strong></div>
        <div class="card-body p-0">
          <div class="text-center error-main pb-3">
            <h1 class="m-0">404</h1>
            <h2>PAGE NOT FOUND</h2>
            <h5>The page you are loking for is not found.</h5>
            <a href="{{ url('/')}}" class="btn btn-danger">Go To Home <i class="fas fa-angle-right"></i></a>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
  </div>
</div>
@endsection