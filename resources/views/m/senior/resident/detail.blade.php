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
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="position-relative row form-group">
                        <div class="col-md-10">
                            <img src="{{ asset('storage/foto/' .$tahun. '/resident/' .$resident->foto)}}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <p>{{ $resident->nama }}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="NIM" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <p>{{ $resident->nim }}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <p>{{ $resident->jeniskelamin==1 ? "Putra" : "Putri"}}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="idkamar" class="col-sm-2 col-form-label">Kamar</label>
                        <div class="col-sm-10">
                            <p>{{ $resident->kamar->nomor }}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="idusroh" class="col-sm-2 col-form-label">Usroh</label>
                        <div class="col-sm-10">
                            <p>{{ $resident->usroh->nama }}</p>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection