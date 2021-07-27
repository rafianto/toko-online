@extends('admins.layouts.main')
@section('title', "Attribute Options Of $attribute->name" )
@section('content')
<div class="row">
    <div class="col-md-5 col-lg-5">
        <div class="card card-default">

            <div class="card-header card-header-border-bottom">
                <h2 class="justify-content-end">
                    <span id="title-card-header"></span>
                </h2>
            </div>

            <div class="card-body">
                <div class="mb-5">
                    <form id="formAttributeOption">
                        @csrf
                        @method("POST")
                        <input type="hidden" name="option_id" id="option_id" value="{{ null }}">
                        <div class="form-group">
                            <label for="name">
                                Name
                            </label>
                            <input type="text" class="form-control" name="name" id="name" autofocus 
                                placeholder="attribute options name" autocomplete="off" required
                            />
                        </div>
                        
                        <div class="clearfix pt-5 form-footer">
                            <a href="{{ url('admin/master/attribute') }}" 
                                class="float-right ml-1 mr-2 btn btn-danger"
                            >Back</a>
                            <button class="float-right ml-1 btn btn-secondary"
                                id="clear" type="button"
                            >
                                Clear
                            </button>
                            <button class="float-right btn btn-primary"
                                id="saveOption" type="button" data-attributeId="{{ $attribute->id }}"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-7 col-lg-7 col-xl-7">
        <div class="card card-default">

            {{-- Card Header --}}
            <div class="card-header card-header-border-bottom">
                <h2 class="justify-content-end">
                    Attribute Options Of {{ ucwords($attribute->name) }}
                </h2>
            </div>
            {{-- End Of Card Header --}}

            {{-- Card Body --}}
            <div class="card-body">

                <div class="mb-5">

                    {{-- Content Table --}}
                        <div class="table-responsive responsive-data-table">

                            <table id="categories-table" 
                                class="table table-striped table-hover table-bordered dt-responsive text-wrap "
                            >

                                {{-- Thead --}}
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">
                                                No
                                            </th>
                                            <th class="text-center">
                                                Name
                                            </th>
                                            <th class="text-center">
                                                Created At
                                            </th class="text-center">
                                            <th class="text-center">
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

                                    {{-- Jika Data option Kosong --}}
                                    @if(count($options) == 0)
                                        <tr  class="text-center">
                                            <td colspan="6">
                                                No Data Found
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- akhir kondisi --}}
                                        @php
                                            $i = 1;
                                        @endphp
                                    @foreach ($options as $index => $option)

                                        <tr class="text-dark text-wrap">
                                            <td class="text-center">
                                                {{ $index + $i }}
                                            </td>
                                            <td>
                                                {{ ucwords($option->name) }}
                                            </td>
                                            <td class="text-center">
                                                {{ date('d/m/Y H:i:s' , strtotime($option->created_at)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ date('d/m/Y H:i:s' , strtotime($option->updated_at)) }}
                                            </td>
                                            <td class="text-center" width="20%">
                                                <button type="button"
                                                    id="btn-view" data-id="{{ $option->id }}" 
                                                    class="my-2 btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="View Data"
                                                    onclick="viewData({{ $option->id }}, `{{ ucwords($option->name) }}`)"
                                                >
                                                    <i class="text-white mdi mdi-eye"></i>
                                                </button>
                                                <button id="btn-delete" data-id="{{ $option->id }}" class="my-2 btn btn-danger btn-sm" data-attributeId="{{ $attribute->id }}" data-toggle="tooltip" data-placement="top" title="Delete Data">
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
                                    Total Data:&nbsp;<b>{{ $options->total() }}</b>
                            </span>
                        </div>
                        {{-- End Of Content Table --}}


                        {{-- Pagination --}}
                            <div class="my-3 row justify-content-end">
                                    <div>
                                            {{ $options->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                            </div>
                        {{-- End Of Pagination --}}

                </div>

            </div>
            {{-- End Of Card Body --}}

        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        const postUrl = "{{ route('option.attribute.store') }}";
    </script>
    <script src="{{ asset('assets/js/apps/attribute_options.js') }}"></script>
@endpush