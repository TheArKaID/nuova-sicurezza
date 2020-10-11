@extends('layouts.senior-m')

@section('styles')
    <style>
        small{
            color: green
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
                        <div>Tambah Senior {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form id="formAdd" action="{{route('divman.senior.tambah')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p><small style="color: blue">* is required</small></p>
                        <hr>

                        <div class="position-relative row form-group">
                            <label for="nama" class="col-sm-2 col-form-label">*Nama</label>
                            <div class="col-sm-10">
                                <input name="nama" id="nama" placeholder="Nama Senior" type="text" class="form-control" value="{{old('nama')}}" required>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="NIM" class="col-sm-2 col-form-label">*NIM</label>
                            <div class="col-sm-10">
                                <input name="nim" id="NIM" placeholder="NIM" type="number" class="form-control" value="{{old('nim')}}">
                                <small>11 Digit</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="jeniskelamin" class="col-sm-2 col-form-label">*Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="jeniskelamin" id="jeniskelamin" class="form-control" required>
                                    <option selected hidden disabled>Jenis Kelamin</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="0">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
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
                                <input name="username" id="username" placeholder="Username" type="text" class="form-control" value="{{old('username')}}" required>
                                <small>4-10 Karakter</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="password" class="col-sm-2 col-form-label">*Password</label>
                            <div class="col-sm-10">
                                <input name="password" id="password" placeholder="Password" type="password" class="form-control" required>
                                <small>8-20 Karakter</small>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="repassword" class="col-sm-2 col-form-label">*Ulangi Password</label>
                            <div class="col-sm-10">
                                <input name="repassword" id="repassword" placeholder="Ulangi Password" type="password" class="form-control" required>
                                <small>8-20 Karakter</small>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="position-relative row form-group">
                            <label for="isdivman" class="col-sm-2 col-form-label">*Divisi Keamanan</label>
                            <div class="col-sm-10">
                                <select name="isdivman" id="isdivman" class="form-control" required>
                                    <option selected hidden disabled>Divisi Keamanan</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="status" class="col-sm-2 col-form-label">*Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control" required>
                                    <option selected hidden disabled>Status Senior</option>
                                    <option value="0">Senior Resident</option>
                                    <option value="1">Assistant of Senior Resident</option>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idusroh" class="col-sm-2 col-form-label">*Usroh</label>
                            <div class="col-sm-10">
                                <select name="idusroh" id="idusroh" class="form-control" required>
                                    <option selected hidden disabled>Pilih Usroh</option>
                                    @foreach ($usroh as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="idkamar" class="col-sm-2 col-form-label">*Kamar</label>
                            <div class="col-sm-10">
                                <select name="idkamar" id="idkamar" class="form-control" required>
                                    <option selected hidden disabled>Pilih Kamar</option>
                                </select>
                            </div>
                        </div>

                        <hr>

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

        $('#formAdd').on('submit', function () {
            loadui();
        })
    </script>
@endsection