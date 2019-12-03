@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link active" href="#profile">Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#userpass">Password</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="profile" class="container tab-pane active">
					<div class="card">
						<div class="card-header">{{ __('Update User Profile') }}</div>
						<div class="card-body">
							<form action="{{ route('profile.update',$user->id) }}" method="POST">
								@csrf
								@method('patch')
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
									<div class="col-md-6">
										<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
											value="{{ old('name',$user->name) }}" autocomplete="name" autofocus>
										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
									<div class="col-md-6">
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
											name="email" value="{{ old('email',$user->email) }}" autocomplete="email">
										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary">
											{{ __('Update') }}
										</button>
										<a href="{{ url('/') }}" class="btn btn-primary">Back To Home</a>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer small text-muted"></div>
					</div>
				</div>{{-- end single tab --}}

				<div id="userpass" class="container tab-pane fade">
					<div class="card">
						<div class="card-header">{{ __('Update Profile Password') }}</div>
						<div class="card-body">
							<form method="POST" action="{{ route('profile.passwordupdate',$user->id) }}">
								@csrf
								@method('patch')
								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
									<div class="col-md-6">
										<input id="old_password" type="password"
											class="form-control @error('old_password') is-invalid @enderror" name="old_password">
										@error('old_password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
									<div class="col-md-6">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
											name="password" autocomplete="new-password">
										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="password-confirm"
										class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
									<div class="col-md-6">
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation"
											autocomplete="new-password">
									</div>
								</div>

								<div class="form-group row mb-0">
									<div class="col-md-6 offset-md-4">
										<button type="submit" class="btn btn-primary">
											{{ __('Change Password') }}
										</button>
										<a href="{{ url('/') }}" class="btn btn-primary">Back To Home</a>
									</div>
								</div>
							</form>
						</div>
						<div class="card-footer small text-muted"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection