@extends('admins.layouts.main')
@php
	$title = !empty($category) ? 'Update' : 'New';
@endphp
@section('title', $title)
@section('content')
	<div class="row">

		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

			<div class="card card-default">

				{{-- Card Header --}}
					<div class="card-header card-header-border-bottom">
								<h2 class="justify-content-end">
											{{ $title }} Category
								</h2>
					</div>
					{{-- End Of Card Header --}}

					{{-- Caard Body --}}
						<div class="card-body">
							
							@include('admins.partials.flash', ['$errors' => $errors])
                    @if (!empty($category))
                        {!! Form::model($category, ['url' => ['admin/category', $category->id], 'method' => 'PUT']) !!}
                        {!! Form::hidden('id') !!}
                    @else
                        {!! Form::open(['url' => 'admin/category']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'category name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('parent_id', 'Parent') !!}
                            {!! General::selectMultiLevel('parent_id', $categories, ['class' => 'js-example-basic-single form-control', 'selected' => !empty(old('parent_id')) ? old('parent_id') : (!empty($category['parent_id']) ? $category['parent_id'] : ''), 'placeholder' => '-- Choose Category --']) !!}
                        </div>
                        <div class="form-footer pt-5 border-top clearfix">
													<a href="{{ url('admin/category') }}" class="btn btn-secondary btn-danger float-right mr-3 ml-2">Back</a>
                          <button type="submit" class="btn btn-primary btn-default float-right">Save</button>
                        </div>
                    {!! Form::close() !!}

						</div>
					{{-- End Of Card Body --}}

			</div>

		</div>

	</div>
@endsection