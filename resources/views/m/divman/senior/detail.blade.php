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
                        <div>Detail {{ $senior->nama}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form id="formEdit" action="{{route('divman.senior.simpan')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$senior->id}}">
                        <p><small style="color: blue">* is required</small></p>

                        <hr>

                        <div class="position-relative row form-group">
                            <label for="nama" class="col-sm-2 col-form-label">*Nama</label>
                            <div class="col-sm-10">
                                <input name="nama" id="nama" placeholder="Nama Senior" type="text" class="form-control" value="{{ $senior->nama }}" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="NIM" class="col-sm-2 col-form-label">*NIM</label>
                            <div class="col-sm-10">
                                <input name="nim" id="NIM" placeholder="NIM" type="number" class="form-control" value="{{ $senior->nim }}">
                                <small>11 Digit</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="jeniskelamin" class="col-sm-2 col-form-label">*Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jeniskelamin" id="jeniskelamin" class="form-control" required>
                                    <option selected hidden disabled>Jenis Kelamin</option>
                                    <option {{ $senior->jeniskelamin==1 ? "selected" : ""}} value="1">Laki-laki</option>
                                    <option {{ $senior->jeniskelamin==0 ? "selected" : ""}} value="0">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-md-10">
                                @if (!$senior->foto)
                                    <small>Foto belum ditambahkan</small>
                                @else
                                    <small>Saat ini</small>
                                    <img id="currfoto" src="{{ asset('storage/foto/' .$tahun. '/senior/' .$senior->foto)}}" alt="" srcset="">
                                @endif
                            </div>
                            <div class="col-sm-10">
                                <small>Update Foto</small>
                                <img id="currfoto" alt="" srcset="">
                                <input name="foto" id="foto" placeholder="Foto" type="file" class="form-control">
                                <small>File JPG, JPEG, PNG<br>Foto akan dikompresi, hindari mengunggah gambar > 5mb</small>
                                <input type="hidden" id="fotofile" name="foto"/>
                            </div>
                        </div>
                        
                        <hr>

                        <div class="position-relative row form-group">
                            <label for="username" class="col-sm-2 col-form-label">*Username</label>
                            <div class="col-sm-10">
                                <input name="username" id="username" placeholder="Username" type="text" class="form-control" value="{{ $senior->username }}" required>
                                <small>4-10 Karakter</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="password" class="col-sm-2 col-form-label">Ganti Password</label>
                            <div class="col-sm-10">
                                <input name="password" id="password" placeholder="Ganti Password" type="password" class="form-control">
                                <small>8-20 Karakter</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="repassword" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                            <div class="col-sm-10">
                                <input name="repassword" id="repassword" placeholder="Ulangi Password" type="password" class="form-control">
                                <small>8-20 Karakter</small>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="position-relative row form-group">
                            <label for="isdivman" class="col-sm-2 col-form-label">*Divisi Keamanan</label>
                            <div class="col-sm-10">
                                <select name="isdivman" id="isdivman" class="form-control" required>
                                    <option selected hidden disabled>Divisi Keamanan</option>
                                    <option {{ $senior->isdivman==1 ? "selected" : ""}} value="1">Ya</option>
                                    <option {{ $senior->isdivman==0 ? "selected" : ""}} value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="status" class="col-sm-2 col-form-label">*Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control" required>
                                    <option selected hidden disabled>Status Senior</option>
                                    <option value="0" {{ $senior->status==0 ? "selected" : ""}}>Senior Resident</option>
                                    <option value="1" {{ $senior->status==1 ? "selected" : ""}}>Assistant of Senior Resident</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idusroh" class="col-sm-2 col-form-label">*Usroh</label>
                            <div class="col-sm-10">
                                <select name="idusroh" id="idusroh" class="form-control" required>
                                    <option selected hidden disabled>Pilih Usroh</option>
                                    @foreach ($usroh as $u)
                                        <option {{ $senior->idusroh==$u->id ? "selected" : ""}} value="{{ $u->id }}">{{ $u->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idkamar" class="col-sm-2 col-form-label">*Kamar</label>
                            <div class="col-sm-10">
                                <select name="idkamar" id="idkamar" class="form-control" required>
                                    <option selected hidden value="{{$senior->kamar->id}}">{{$senior->kamar->nomor}}</option>
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
            loadui();
            clearKamar();
            var idusroh = this.value;
            console.log(idusroh);
            jQuery.ajax({
            url: "/s/d-senior/getkamar/" +idusroh,
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
                    loadingui.hide();
                },
                error: function(){
                    loadingui.hide();
                }
            });
        });

        function clearKamar() {
            $('select[id="idkamar"]').empty();
            $('select[id="idkamar"]').append('<option selected hidden disabled>Pilih Kamar</option>');
        }

        $('#btnDelete').on('click', function () {
            loadui();
            $("btnCancel").click();
        })

        $('#formEdit').on('submit', function () {
            loadui();
        })
    </script>
@endsection

@section('modals')
    <div class="modal fade modalDelete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Hapus Senior ini ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>PERHATIAN! Data Senior {{ $senior->nama }} akan terhapus.</p>
                </div>
                <div class="modal-footer">
                    <button id="btnCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="btnDelete" href="{{route('divman.senior.hapus', $senior->id)}}" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
@endsection