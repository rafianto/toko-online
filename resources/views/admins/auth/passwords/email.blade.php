
@extends('admins.auth.layouts.body')
@section('title', 'Reset Password')
@section('content')
    <div class="card-body p-5">
        <h4 class="text-dark mb-5">Reset Password</h4>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ url('admin/password/email') }}">
            @csrf
        <div class="row">
            <div class="form-group col-md-12 mb-4">
                <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp" placeholder="Email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-12 mb-4">
                <button type="submit" class="btn btn-lg btn-primary btn-block mb-2">Send Password Reset Link</button>
                <a role="button" class="btn btn-lg btn-danger btn-block mb-4" href="{{ url('admin/login') }}">Back</a>
            </div>
        </div>
        </form>
    </div>
@endsection
