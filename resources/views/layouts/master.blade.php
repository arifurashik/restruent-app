<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
  <title>{{ config('app.name', 'Restaurant') }} App</title>

  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/sb-admin.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="{{ url('/')}}">Restaurant App</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        @if (Auth::check())
        <a class="nav-link dropdown-toggle" id="alertsDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bullhorn fa-fw"></i>
          <a title="Todays Order" href="{{ route('today-records')}}" class="count-badge">
            <span class="badge badge-danger">
              @php
              $order = App\Orders::whereDate('created_at', Carbon\Carbon::today())->count()
              @endphp
              {{ $order }}
            </span>
          </a>
        </a>
        @endif
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        @if (Auth::check())
        <a class="nav-link dropdown-toggle" id="messagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bullhorn fa-fw"></i>
          <a title="This Month Order" href="{{ url('/custom-records?month='.Carbon\Carbon::now()->month)}}"
            class="count-badge">
            <span class="badge badge-danger">
              @php
              $order = App\Orders::whereMonth('created_at', Carbon\Carbon::now()->month)->count()
              @endphp
              {{ $order }}
            </span>
          </a>
        </a>
        @endif
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      @else
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-cog"></i> Settings</a>
          <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal"><i
              class="fas fa-sign-out-alt"></i>
            Logout</a>
        </div>
      </li>
      @endguest
    </ul>
  </nav>

  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      @else
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Orders</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('orders.index')}}">All Orders</a>
          <a class="dropdown-item" href="{{ route('orders.create')}}">Create Orders</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Find Records</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('today-records')}}">Today's Records</a>
          <a class="dropdown-item" href="{{ route('custom_records')}}">Custom Records</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Product Type</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('product-type.index')}}">Type Lists</a>
          <a class="dropdown-item" href="{{ route('product-type.create')}}">Create Type</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Category</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('product-category.index')}}">Category List</a>
          <a class="dropdown-item" href="{{ route('product-category.create')}}">Add Category</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Products List</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('product.index')}}">All Product</a>
          <a class="dropdown-item" href="{{ route('product.create')}}">Create Product</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Packages List</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('package.index')}}">Packages</a>
          <a class="dropdown-item" href="{{ route('package.create')}}">Add Packages</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Create Stock</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('stockdetails.index')}}">Stock List</a>
          <a class="dropdown-item" href="{{ route('stockdetails.create')}}">Add Stock</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Total Stock</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('totalstocks.index')}}">Total Stock</a>
        </div>
      </li>
      @if (Auth::user()->role == 1)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-utensils"></i>
          <span>Register User</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="{{ route('users.index')}}">All User</a>
          <a class="dropdown-item" href="{{ route('users.create')}}">Add User</a>
        </div>
      </li>
      @endif
      @endguest
    </ul>
    <div id="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @if(Session::has('message'))
            <div class="alert alert-primary">
              {{ Session::get('message') }}
            </div>
            @endif
          </div>
        </div>
        @yield('content')
      </div>
      <!-- /.container-fluid -->
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{ date('Y') }} Restaurant | All Rights Reserved.</span> ||
            <span>Developed By <a href="http://www.arifurashik.me/">Md. Arifur Rahman</a></span>
          </div>
        </div>
      </footer>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
  <!-- Demo scripts for this page-->
  <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin.min.js') }}"></script>

  <script src="{{ asset('js/main.js') }}" defer></script>
  <script>
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
          $(this).tab('show');
        });
      });
  </script>
</body>

</html>