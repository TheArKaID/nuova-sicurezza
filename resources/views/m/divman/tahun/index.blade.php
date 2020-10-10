@extends('layouts.senior-m')

@section('content')
    <div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Tambah Tahun</h5>
                <form id="formAdd" action="{{route('divman.tahun.add')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input name="tahunawal" placeholder="Tahun Awal" type="number" class="form-control col-md-4" min="2000" max="9999" style="display: inline" value="{{old('tahunawal')}}" required>
                        <input name="tahunakhir"  placeholder="Tahun Akhir" type="number" class="form-control col-md-4" min="2000" max="9999" style="display: inline" value="{{old('tahunakhir')}}" required>
                        <input name="submit" type="submit" class="mb-2 mr-2 btn btn-primary" value="Tambah">
                    </div>
                </form>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Set Tahun Aktif</h5>
                <form id="formSet" action="{{route('divman.tahun.set')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control col-md-8" style="display: inline" required>
                            <?php
                                foreach($tahun as $t) {
                                    if($t->id==$pengaturan['idtahunaktif'])
                                        echo "<option selected>$t->tahunajaran</option>";
                                    else
                                        echo "<option value='$t->id'>$t->tahunajaran</option>";
                                }
                            ?>
                        </select>
                        <input name="submit" type="submit" class="mb-2 mr-2 btn btn-success" value="Simpan">
                    </div>
                </form>
            </div>
        </div>

        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Hapus Tahun</h5>
                <form id="formDelete" action="{{route('divman.tahun.delete')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control col-md-8" style="display: inline" required>
                            <?php
                                foreach($tahun as $t) {
                                    echo "<option value='$t->id'>$t->tahunajaran</option>";
                                }
                            ?>
                        </select>
                        <input name="submit" type="submit" class="mb-2 mr-2 btn btn-danger" value="Hapus">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#formAdd').on('submit', function () {
            loadui();
        })
        $('#formSet').on('submit', function () {
            loadui();
        })
        $('#formDelete').on('submit', function () {
            loadui();
        })
    </script>
@endsection