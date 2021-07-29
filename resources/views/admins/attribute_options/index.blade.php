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

                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <div id="attributeOptions-search">
                        @include('admins.attribute_options.search')
                    </div>

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