<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
  <title>{{ config('app.name', 'Restaurant App') }}</title>

  <link href="{{ asset('assets/css/sb-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <div class="card-header"><strong>Error!</strong></div>
          <div class="card-body p-0">
            <div class="text-center error-main pb-3">
              <h1 class="m-0">500</h1>
              <h2>INTERNAL SERVER ERROR</h2>
              <h5>Oops! Something went wrong. </h5>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>