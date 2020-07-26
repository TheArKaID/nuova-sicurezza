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
                        <a href="{{route('senior.resident.poin', $resident->id)}}" class="btn btn-small btn-primary" style="float: right">Poin</a>
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
        <div>
    </div>
@endsection