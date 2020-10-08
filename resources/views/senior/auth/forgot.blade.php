@extends('layouts.auth')

@section('title')
    Forgot Password
@endsection

@section('content')
<div class="col-md-4"></div>
<div class="col-md-4 centered">
    <div class="card">
        <div class="card-body"><h5 class="card-title">Forgot Password</h5>
            @if (session()->has('error'))
                <span class="invalid-feedback" style="display: block" role="alert">
                    <strong>{{ session('error') }}</strong>
                </span>
            @endif
            <div>
                <form class="form-inline" style="display: inline-block" action="{{route('senior.forgotpassword.post')}}" method="POST">
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
                        @error('resettoken')
                            <span class="invalid-feedback" style="display: block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input name="resettoken" placeholder="Reset Token" type="number" class="col-md-12 mb-2 form-control" style="width: none" required>
                    </div>
                    <div class="form-group">
                        <button class="col-md-12 btn btn-primary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="vol-md-4"></div>
@endsection