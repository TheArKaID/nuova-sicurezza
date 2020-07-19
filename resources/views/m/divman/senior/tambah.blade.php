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
                        <div>Tambah Senior {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.senior.tambah')}}" method="POST">
                        {{ csrf_field() }}
                        <p><small>* is required</small></p>
                        <hr>

                        <div class="position-relative row form-group">
                            <label for="nama" class="col-sm-2 col-form-label">*Nama</label>
                            <div class="col-sm-10">
                                <input name="nama" id="nama" placeholder="Nama Senior" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="NIM" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input name="nim" id="NIM" placeholder="NIM" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="jeniskelamin" class="col-sm-2 col-form-label">*Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jeniskelamin" id="jeniskelamin" class="form-control" required>
                                    <option selected hidden disabled>Jenis Kelamin</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="0">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input name="foto" id="foto" placeholder="Foto" type="file" class="form-control">
                            </div>
                        </div>
                        
                        <hr>

                        <div class="position-relative row form-group">
                            <label for="username" class="col-sm-2 col-form-label">*Username</label>
                            <div class="col-sm-10">
                                <input name="username" id="username" placeholder="Username" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="password" class="col-sm-2 col-form-label">*Password</label>
                            <div class="col-sm-10">
                                <input name="password" id="password" placeholder="Password" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="repassword" class="col-sm-2 col-form-label">*Re Password</label>
                            <div class="col-sm-10">
                                <input name="repassword" id="repassword" placeholder="Re Password" type="password" class="form-control" required>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="position-relative row form-group">
                            <label for="isdivman" class="col-sm-2 col-form-label">*Divisi Keamanan</label>
                            <div class="col-sm-10">
                                <select name="isdivman" id="isdivman" class="form-control" required>
                                    <option selected hidden disabled>Divisi Keamanan</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idusroh" class="col-sm-2 col-form-label">*Usroh</label>
                            <div class="col-sm-10">
                                <select name="idusroh" id="idusroh" class="form-control" required>
                                    <option selected hidden disabled>Pilih Usroh</option>
                                    {{-- @foreach ($usroh as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idkamar" class="col-sm-2 col-form-label">*Kamar</label>
                            <div class="col-sm-10">
                                <select name="idkamar" id="idkamar" class="form-control" required>
                                    <option selected hidden disabled>Pilih Kamar</option>
                                    {{-- @foreach ($usroh as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <hr>

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