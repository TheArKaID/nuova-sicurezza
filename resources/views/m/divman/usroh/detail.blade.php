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
                        <div>Usroh {{$usroh->nama}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.usroh.simpan')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$usroh->id}}">
                        <div class="position-relative row form-group">
                            <label for="namaUsroh" class="col-sm-2 col-form-label">Nama Usroh</label>
                            <div class="col-sm-10">
                                <input name="nama" id="namaUsroh" placeholder="Nama Usroh" type="text" class="form-control" value="{{$usroh->nama}}" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="lantai" class="col-sm-2 col-form-label">Lantai</label>
                            <div class="col-sm-10">
                                <input name="lantai" id="lantai" placeholder="Lantai" type="number" class="form-control" value="{{$usroh->lantai}}" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="gedung" class="col-sm-2 col-form-label">Gedung</label>
                            <div class="col-sm-10">
                                <select name="gedung" id="gedung" class="form-control" value="{{$usroh->gedung}}" required>
                                    <option {{$usroh->gedung=="U" ? 'selected' : ''}} value="U">U</option>
                                    <option {{$usroh->gedung=="M" ? 'selected' : ''}} value="M">M</option>
                                    <option {{$usroh->gedung=="Y" ? 'selected' : ''}} value="Y">Y</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-secondary">Simpan</button>
                                <a href="{{route('divman.usroh.hapus', $usroh->id)}}" class="btn btn-danger" style="float: right">Hapus</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div>
    </div>
@endsection