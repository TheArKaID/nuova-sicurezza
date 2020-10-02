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
                        <div>Tambah Tengko {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.tengko.tambah')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="position-relative row form-group">
                            <label for="tipe" class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-sm-10">
                                <select name="tipe" id="tipe" class="form-control" required>
                                    <option selected hidden disabled>Tipe Tengko</option>
                                    <option value="Ringan">Ringan</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Berat">Berat</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="penjelasan" class="col-sm-2 col-form-label">Penjelasan</label>
                            <div class="col-sm-10">
                                <textarea style="height: 150px;" name="penjelasan" id="penjelasan" placeholder="Detail Tengko" class="form-control" required>{{ old('penjelasan') }}</textarea>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="poin" class="col-sm-2 col-form-label">Poin Pelanggaran</label>
                            <div class="col-sm-10">
                                <input type="number" name="poin" id="poin" class="form-control" placeholder="Poin Pelanggaran" value="{{ old('poin') }}" required>
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