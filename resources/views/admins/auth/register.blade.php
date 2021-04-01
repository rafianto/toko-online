@extends('admins.auth.layouts.body')
@section('title', 'Sign Up')
@section('content')

    <div class="card-body p-5">
        <h4 class="text-dark mb-5">Sign Up</h4>
        <form method="POST" action="{{ url('admin/register') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-12 mb-4">

                    <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus class="form-control input-lg @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group col-md-12 mb-4">

                    <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" aria-describedby="emailHelp" placeholder="Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group col-md-12 ">

                    <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group col-md-12 ">
                    <input id="password-confirm cpassword" type="password" class="form-control input-lg" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div class="col-md-12">
                    {{-- <div class="d-inline-block mr-3">
                        <label class="control control-checkbox">
                            <input type="checkbox" />
                            <div class="control-indicator"></div>
                            I Agree the terms and conditions
                        </label>

                    </div> --}}
                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">{{ __('Sign Up') }}</button>
                    <p>Already have an account?
                        <a class="text-blue" href="{{ url('admin/login') }}">Sign in</a>
                    </p>
                </div>
            </div>
        </form>

    </div>

@endsection
