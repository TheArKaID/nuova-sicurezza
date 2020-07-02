@extends('layouts.senior')

@section('content')
    <div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Tambah Tahun</h5>
                <form action="{{route('tahun.add')}}" method="post">
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
                <form action="{{route('tahun.set')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control col-md-8" style="display: inline" required>
                            <?php
                                foreach($tahun as $t) {
                                    if($t->tahunajaran==$pengaturan['tahunaktif'])
                                        echo "<option selected>$t->tahunajaran</option>";
                                    else
                                        echo "<option>$t->tahunajaran</option>";
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
                <form action="{{route('tahun.delete')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control col-md-8" style="display: inline" required>
                            <?php
                                foreach($tahun as $t) {
                                    echo "<option>$t->tahunajaran</option>";
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