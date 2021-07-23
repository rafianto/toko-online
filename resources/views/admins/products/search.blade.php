<div class="clearfix mb-3">
		<a class="float-right btn btn-primary" href="{{ url('admin/master/product/create') }}" role="button">
					<i class="mdi mdi-plus"></i> Add New Produt
		</a>
</div>

{{-- Content Table --}}
	<div class="table-responsive text-wrap">

        <table id="attribute-table" class="table table-striped table-hover table-bordered">

            {{-- Thead --}}
                        <thead class="text-center">
                                    <tr>
                                                <th class="text-center">
                                                            No
                                                </th>
                                                <th>
                                                            SKU
                                                </th>
                                                <th>
                                                            Name
                                                </th>
                                                <th>
                                                            Slug
                                                </th>
                                                <th>
                                                            Price
                                                </th>
                                                <th>
                                                            Status
                                                </th>
                                                <th class="text-center">
                                                            #
                                                </th>
                                    </tr>
                        </thead>
            {{-- End Of Thead --}}

            {{-- Tbody --}}
                        <tbody>

                            {{-- Jika Data Category Kosong --}}
                            @if(count($products) == 0)
                                    <tr  class="text-center">
                                            <td colspan="7">
                                                    No Data Found
                                            </td>
                                    </tr>
                            @endif

                            @foreach ($products as $index => $product)

                                    <tr class="text-dark">
                                        <td class="text-center">
                                            {{ $index + $products->firstItem() }}
                                            <td>
                                            {{ $product->sku }}
                                        </td>
                                        </td>
                                        <td>
                                            {{ ucwords($product->name) }}
                                        </td>
                                        <td>
                                            {{ $product->slug }}
                                        </td>
                                        <td>
                                            {{ number_format($product->price, 2) }}
                                        </td>
                                        <td>
                                            @if($product->status == 0)
                                                Draft
                                            @elseif ($product->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td class="text-center" width="15%">
                                            <a href="{{ url('admin/master/product') }}/{{ $product->id }}" id="btn-view" data-id="{{ $product->id }}" class="my-2 btn btn-warning" data-toggle="tooltip" data-placement="top" title="View Data">
                                                <i class="text-white mdi mdi-eye"></i>
                                            </a>
                                            <button id="btn-delete" data-id="{{ $product->id }}" class="my-2 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                <i class="text-white mdi mdi-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                
                            @endforeach

                        </tbody>
            {{-- End Of Tbody --}}

        </table>

    </div>
    <span>
        Total Data:&nbsp;<b>{{ $products->total() }}</b>
    </span>
{{-- End Of Content Table --}}


{{-- Pagination --}}
		<div class="my-3 row justify-content-end">
				<div>
						{{ $products->links('vendor.pagination.bootstrap-4') }}
				</div>
		</div>
{{-- End Of Pagination --}}