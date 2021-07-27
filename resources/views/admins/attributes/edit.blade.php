@extends('admins.layouts.main')
@section('title', "Edit Attribute")
@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">

        <div class="card card-default">

            {{-- Card Header --}}
                <div class="card-header card-header-border-bottom">
                    <h2 class="justify-content-end">
                        Edit Attribute
                    </h2>
                </div>
            {{-- End Of Card Header --}}

            {{-- card body --}}
                <div class="card-body">

                    {{-- form --}}
                        <div class="row">
                            <div class="col-md-8 col-lg-8">

                                <form action="{{ route('update.attribute', ['id' => $attribute->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="{{ $attribute->id }}" name="id">
                                    
                                    {{-- Fieldset Generals --}}
                                    <fieldset class="form-group">
                                        <legend class="pt-0 col-form-label">Generals</legend>
                                        <div class="form-group">
                                            <label for="code">
                                                Code
                                            </label>
                                            <input type="text" 
                                                class="form-control @error('code')
                                                    is-invalid
                                                @enderror" id="code"
                                                name="code" value="{{ $attribute->code }}"
                                                autocomplete="off" 
                                                readonly
                                            >
                                            @error('code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">
                                                Name
                                            </label>
                                            <input type="text" 
                                                class="form-control @error('name')
                                                    is-invalid
                                                @enderror" id="name" name="name"
                                                value="{{ $attribute->name }}"
                                                autocomplete="off"
                                                @error('name')
                                                    autofocus
                                                @enderror
                                            >
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

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
                                                    <option value="{{ $key }}" 
                                                        @if ($attribute->type == $key)
                                                            selected
                                                        @else
                                                        @endif
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </fieldset>
                                    {{-- End of Fieldset Generals --}}

                                    {{-- Fieldset Validations --}}
                                    <fieldset class="form-group">
                                        <legend class="pt-0 col-form-label">
                                            Validation Setting
                                        </legend>

                                        {{-- is required --}}
                                        <div class="mb-5 form-group">
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
                                                    <option value="{{ $key }}" 
                                                        @if($attribute->is_required == $key)
                                                            selected
                                                        @else
                                                        @endif
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('is_required')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        {{-- end of is required --}}

                                        {{-- is unique --}}
                                        <div class="mb-5 form-group">
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
                                                    <option value="{{ $key }}" 
                                                        @if($attribute->is_unique == $key)
                                                            selected
                                                        @else
                                                        @endif
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('is_unique')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        {{-- end of is unique --}}

                                        {{-- validation --}}
                                        <div class="mb-5 form-group">
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
                                                    <option value="{{ $key }}"
                                                        @if($attribute->validation == $key)
                                                            selected
                                                        @else
                                                        @endif
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('validation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        {{-- end of validation --}}

                                    </fieldset>
                                    {{-- end of Fieldset Validations --}}

                                    {{-- Fieldset Setting --}}
                                    <fieldset class="form-group">
                                        <legend class="pt-0 col-form-label">
                                            Settings
                                        </legend>

                                        {{-- is_configurable --}}
                                        <div class="mb-5 form-group">
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
                                                    <option value="{{ $key }}"
                                                        @if($attribute->is_configurable == $key)
                                                            selected
                                                        @else
                                                        @endif
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('is_configurable')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        {{-- end of is_configurable --}}

                                        {{-- is_filterable --}}
                                        <div class="mb-5 form-group">
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
                                                    <option value="{{ $key }}"
                                                        @if($attribute->is_filterable == $key)
                                                            selected
                                                        @else
                                                        @endif
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('is_filterable')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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