@extends('layouts.auth')

@section('title')
    Reset Password
@endsection

@section('content')
<div class="col-md-4"></div>
<div class="col-md-4 centered">
    <div class="card">
        <div class="card-body"><h5 class="card-title">Reset Password</h5>
            @if (session()->has('error'))
                <span class="invalid-feedback" style="display: block" role="alert">
                    <strong>{{ session('error') }}</strong>
                </span>
            @endif
            <div>
                <form class="form-inline" style="display: inline-block" action="{{route('senior.resetpassword.post')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <small class="text-primary">Pastikan anda memasukkan Password <br> dengan minimal 8 huruf</small>
                    </div>
                    <div class="form-group">
                        <input name="newpassword" placeholder="Password baru" minlength="8" type="password" class="col-md-12 mb-2 form-control" style="width: none" required>
                    </div>
                    <div class="form-group">
                        <input name="renewpassword" placeholder="Ulangi Password Baru" minlength="8" type="password" class="col-md-12 mb-2 form-control" style="width: none" required>
                    </div>
                    <div class="form-group">
                        <small>
                            <span class="text-success"> Jika Berhasil, anda akan diarahkan ke Halaman Login</span> <br>
                            <span class="text-danger">Jika Gagal, anda akan dikembalikan ke Halaman Forgot Password</span>
                        </small>
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