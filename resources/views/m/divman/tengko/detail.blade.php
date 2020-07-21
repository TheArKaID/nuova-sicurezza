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
                        <div>Detail Tengko</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.tengko.simpan')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$tengko->id}}">
                        <div class="position-relative row form-group">
                            <label for="tipe" class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-sm-10">
                                <select name="tipe" id="tipe" class="form-control" required>
                                    <option selected hidden disabled>Tipe Tengko</option>
                                    <option {{ $tengko->tipe=="Ringan" ? "selected" : ""}} value="Ringan">Ringan</option>
                                    <option {{ $tengko->tipe=="Sedang" ? "selected" : ""}} value="Sedang">Sedang</option>
                                    <option {{ $tengko->tipe=="Berat" ? "selected" : ""}} value="Berat">Berat</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="penjelasan" class="col-sm-2 col-form-label">Penjelasan</label>
                            <div class="col-sm-10">
                                <textarea style="height: 150px;" name="penjelasan" id="penjelasan" placeholder="Detail Tengko" class="form-control" required>{{ $tengko->penjelasan }}</textarea>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-secondary">Simpan</button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Tengko ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>PERHATIAN! Semua Data Pelanggaran Resident yang berkaitan dengan Tengko ini akan terhapus juga.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{route('divman.tengko.hapus', $tengko->id)}}" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection