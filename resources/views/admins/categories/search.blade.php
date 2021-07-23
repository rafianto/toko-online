<div class="clearfix">
		<a class="float-right btn btn-primary" href="{{ url('admin/master/category/create') }}" role="button">
					<i class="mdi mdi-plus"></i> Add New Category
		</a>
</div>

{{-- Content Table --}}
	<div class="table-responsive responsive-data-table">

        <table id="categories-table" class="table table-striped table-hover table-bordered dt-responsive text-wrap">

            {{-- Thead --}}
                <thead class="text-center">
                    <tr>
                                <th class="text-center">
                                            No
                                </th>
                                <th>
                                            Name
                                </th>
                                <th>
                                            Slug
                                </th>
                                <th>
                                            Category Parent
                                </th>
                                <th>
                                            Created At
                                </th>
                                <th>
                                            Updated At
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
                @if(count($categories) == 0)
                        <tr  class="text-center">
                                <td colspan="7">
                                        No Data Found
                                </td>
                        </tr>
                @endif
                {{-- akhir kondisi --}}

                @foreach ($categories as $index => $category)

                    <tr class="text-dark">
                        <td class="text-center">
                            {{ $index + $categories->firstItem() }}
                        </td>
                        <td>
                            {{ ucwords($category->name) }}
                        </td>
                        <td>
                            {{ $category->slug }}
                        </td>
                        <td>
                            {{ $category->parent? ucwords($category->parent->name) : ''}}
                        </td>
                        <td>
                            {{ date('d/m/Y H:i:s', strtotime($category->created_at)) }}
                        </td>
                        <td>
                            @if(!is_null($category->updated_at))
                                {{ date('d/m/Y H:i:s', strtotime($category->updated_at)) }}
                            @endif
                        </td>
                        <td class="text-center" width="15%">
                            <a href="{{ url('admin/master/category') }}/{{ $category->id }}" id="btn-view" data-id="{{ $category->id }}" class="my-2 btn btn-warning" data-toggle="tooltip" data-placement="top" title="View Data">
                                <i class="text-white mdi mdi-eye"></i>
                            </a>
                            <button id="btn-delete" data-id="{{ $category->id }}" class="my-2 btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete Data">
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
        Total Data:&nbsp;<b>{{ $categories->total() }}</b>
    </span>
{{-- End Of Content Table --}}

{{-- Pagination --}}
		<div class="my-3 row justify-content-end">
				<div>
						{{ $categories->links('vendor.pagination.bootstrap-4') }}
				</div>
		</div>
{{-- End Of Pagination --}}