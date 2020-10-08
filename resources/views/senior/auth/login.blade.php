@extends('layouts.auth')

@section('title')
    Login | Sicurezza
@endsection

@section('content')
<div class="col-md-4"></div>
<div class="col-md-4 centered">
    <div class="card">
        <div class="card-body"><h5 class="card-title">Login</h5>
            @if (session()->has('berhasil'))
                <span class="text-success" style="display: block" role="alert">
                    <strong>{{ session('berhasil') }}</strong>
                </span>
            @endif
            <div>
                <form class="form-inline" style="display: inline-block" action="{{route('senior.login.post')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        @error('username')
                            <span class="invalid-feedback" style="display: block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input name="username" placeholder="Username" type="text" class="col-md-12 mb-2 form-control" style="width: none" required>
                    </div>
                    <div class="form-group">
                        @error('password')
                            <span class="invalid-feedback" style="display: block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input name="password" placeholder="Password" type="password" class="col-md-12 mb-2 form-control" style="width: none" required>
                    </div>
                    <div class="form-group">
                        <button class="col-md-12 btn btn-primary">Login</button>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('senior.forgotpassword') }}">Lupa Password ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="vol-md-4"></div>
@endsection