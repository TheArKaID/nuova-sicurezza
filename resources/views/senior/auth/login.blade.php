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
            <span id="alertPasscode" class="text-danger" style="display: none" role="alert">
                <strong>Maaf, mohon update browser yang anda. Fitur Passcode tidak dapat digunakan</strong>
            </span>
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

<div class="modal fade" id="modalPasscode" tabindex="-1" role="dialog" aria-labelledby="modalPasscode" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <form action="{{ route('senior.login.passcode') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Passcode Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Masukkan Passcode anda.</p>
                    <div class="form-group">
                        <input class="form-control" type="text" name="userpasscode" id="userpasscode" value="" readonly required>
                    </div>
                    @error('passcode')
                        <span class="invalid-feedback" style="display: block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group">
                        <input class="form-control" minlength="6" type="password" name="passcode" id="passcode" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" href="#" id="btnDelete" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var passcode = localStorage.getItem("passcode");
            if(passcode) {
                if (typeof(Storage) !== "undefined") {
                    $('#userpasscode').val(localStorage.getItem("passcode"));
                    $('#modalPasscode').modal('show');
                } else {
                    $('#alertPasscode').attr('style', 'display: block');
                }
            }
        })
    </script>
@endsection