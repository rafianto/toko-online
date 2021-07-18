@extends('admins.layouts.main')
@section('title', 'Product Images')
@section('content')

<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
				@include('admins.products.product_menus')
		</div>
		<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
				<div class="card card-default">
						<div class="card-header card-header-border-bottom">
										<h2>Product Images</h2>
						</div>
						<div class="card-body">
								@include('admins.partials.flash')
								<table class="table table-bordered table-striped">
										<thead>
												<th>#</th>
												<th>Image</th>
												<th>Uploaded At</th>
												<th>Action</th>
										</thead>
										<tbody>
												@forelse ($productImages as $image)
														<tr>    
																<td>{{ $image->id }}</td>
																<td><img src="{{ asset('storage/'.$image->small) }}" style="width:100px"/></td>
																<td>{{ $image->created_at }}</td>
																<td>
																		{!! Form::open(['url' => 'admin/products/images/'. $image->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
																		{!! Form::hidden('_method', 'DELETE') !!}
																		{!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
																		{!! Form::close() !!}
																</td>
														</tr>
												@empty
														<tr>
																<td colspan="4"class="text-center">No records found</td>
														</tr>
												@endforelse
										</tbody>
								</table>
						</div>
						<div class="text-right card-footer">
								<a href="{{ url('admin/product/'.$productId.'/images/add-images') }}" class="btn btn-primary">Add New</a>
						</div>
				</div>  
		</div>
</div>

@endsection