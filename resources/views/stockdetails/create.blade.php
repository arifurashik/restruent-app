@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-sm-12">

		<div class="card mt-3 mb-3">
			<div class="card-header">
				<i class="fas fa-table"></i> Add New Stock
			</div>
			<div class="card-body">

				{!! Form::open(
				array(
				'route' => 'stockdetails.store',
				'class' => 'form'
				))
				!!}

				<div class="form-group">
					{!! Form::label('Product Name') !!}
					{!! Form::select('product_id',$products->pluck('name','id')->all(), null,
					array('required', 'class'=>'form-control')) !!}
				</div>

				<div class="form-group">
					{!! Form::label('Quantity') !!}
					{!! Form::number('quantity', null,
					array('required', 'class'=>'form-control')) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Add Stock', array('class'=>'btn btn-primary')) !!}
					<a href="{{ route('stockdetails.index')}}" class="btn btn-primary">Back To List</a>
				</div>
				{!! Form::close() !!}

			</div>
			<div class="card-footer small text-muted"></div>
		</div>

	</div>
</div>
@endsection