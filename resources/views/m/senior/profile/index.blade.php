@extends('layouts.senior-m')

@section('styles')
<style>
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
                        <h4>Update Profile</h4>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <form id="formProfile" action="{{ route('senior.profile.save') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div id="alertPasscode" class="alert alert-danger alert-dismissible" style="display: none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h5 class='card-title'>Gagal!</h5>
                        Maaf, mohon update browser anda. Fitur Passcode tidak dapat digunakan.
                    </div>
                    <div class="card-body">
                        <div id="accordion" class="accordion-wrapper mb-3">
                            <div class="card">
                                <button type="button" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-block collapsed">
                                    <div id="headingOne" class="card-header">
                                        <h5 class="m-0 p-0 text-left" style="color: #3f6ad8">Profile</h5>
                                    </div>
                                </button>
                                <div data-parent="#accordion" id="collapseProfile" aria-labelledby="headingOne" class="collapse show" style="">
                                    <div class="card-body">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="{{ $profile->username }}" disabled>
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $profile->nama }}" required>
                                        <label>NIM</label>
                                        <input type="text" name="nim" class="form-control" value="{{ $profile->nim }}" required>

                                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-md-10">
                                            @if (!$profile->foto)
                                                <small>Anda belum menambahkan foto</small>
                                            @else
                                                <small>Saat ini</small>
                                                <img id="currfoto" src="{{ asset('storage/foto/' .$tahun. '/senior/' .$profile->foto)}}" alt="" srcset="">
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
                            </div>
                            <div class="card">
                                <button type="button" data-toggle="collapse" data-target="#collapsePassword" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-block">
                                    <div id="headingTwo" class="b-radius-0 card-header">
                                        <h5 class="m-0 p-0 text-left" style="color: #3f6ad8">Password</h5>
                                    </div>
                                </button>
                                <div data-parent="#accordion" id="collapsePassword" class="collapse">
                                    <div class="card-body">
                                        <p><small style="color: blue">Abaikan jika tidak ingin Mengganti Password</small></p>
                                        <label for="newpassword">New Password</label>
                                        <input type="password" name="newpassword" class="form-control" placeholder="Password Baru">
                                        <label for="renewpassword">Re New Password</label>
                                        <input type="password" name="renewpassword" class="form-control" placeholder="Ulangi Password">
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <button type="button" data-toggle="collapse" data-target="#collapsePasscode" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-block">
                                    <div id="headingTwo" class="b-radius-0 card-header">
                                        <h5 class="m-0 p-0 text-left" style="color: #3f6ad8">Passcode</h5>
                                    </div>
                                </button>
                                <div data-parent="#accordion" id="collapsePasscode" class="collapse">
                                    <div class="card-body">
                                        <p><small style="color: blue"><i>Quick Login</i> dengan Passcode</small></p>
                                        <label for="passcode">Passcode</label>
                                        <input type="number" name="passcode" minlength="6" maxlength="6" class="form-control" placeholder="Passcode">
                                        <label for="repasscode">Re Passcode</label>
                                        <input type="number" name="repasscode" minlength="6" maxlength="6" class="form-control" placeholder="Ulangi Passcode">
                                        <p><small style="color: {{ $profile->passcode ? 'green' : 'red' }}">{{ $profile->passcode ? 'Passcode Terpasang' : 'Passcode Tidak Dipasang'}}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="border-top: 1px solid rgba(26,54,126,0.125)">
                        <h5><label>Konfirmasi Password</label></h5>
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success mt-3">Simpan</button>
                        </div>
                    </div>
                </form>
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
    <script>
        
        $('#formProfile').on('submit', function () {
            loadui();
        })

        $(document).ready(function () {
            var passcode = "{{ session('passcode', false) }}";
            
            if(passcode) {
                if (typeof(Storage) !== "undefined") {
                    localStorage.setItem("passcode", passcode);
                } else {
                    $('#alertPasscode').attr('style', 'display: block');
                }
            }
            var passcoderemove = "{{ session('passcoderemove', false) }}";
            if (passcoderemove){
                localStorage.removeItem("passcode");
            }
        })

    </script>
@endsection