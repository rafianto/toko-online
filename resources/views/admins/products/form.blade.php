@extends('admins.layouts.main')
@php
	$title = empty($product) ? 'New' : 'Update';
	$url = empty($product) ? url('admin/product') : url('admin/product') . '/' . $product->id;
@endphp
@section('title', $title)
@section('content')
	<div class="row">

		@if(!empty($productId))
			{{-- Sidemenu --}}
				<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
					@include('admins.products.product_menus')
				</div>
			{{-- End Of Side Menu --}}
		@endif

		{{-- Form Input --}}
		@if(empty($productId))
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
		@else
			<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
		@endif
				<div class="card card-default">

					{{-- Card Header --}}
						<div class="card-header card-header-border-bottom">
									<h2 class="justify-content-end">
												{{ $title }} Product
									</h2>
						</div>
					{{-- End Of Card Header --}}

					{{-- Card BOdy --}}
						<div class="card-body">

								@if (!empty($product))
											{!! Form::model($product, ['url' => ['admin/product', $product->id], 'method' => 'PUT']) !!}
											{!! Form::hidden('id') !!}
								@else
										{!! Form::open(['url' => 'admin/product', 'method' => 'POST']) !!}
								@endif
									@csrf	

									<div class="form-group">
										{!! Form::label('sku', 'SKU') !!}
										<input type="text" class="form-control input-lg @error('sku') is-invalid @enderror" name="sku" id="sku" autocomplete="off" readonly @if(!empty($product)) {{ "value= $product->sku" }} @else {{ "value=$sku" }} @endif @error('sku') autofocus @enderror>
										
										@error('sku')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>

									<div class="form-group">
											{!! Form::label('name', 'Name') !!}
											<input type="text" class="form-control input-lg @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" placeholder="Product Name" @if(!empty($product)) {{ "value= $product->name" }} @endif @error('name') autofocus @enderror>
											
											@error('name')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>

									<div class="form-group">

										<label for="price">
											Price
										</label>
										<input type="text" class="form-control input-lg @error('price') is-invalid @enderror" name="price" id="price" autocomplete="off" @error('price') autofocus @enderror data-type="currency" placeholder="Rp 1,000,000.00" @if(empty($product)) {{ "" }} @else {{ "value = $product->price" }} @endif>
										@error('price')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>

									<div class="form-group">
											{!! Form::label('category_ids', 'Category') !!}
											{!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'js-example-basic-multiple form-control', 'multiple' => 'multiple', 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
									</div>

									<div class="row">
										<div class="col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">

												{!! Form::label('weight', 'Weight') !!}
												<input type="number" step="0.01" min="0" name="weight" id="weight" autocomplete="off" class="form-control input-lg @error('weight') is-invalid @enderror" @if(empty($product)) {{ "" }} @else {{ "value = $product->weight" }} @endif placeholder="Weight">
												@error('weight')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror

											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">

												{!! Form::label('height', 'Height') !!}
												<input type="number" step="0.01" min="0" name="height" id="height" autocomplete="off" class="form-control input-lg @error('height') is-invalid @enderror" @if(empty($product)) {{ "" }} @else {{ "value = $product->height" }} @endif placeholder="Height">
												@error('height')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror

											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">

												{!! Form::label('width', 'Width') !!}
												<input type="number" step="0.01" min="0" name="width" id="width" autocomplete="off" class="form-control input-lg @error('width') is-invalid @enderror" @if(empty($product)) {{ "" }} @else {{ "value = $product->width" }} @endif placeholder="Width">
											
												@error('width')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror

											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-6">
											<div class="form-group">

												{!! Form::label('length', 'Length') !!}
												<input type="number" step="0.01" min="0" name="length" id="length" autocomplete="off" class="form-control input-lg @error('length') is-invalid @enderror" @if(empty($product)) {{ "" }} @else {{ "value = $product->length" }} @endif placeholder="Length">
												@error('length')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror

											</div>
										</div>
									</div>

									<div class="form-group">

										{!! Form::label('short_description', 'Short Description') !!}
										{!! Form::textarea('short_description', null, ['rows' => '3', 'class' => 'form-control input-lg', 'placeholder' => 'Short Description', 'autocomplete' => 'off']) !!}

									</div>

									<div class="form-group">

										{!! Form::label('description', 'Description') !!}
										{!! Form::textarea('description', null, ['rows' => '5', 'class' => 'form-control input-lg', 'placeholder' => 'Description', 'autocomplete' => 'off']) !!}

									</div>

									<div class="form-group">
											{!! Form::label('status', 'Status') !!}
											{!! Form::select('status', $statuses, NULL, ['class' => 'js-example-basic-single form-control', 'placeholder' => 'Choose Status']) !!}
											@error('status')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
									</div>

							</div>

							<div class="form-footer pt-3 border-top clearfix">
								<a href="{{ url('admin/product') }}" class="btn btn-secondary btn-danger float-right mr-3 ml-2">Back</a>
								<button type="submit" class="btn btn-primary btn-default float-right">Save</button>
							</div>

						{!! Form::close() !!}

						</div>
					{{-- ENd Of Card Body --}}

				</div>
			</div>
		{{-- End Of Form Input --}}

	</div>
@endsection
@push('script')
      <script src="{{ asset('assets/js/apps/product.js') }}"></script>
@endpush