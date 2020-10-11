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
            width: inherit;
            height: inherit;
        }
        .profileImage {
            width: 100% !important;
            height: inherit;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/jquery.mtfpicviewer.css') }}">
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
                        <div>
                            <small>Detail</small>
                            <h4>{{$senior->nama}}</h4>
                            <h6><small>{{$senior->status==0 ? "Senior Resident" : "Assistant of Senior Resident"}}</small></h6>
                        </div>
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
                        <div class="col-md-10 profileImage">
                            <img src="{{ asset('storage/foto/' .$tahun. '/senior/' .$senior->foto)}}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <p>{{ $senior->nama }}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="NIM" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <p>{{ $senior->nim }}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <p>{{ $senior->jeniskelamin==1 ? "Putra" : "Putri"}}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="idkamar" class="col-sm-2 col-form-label">Kamar</label>
                        <div class="col-sm-10">
                            <p>{{ $senior->kamar->nomor }}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="idusroh" class="col-sm-2 col-form-label">Usroh</label>
                        <div class="col-sm-10">
                            <p>{{ $senior->usroh->nama }}</p>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.mtfpicviewer.js') }}"></script>
    <script>
        $('.profileImage').mtfpicviewer({
            selector: 'img',
        });
    </script>
@endsection