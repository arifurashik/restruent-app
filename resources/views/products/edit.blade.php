@extends('layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="container">
			<div class="card mb-2">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Update product Informetion</div>


				@foreach($errors->all() as $error)
				<div class="alert alert-danger">
					{{ $error }}
				</div>
				@endforeach

				<div class="card-body">

					{!! Form::model($product ,array(
					'method' =>'patch' ,
					'route' =>['product.update',$product->id],
					'class' => 'form',
					'novalidate' => 'novalidate',
					'files' => true,
					)) !!}

					<div class="form-group">
						{!! Form::label('Name') !!}
						{!! Form::text('name',old('name'),array('class'=>'form-control','placeholder'=>'Name')) !!}
					</div>
					<div class="form-group">
						{!! Form::label('Type') !!}
						{!! Form:: select('type_id', $type->pluck('type_name','id')->all(),null, array('class'=>'form-control'))!!}

					</div>
					<div class="form-group">
						{!! Form::label('Catagory') !!}
						{!! Form:: select('cat_id', $category->pluck('cat_name','id')->all(),null,
						array('class'=>'form-control'))!!}
					</div>
					<div class="form-group">
						{!! Form::label('Price') !!}
						{!! Form::text('price', old('cat_id'),array('class'=>'form-control','placeholder'=>'Catagory')) !!}
					</div>


					<div class="form-group">
						{!! Form::label('Description') !!}
						{!! Form::textarea('description', null, ['class'=>'form-control']) !!}
					</div>



					<div class="form-group">
						{!! Form::label('Image') !!}
						{!! Form::file('product_image',null) !!}
					</div>

					<div class="form-group">
						<img src="{{ asset('/images/product/'.$product->image_name) }}" alt="image" width='100' height='100' />
					</div>

					<div class="form-group">
						{!! Form::submit('Update', array('class'=>'btn btn-primary')) !!}
						<a href="{{ route('product.index')}}" class="btn btn-primary">Back To List</a>
					</div>
					{!! Form::close() !!}
				</div>
				<div class="card-footer small text-muted"></div>
			</div>
		</div>
	</div>
</div>
@endsection