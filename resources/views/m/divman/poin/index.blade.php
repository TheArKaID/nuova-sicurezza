@extends('layouts.senior-m')

@section('styles')
    <style>
        .clickable-row:hover{
            cursor: pointer;
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
                        <div>Rekap Poin {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <a href="{{route('divman.poin.download')}}" class="btn btn-success" style="float: left">
                        <i class="fa fa-file-download"></i> Rekap
                    </a>
                    <table class="mb-0 table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kamar</th>
                            <th>Total Poin</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($resident as $row => $r)
                                <tr>
                                    <td>{{ $resident->firstItem()+$row }}</td>
                                    <td>{{ $r->nama }}</td>
                                    <td>{{ $r->kamar->nomor }}</td>
                                    <td class="text-center">{{$r->getPoin()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $resident->links() }}
                </div>
            </div>
        <div>
    </div>
@endsection