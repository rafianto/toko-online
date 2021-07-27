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

                                <form action="{{ route('post.data.attribute') }}" method="post">
                                    @csrf
                                    @method('POST')

                                    {{-- Generals --}}
                                    <fieldset class="form-group">
                                        <legend class="pt-0 col-form-label">Generals</legend>
                                        <div class="form-group">
                                            <label for="code">
                                                Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                class="form-control @error('code')
                                                    is-invalid
                                                @enderror" id="code"
                                                name="code" value="{{ old('code') }}"
                                                autocomplete="off" autofocus
                                            >
                                            @if($errors->has('code'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('code') }}
                                                </div>
                                            @endif
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="name">
                                                Name <span class="text-danger">*</span>
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
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="type">
                                                Type <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control js-example-basic-single 
                                            @error('type')
                                                is-invalid
                                            @enderror" id="type"
                                                name="type"
                                            >
                                                <option></option>
                                                @foreach ($types as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </fieldset>
                                    {{-- End of Generals --}}

                                    {{-- Fieldset Validations --}}
                                    <fieldset class="form-group">
                                        <legend class="pt-0 col-form-label">
                                            Validation Setting
                                        </legend>

                                        {{-- is required --}}
                                        <div class="form-group">
                                            <label for="is_required">
                                                Is Required
                                            </label>
                                            <select class="form-control js-example-basic-single 
                                            @error('is_required')
                                                is-invalid
                                            @enderror" id="is_required"
                                                name="is_required"
                                            >
                                                <option></option>
                                                @foreach ($booleanOptions as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- end of is required --}}

                                        {{-- is unique --}}
                                        <div class="form-group">
                                            <label for="is_unique">
                                                Is Unique
                                            </label>
                                            <select class="form-control js-example-basic-single 
                                            @error('is_unique')
                                                is-invalid
                                            @enderror" id="is_unique"
                                                name="is_unique"
                                            >
                                                <option></option>
                                                @foreach ($booleanOptions as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- end of is unique --}}

                                        {{-- validation --}}
                                        <div class="form-group">
                                            <label for="validation">
                                                validation
                                            </label>
                                            <select class="form-control js-example-basic-single 
                                            @error('validation')
                                                is-invalid
                                            @enderror" id="validation"
                                                name="validation"
                                            >
                                                <option></option>
                                                @foreach ($booleanOptions as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- end of validation --}}

                                    </fieldset>
                                    {{-- end of Fieldset Validations --}}

                                    {{-- Fieldset Setting --}}
                                    <fieldset class="form-group">
                                        <legend class="pt-0 col-form-label">
                                            Settings
                                        </legend>

                                        {{-- is_configurable --}}
                                        <div class="form-group">
                                            <label for="is_configurable">
                                                Is Configurable
                                            </label>
                                            <select class="form-control js-example-basic-single 
                                            @error('is_configurable')
                                                is-invalid
                                            @enderror" id="is_configurable"
                                                name="is_configurable"
                                            >
                                                <option></option>
                                                @foreach ($booleanOptions as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- end of is_configurable --}}

                                        {{-- is_filterable --}}
                                        <div class="form-group">
                                            <label for="is_filterable">
                                                Is Filterable
                                            </label>
                                            <select class="form-control js-example-basic-single 
                                            @error('is_filterable')
                                                is-invalid
                                            @enderror" id="is_filterable"
                                                name="is_filterable"
                                            >
                                                <option></option>
                                                @foreach ($booleanOptions as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- end of is_filterable --}}

                                    </fieldset>
                                    {{-- end of Fieldset Setting --}}

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