@extends('layouts.senior-m')

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
                        <div>Tambah Kamar {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.kamar.tambah')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="position-relative row form-group">
                            <label for="nomorKamar" class="col-sm-2 col-form-label">Nomor Kamar</label>
                            <div class="col-sm-10">
                                <input name="nomor" id="nomorKamar" placeholder="Nomor Kamar" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idusroh" class="col-sm-2 col-form-label">Usroh</label>
                            <div class="col-sm-10">
                                <select name="idusroh" id="idusroh" class="form-control" required>
                                    <option selected hidden disabled>Pilih Usroh</option>
                                    @foreach ($usroh as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-secondary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div>
    </div>
@endsection