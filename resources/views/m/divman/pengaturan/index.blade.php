@extends('layouts.senior-m')

@section('styles')
<style>
    img {
        width: inherit;
        height: inherit;
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-home icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <h4>General Settings</h4>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                    <div class="alert alert-primary fade show" role="alert">
                        <h5 class="alert-heading">Poin Khusus</h5>
                        <p>
                            <form action="#" method="post">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input class="form-control" type="number" name="ponsus" id="ponsus" value="{{ $pengaturan->ponsus }}">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary col-md-12" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </p>
                        <hr>
                        <p class="mb-0">Kode Poin Khusus akan diberikan pada SR/ASR yang akan menambahkan Poin namun tidak sesuai dengan Tengko yang ada</p>
                    </div>
                    <div class="alert alert-warning fade show" role="alert">
                        <h5 class="alert-heading">Reset Password Token</h5>
                        <p>
                            <form action="{{ route('divman.pengaturan.refresh.token') }}" method="get">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input class="form-control" type="number" value="{{ $pengaturan->resettoken }}" disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-warning col-md-12" type="submit">Refresh</button>
                                    </div>
                                </div>
                            </form>
                        </p>
                        <hr>
                        <p class="mb-0">Dapat diberikan pada SR/ASR yang mengalami kendala Lupa Password untuk mereset passwordnya</p>
                    </div>
                    <div class="alert alert-secondary fade show" role="alert">
                        <h5 class="alert-heading">Status Aplikasi</h5>
                        <p>
                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">
                        </p>
                        <hr>
                        <p class="mb-0">Nonaktifkan saat Program Pembinaan telah selesai. Aplikasi tidak akan dapat diakses.</p>
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#formProfile').on('submit', function () {
            loadui();
        })
    </script>
@endsection