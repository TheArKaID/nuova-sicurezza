@extends('layouts.senior-m')

@section('styles')
    <style>
        small{
            color: green
        }

        img {
            width: inherit;
            height: inherit;
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
                        <div>Detail {{ $resident->nama}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{route('divman.resident.simpan')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$resident->id}}">
                        <p><small style="color: blue">* is required</small></p>

                        <hr>

                        <div class="position-relative row form-group">
                            <label for="nama" class="col-sm-2 col-form-label">*Nama</label>
                            <div class="col-sm-10">
                                <input name="nama" id="nama" placeholder="Nama Resident" type="text" class="form-control" value="{{ $resident->nama }}" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="NIM" class="col-sm-2 col-form-label">*NIM</label>
                            <div class="col-sm-10">
                                <input name="nim" id="NIM" placeholder="NIM" type="number" class="form-control" value="{{ $resident->nim }}">
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
                        
                        <hr>

                        <div class="position-relative row form-group">
                            <label for="idusroh" class="col-sm-2 col-form-label">*Usroh</label>
                            <div class="col-sm-10">
                                <select name="idusroh" id="idusroh" class="form-control" required>
                                    <option selected hidden disabled>Pilih Usroh</option>
                                    @foreach ($usroh as $u)
                                        <option {{ $resident->idusroh==$u->id ? "selected" : ""}} value="{{ $u->id }}">{{ $u->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idkamar" class="col-sm-2 col-form-label">*Kamar</label>
                            <div class="col-sm-10">
                                <select name="idkamar" id="idkamar" class="form-control" required>
                                    <option selected hidden value="{{$resident->kamar->id}}">{{$resident->kamar->nomor}}</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        
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
    <script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
    <script>
        $("select[name='idusroh'").on('change', function () {
            clearKamar();
            var idusroh = this.value;
            console.log(idusroh);
            jQuery.ajax({
            url: "/s/d-resident/getkamar/" +idusroh,
			type: 'GET',
			dataType: 'json',
                success: function (usroh) {
                    if(usroh===0){
                        $('select[id="idkamar"]').empty();
                        $('select[id="idkamar"]').append('<option selected hidden disabled>Usroh Penuh</option>');
                    } else{
                        $.each(usroh, function (key, value) {
                        console.log(value)
                        $('select[id="idkamar"]')
                            .append(
                                '<option value="' + value.id + '">'+ value.nomor +'</option>'
                            );
                        });
                    }
                    // $('.loader').hide();
                },
                error: function(){
                    // $('.loader').hide();
                }
            });
        });

        function clearKamar() {
            $('select[id="idkamar"]').empty();
            $('select[id="idkamar"]').append('<option selected hidden disabled>Pilih Kamar</option>');
        }
    </script>
@endsection

@section('modals')
    <div class="modal fade modalDelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Resident ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>PERHATIAN! Data Resident {{ $resident->nama }} akan terhapus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{route('divman.resident.hapus', $resident->id)}}" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection