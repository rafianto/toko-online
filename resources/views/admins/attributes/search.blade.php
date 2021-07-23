<div class="clearfix">
		<a class="float-right btn btn-primary" href="{{ url('admin/master/attribute/create') }}" role="button">
					<i class="mdi mdi-plus"></i> Add New Attribute
		</a>
</div>

{{-- Content Table --}}
	<div class="table-responsive responsive-data-table">

        <table id="categories-table" class="table table-striped table-hover table-bordered dt-responsive nowrap">

            {{-- Thead --}}
                <thead class="text-center">
                    <tr>
                        <th class="text-center">
                            No
                        </th>
                        <th class="text-center">
                            Code
                        </th>
                        <th class="text-center">
                            Name
                        </th>
                        <th class="text-center">
                            Type
                        </th class="text-center">
                        <th class="text-center">
                            Validation
                        </th>
                        <th class="text-center">
                            Is Required
                        </th>
                        <th class="text-center">
                            Is Unique
                        </th>
                        <th class="text-center">
                            Is Filterable
                        </th>
                        <th class="text-center">
                            Is Configurable
                        </th>
                        <th class="text-center">
                                    #
                        </th>
                    </tr>
                </thead>
            {{-- End Of Thead --}}

            {{-- Tbody --}}
                <tbody>

                {{-- Jika Data Attribute Kosong --}}
                @if(count($attributes) == 0)
                    <tr  class="text-center">
                        <td colspan="10">
                            No Data Found
                        </td>
                    </tr>
                @endif
                {{-- akhir kondisi --}}

                @foreach ($attributes as $index => $attribute)

                    <tr class="text-dark text-wrap">
                        <td class="text-center">
                            {{ $index + $attributes->firstItem() }}
                        </td>
                        <td>
                            {{ ucwords($attribute->code) }}
                        </td>
                        <td>
                            {{ ucwords($attribute->name) }}
                        </td>
                        <td>
                            {{ ucwords($attribute->type) }}
                        </td>
                        <td class="text-center">
                            @if($attribute->is_required)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($attribute->is_unique)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($attribute->is_filterable)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($attribute->is_filterable)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($attribute->is_configurable)
                                <i class="fas fa-check text-success"></i>
                            @else
                                <i class="fas fa-times text-danger"></i>
                            @endif
                        </td>
                        <td class="text-center" width="15%">
                            <a href="{{ url('admin/master/attribute') }}/{{ $attribute->id }}" id="btn-view" data-id="{{ $attribute->id }}" class="my-2 btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="View Data">
                                <i class="text-white mdi mdi-eye"></i>
                            </a>
                            <a href="{{ url('admin/master/attribute') }}/{{ $attribute->id }}/options" id="btn-options" data-id="{{ $attribute->id }}" class="my-2 btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Options">
                                <i class="text-white fas fa-toolbox"></i>
                            </a>
                            <button id="btn-delete" data-id="{{ $attribute->id }}" class="my-2 btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Data">
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
                Total Data:&nbsp;<b>{{ $attributes->total() }}</b>
        </span>
    </div>
{{-- End Of Content Table --}}


{{-- Pagination --}}
		<div class="my-3 row justify-content-end">
				<div>
						{{ $attributes->links('vendor.pagination.bootstrap-4') }}
				</div>
		</div>
{{-- End Of Pagination --}}