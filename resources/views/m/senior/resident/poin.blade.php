@extends('layouts.senior-m')

@section('styles')
    <style>
        small{
            opacity: 0.75;
        }
        p{
            opacity: 1;
            font-weight: bold;
        }
    </style>
@endsection

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
                        <div><small>Catatan Pelanggaran</small><h4>{{ $resident->nama }}</h4></div>
                    </div>
                    @if ($resident->usroh->id==Auth::user()->usroh->id)
                    <div class="col-md-12">
                        <div class="row" style="display: grid">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalTambahPoin">
                                Tambah Poin
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <th>#</th>
                            <th>Tipe</th>
                            <th>Pelanggaran</th>
                            <th>Keterangan</th>
                            <th>Poin</th>
                            <th>Tanggal</th>
                            <th>Oleh</th>
                            @if ($resident->usroh->id===Auth::user()->usroh->id)
                                <th>Action</th>
                            @endif
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @if (count($pencatatan)!=0)
                            @foreach ($pencatatan as $p)
                            <tr>
                                <td>{{$num}}</td>
                                <td class="text-center">
                                    <div class="mb-2 mr-2 badge 
                                        {{ $p->tengko->tipe=="Ringan" ? "badge-warning" : "" }}
                                        {{ $p->tengko->tipe=="Sedang" ? "badge-danger" : "" }}
                                        {{ $p->tengko->tipe=="Berat" ? "badge-dark" : "" }}">
                                        {{ $p->tengko->tipe }}
                                    </div>
                                </td>
                                <td>{{ $p->tengko->penjelasan }}</td>
                                <td>{{ $p->keterangan }}</td>
                                <td>{{ $p->tengko->poin }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->senior->nama }}</td>
                                <td>
                                    @if ($resident->usroh->id===Auth::user()->usroh->id)
                                        <a href="#" class="btn mr-2 mb-2 btn-danger" data-toggle="modal" id="setDelete" data-url="{{ route('senior.resident.poin.hapus', $p->id) }}" data-target="#modalDelete" style="float: right">Hapus</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td colspan="7" style="text-align: center"><i>Tidak ada Poin</i></td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        <div>
    </div>
@endsection

@section('modals')
@if ($resident->usroh->id==Auth::user()->usroh->id)
<div class="modal fade" id="modalTambahPoin" tabindex="-1" role="dialog" aria-labelledby="modalTambahPoinLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPoinLabel">Tambah Poin Pelanggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formPoin" action="{{route('senior.resident.poin.tambah')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                        <input type="hidden" name="idresident" value="{{$resident->id}}">
                        <div class="position-relative row form-group">
                            <label for="tipe" class="col-sm-2 col-form-label">Tipe</label>
                            <div class="col-sm-10">
                                <select name="tipe" id="tipe" class="form-control" required>
                                    <option selected hidden disabled>Tipe Pelanggaran</option>
                                    <option value="Ringan">Ringan</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Berat">Berat</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idtengko" class="col-sm-2 col-form-label">Pelanggaran</label>
                            <div class="col-sm-10">
                                <select name="idtengko" id="idtengko" class="form-control" required>
                                    <option selected hidden disabled> - Pilih Pelanggaran - </option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea style="height: 150px;" name="keterangan" id="keterangan" placeholder="Detail Pelanggaran (Opsional)" class="form-control">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCancel" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Catatan ini ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>PERHATIAN! Penghapusan tidak dapat dibatalkan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="#" id="btnDelete" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $("select[name='tipe'").on('change', function () {
            loadData();
            var tipe = this.value;
            console.log(tipe);
            jQuery.ajax({
            url: "/s/tengko/getpelanggaran/" + tipe,
			type: 'GET',
			dataType: 'json',
                success: function (pelanggaran) {
                    clearTengko();
                    $.each(pelanggaran, function (key, value) {
                        $('select[id="idtengko"]')
                            .append(
                                '<option value="' + value.id + '">'+ value.pelanggaran +'</option>'
                            );
                        
                    })
                },
                error: function(){
                    $('select[id="idtengko"]').append('<option selected hidden disabled>Gagal. Cek Koneksi Internet.</option>');    
                }
            });
        });

        function loadData() {
            $('select[id="idtengko"]').append('<option selected hidden disabled>- Loading -</option>');    
        }

        function clearTengko() {
            $('select[id="idtengko"]').empty();
            $('select[id="idtengko"]').append('<option selected hidden disabled>Pilih Pelanggaran</option>');
        }

        $('#setDelete').on('click', function () {
            $('#btnDelete').attr('href', $(this).data("url"));
        })

        $('#btnDelete').on('click', function () {
            loadui();
        })
        
        $('#formPoin').on('submit', function () {
            loadui();
            $('#btnCancel').click();
        })
    </script>
@endsection