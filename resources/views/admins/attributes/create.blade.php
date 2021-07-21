@extends('admins.layouts.main')
@section('title', "New Attribute")
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">

        <div class="card card-default">

            {{-- Card Header --}}
                <div class="card-header card-header-border-bottom">
                    <h2 class="justify-content-end">
                        New Attribute
                    </h2>
                </div>
            {{-- End Of Card Header --}}

            {{-- card body --}}
                <div class="card-body">

                    {{-- form --}}
                        <div class="row">
                            <div class="col-md-8 col-lg-8">

                                <form action="{{ url('admin/master/attribute') }}">
                                    
                                    <div class="form-group">
                                        <label for="code">
                                            Code
                                        </label>
                                        <input type="text" 
                                            class="form-control @error('code')
                                                is-invalid
                                            @enderror" id="code"
                                            name="code" value="{{ old('code') }}"
                                            autocomplete="off" autofocus
                                        >
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="name">
                                            Name
                                        </label>
                                        <input type="text" 
                                            class="form-control @error('name')
                                                is-invalid
                                            @enderror" id="name" name="name"
                                            autocomplete="off"
                                            @error('name')
                                                autofocus
                                            @enderror
                                        >
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div class="mb-5 form-group">
                                        <label for="type">
                                            Type
                                        </label>
                                        <select class="form-control js-example-basic-single 
                                        @error('type')
                                            is-invalid
                                        @enderror" id="type"
                                            name="type"
                                        >
                                            @foreach ($types as $key => $value)
                                                <option value="{{ $key }}">
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- form footer --}}
                                    <div class="pt-5 form-footer">
                                        <a href="{{ url('admin/master/attribute') }}" 
                                            class="float-right btn btn-secondary"
                                        >
                                            Back
                                        </a>
                                        <button class="float-right mr-1 btn btn-primary" type="submit">
                                            Save
                                        </button>
                                    </div>
                                    {{-- end of form footer --}}

                                </form>

                            </div>
                        </div>
                    {{-- end of form --}}

                </div>
            {{-- end of card body --}}

        </div>

    </div>
</div>
@endsection
@push('script')
   <script src="{{ asset('assets/js/apps/attributes.js') }}"></script>
@endpush