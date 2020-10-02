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
                        <div>Tambah Usroh {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.usroh.tambah')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="position-relative row form-group">
                            <label for="namaUsroh" class="col-sm-2 col-form-label">Nama Usroh</label>
                            <div class="col-sm-10">
                                <input name="nama" id="namaUsroh" placeholder="Nama Usroh" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="lantai" class="col-sm-2 col-form-label">Lantai</label>
                            <div class="col-sm-10">
                                <input name="lantai" id="lantai" placeholder="Lantai" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="gedung" class="col-sm-2 col-form-label">Gedung</label>
                            <div class="col-sm-10">
                                <select name="gedung" id="gedung" class="form-control" required>
                                    <option selected hidden disabled>Pilih Gedung</option>
                                    <option value="U">U</option>
                                    <option value="M">M</option>
                                    <option value="Y">Y</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-success">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div>
    </div>
@endsection