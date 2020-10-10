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
                    <form id="formEdit" action="{{route('divman.usroh.simpan')}}" method="POST">
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
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="#" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" data-target=".modalDelete" style="float: right">Hapus</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div>
    </div>
@endsection

@section('modals')
    <div class="modal fade modalDelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Usroh ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>PERHATIAN! Semua Data Kamar dan Resident pada Usroh {{ $usroh->nama }} akan terhapus juga.</p>
                </div>
                <div class="modal-footer">
                    <button id="btnCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{route('divman.usroh.hapus', $usroh->id)}}" id="btnDelete" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#formEdit').on('submit', function () {
            loadui();
        })

        $('#btnDelete').on('click', function () {
            loadui();
            $('#btnCancel').click();
        })
    </script>
@endsection