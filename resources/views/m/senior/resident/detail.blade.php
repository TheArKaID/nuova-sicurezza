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
        img {
            max-width: 250px;
            width: inherit;
        }
        .table-right{
            text-align: right;
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
                        <div><small>Detail</small><h4>{{ $resident->nama}}</h4></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row" style="display: grid">
                        <a href="{{route('senior.resident.poin', $resident->id)}}" class="btn btn-small btn-warning" style="float: right" onclick="loadui()">Catatan Pelanggaran</a>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="position-relative row form-group">
                        <div class="col-md-12" style="text-align: center">
                            <img src="{{ asset('storage/foto/' .$tahun. '/resident/' .$resident->foto)}}" alt="" srcset="">
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <th colspan="2" style="text-align: center">Nama</th>
                        </thead>
                        <tbody>
                            <tr><td colspan="2" style="text-align: center">{{ $resident->nama }}</td></tr>
                        </tbody>
                        <thead>
                            <th>Kamar</th>
                            <th class="table-right">Usroh</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $resident->kamar->nomor }}</td>
                                <td class="table-right">{{ $resident->usroh->nama}}</td>
                            </tr>
                        </tbody>
                        <thead>
                            <th>NIM</th>
                            <th class="table-right">Jurusan</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $resident->nim }}</td>
                                <td class="table-right">{{ $resident->nim }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 mt-3 mb-3">
                <div class="row" style="display: grid">
                    <a href="#" class="btn btn-primary" data-toggle="modal" id="setDelete" data-target="#editResident" style="float: right">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
<div class="modal fade" id="editResident" tabindex="-1" role="dialog" aria-labelledby="editResident" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sesuaikan Data Resident</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="formEdit" action="{{ route('senior.resident.detail.edit', $resident->id) }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="position-relative row form-group">
                        <label for="nama" class="col-sm-2 col-form-label">*Nama</label>
                        <div class="col-sm-10">
                            <input name="nama" id="nama" placeholder="Nama Resident" type="text" class="form-control" value="{{ $resident->nama }}" required>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="NIM" class="col-sm-2 col-form-label">*NIM</label>
                        <div class="col-sm-10">
                            <input name="nim" id="NIM" placeholder="NIM" type="number" class="form-control" value="{{ $resident->nim }}" required>
                            <small>11 Digit</small>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-md-10">
                            @if (!$resident->foto)
                                <small>Anda belum menambahkan foto resident ini</small>
                            @else
                                <small>Saat ini</small>
                                <img id="currfoto" src="{{ asset('storage/foto/' .$tahun. '/resident/' .$resident->foto)}}" alt="" srcset="">
                            @endif
                        </div>
                        <div class="col-sm-10">
                            <small>Update Foto</small>
                            <input id="foto" placeholder="Foto" type="file" class="form-control">
                            <small>File JPG, JPEG, PNG<br>Foto akan dikompresi, hindari mengunggah gambar > 5mb</small>
                            <input type="hidden" id="fotofile" name="foto"/>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="btnCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{!! mix('js/app.js') !!}"></script>
    <script>
        const options = {
            targetSize: 0.1,
            quality: 0.75,
            qualityStepSize: 0.1,
            minQuality: 0.1
        }

        const compress = new Compress(options)
        const upload = document.getElementById("foto")
        const preview = document.getElementById("currfoto")

        upload.addEventListener("change",
            (evt) => {
                loadui();
                const files = [...evt.target.files]

                compress.compress(files).then((conversions) => {
                    // Conversions is an array of objects like { photo, info }.
                    // 'photo' has the photo data while 'info' contains metadata
                    // about that particular image compression (e.g. time taken).

                    const { photo, info } = conversions[0]

                    // Create an object URL which points to the photo Blob data
                    const objectUrl = URL.createObjectURL(photo.data)

                    // Set the preview img src to the object URL and wait for it to load
                    Compress.loadImageElement(preview, objectUrl).then(() => {
                        URL.revokeObjectURL(objectUrl)
                        loadingui.hide();
                    })
                    
                    Compress.blobToBase64(photo.data).then((base64) => {
                        document.getElementById("fotofile").setAttribute("value", base64);
                    });
                })
            },
            false
        )
    </script>
    <script>
        $('#formEdit').on('submit', function () {
            loadui();
            $('#btnCancel').click();
        })
    </script>
@endsection