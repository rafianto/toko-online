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
                        <tbody id="tbody-images">
                            @forelse ($productImages as $image)
                                <tr>    
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ asset('storage/'.$image->path) }}" 
                                                style="width:100px" class="rounded img-fluid img-thumbnail"
                                                alt="{{ $image->path }}"
                                            />
                                        </td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($image->created_at)) }}</td>
                                        <td>
                                                {!! Form::open(['url' => 'admin/master/product/images/'. $image->id . '/delete', 'class' => 'delete', 'style' => 'display:inline-block','id' => 'formDeleteImage']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure delete this image?');"
                                                >
                                                    Remove
                                                </button>
                                                {{-- {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm', 'onclick' => 'confirm("Are you sure to delete image?");']) !!} --}}
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
                    {{-- Pagination --}}
                        <div class="my-3 row justify-content-end">
                            <div>
                                    {{ $productImages->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    {{-- End Of Pagination --}}
                </div>
                <div class="text-right card-footer">
                    <a href="{{ url('admin/master/product/'.$productId.'/images/add-images') }}" class="btn btn-primary">Add New</a>
                </div>
            </div>  
		</div>
</div>

@endsection
