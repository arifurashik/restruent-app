@extends('layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="container">
			<div class="card">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Add Product Category</div>

				@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					{{ $error }}
				</div>
				@endforeach
				<div class="card-body">

					{!! Form::model ($categories ,array(
					'method' =>'put' ,
					'route' =>['product-category.update',$categories->id] ,
					'class' =>'form' ,
					)) !!}

					<div class="form-group">
						{!! Form::label('Category Name') !!}
						{!! Form::text('cat_name',old('cat_name'),array('class'=>'form-control')) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}
						<a href="{{ route('product-category.index')}}" class="btn btn-primary">Back To List</a>
					</div>
					{!! Form::close() !!}
				</div>
				<div class="card-footer small text-muted"></div>
			</div>
		</div>
	</div>
</div>
@endsection