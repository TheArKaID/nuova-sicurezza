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
                        <div>Tambah Resident {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <a href="{{route('divman.resident.import')}}" class="btn btn-primary click">
                            <span class="badge badge-pill badge-light" style="margin-left: 0px;">
                                <i class="fa fa-cloud-upload-alt"></i>
                            </span> Import
                        </a>
                    </div>
                    <form action="{{route('divman.resident.tambah')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p>*<small style="color: blue"> is required</small></p>
                        <hr>

                        <div class="position-relative row form-group">
                            <label for="nama" class="col-sm-2 col-form-label">*Nama</label>
                            <div class="col-sm-10">
                                <input name="nama" id="nama" placeholder="Nama Resident" type="text" class="form-control" value="{{old('nama')}}" required>
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
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input name="foto" id="foto" placeholder="Foto" type="file" class="form-control">
                                <small>File JPG, JPEG, PNG | Max Size : 2mb</small>
                            </div>
                        </div>
                        
                        <hr>

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
                                <button class="btn btn-secondary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div>
    </div>
@endsection

@section('scripts')
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

        $(".click").click(function () {
            loadui();
        })
    </script>
@endsection