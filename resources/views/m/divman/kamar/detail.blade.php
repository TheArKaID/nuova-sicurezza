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
                        <div>Kamar {{$kamar->nomor}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.kamar.simpan')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$kamar->id}}">
                        <div class="position-relative row form-group">
                            <label for="nomorKamar" class="col-sm-2 col-form-label">Nomor Kamar</label>
                            <div class="col-sm-10">
                                <input name="nomor" id="nomorKamar" placeholder="Nomor Kamar" type="text" class="form-control" value="{{$kamar->nomor}}" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="usroh" class="col-sm-2 col-form-label">Usroh</label>
                            <div class="col-sm-10">
                                <select name="idusroh" id="idusroh" class="form-control" required>
                                    @foreach ($usroh as $u)
                                        <option {{ $u->id==$kamar->idusroh ? " selected " : ""}} value="{{ $u->id }}">{{ $u->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-success">Simpan</button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Kamar ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>PERHATIAN! Semua Data Resident atau Senior pada Kamar {{ $kamar->nomor }} akan terhapus juga.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{route('divman.kamar.hapus', $kamar->id)}}" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection