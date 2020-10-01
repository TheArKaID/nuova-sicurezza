@extends('layouts.senior-m')

@section('styles')
    <style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
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
                        <div>Import Resident {{$tahun}}</div>
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
                        <div class="col-md-12">
                            <form method="post" action="" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <a href="{{asset('storage/import/format.xlsx')}}" class="btn btn-primary">
                                    <span class="metismenu-icon pe-7s-download"></span>
                                    Download Format
                                </a>
                                <br><br>
                                <input type="file" name="file" class="pull-left">
                                
                                <button type="submit" name="preview" class="btn btn-success">
                                    <span class="metismenu-icon pe-7s-display2"></span> Preview
                                </button>
                            </form>
                            
                            <hr>
                            
                            @if ($data)
                                <form method='post' action='{{route('divman.resident.prosesimport')}}' class="table table-responsive">
                                    {{ csrf_field() }}
                                    <div class='alert alert-danger' id='kosong'>
                                        Semua data belum diisi. <br>Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                                    </div>
                                    <table class='table table-bordered'>
                                        <tr>
                                            <th colspan='5' class='text-center'>Preview Data</th>
                                        </tr>
                                        <tr>
                                            <th>Usroh</th>
                                            <th>Kamar</th>
                                            <th>Resident</th>
                                            <th>NIM</th>
                                        </tr>
                                        @foreach ($data as $r)
                                            <tr>
                                                <td {{ $r['usroh']==null ? "style=background:#E07171" : ""}}>{{ $r['usroh'] }}</td>
                                                <td {{ $r['nomor']==null ? "style=background:#E07171" : ""}}>{{ $r['nomor'] }}</td>
                                                <td {{ $r['nama']==null ? "style=background:#E07171" : ""}}>{{ $r['nama'] }}</td>
                                                <td {{ $r['nim']==null ? "style=background:#E07171" : ""}}>{{ $r['nim'] }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    @if ($kosong==0)
                                        <hr>
                                        <button type='submit' name='import' class='btn btn-primary'><span class='metismenu-icon pe-7s-cloud-upload'></span> Upload</button>
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});

        $(".click").click(function () {
            loadui();
        })

        @if($kosong>0)
            $(document).ready(function(){
                // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                
                $("#kosong").show(); // Munculkan alert validasi kosong
            });
        @endif

    </script>
@endsection