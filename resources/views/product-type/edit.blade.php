@extends('layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="container">
			<div class="card">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Update product type Informetion</div>

				@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					{{ $error }}
				</div>
				@endforeach

				<div class="card-body">
					{!! Form::model ($types ,array(
					'method' =>'put' ,
					'route' =>['product-type.update',$types->id] ,
					'class' =>'form' ,
					)) !!}

					<div class="form-group">
						{!! Form::label('Type Name') !!}
						{!! Form::text('type_name',old('type_name'),array('class'=>'form-control','placeholder'=>'Storable')) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}
						<a href="{{ route('product-type.index')}}" class="btn btn-primary">Back To List</a>
					</div>
					{!! Form::close() !!}
				</div>
				<div class="card-footer small text-muted"></div>
			</div>
		</div>
	</div>
</div>
@endsection