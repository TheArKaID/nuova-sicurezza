@extends('layouts.senior-m')

@section('styles')
    <style>
        .iconwrap{
            width: 25% !important; 
            margin-right: unset !important;
        }
        .iconwrap-d{
            width: 25% !important; 
            margin-right: unset !important;
        }
        .iconwrap:hover{
            background-color: aliceblue !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="row">
                            <div class="main-card card mr-2 ml-2" style="display: -webkit-box;">
                                <div class="col-md-6" style="max-width: 50%">
                                    <div class="">
                                        <img style="max-width: 80%" src="{{ asset('images/icons/icon-512x512.png') }}">
                                    </div>
                                </div>
                                <div class="col-md-6" style="max-width: 50%; text-align: start">
                                    <div class="align-middle" style="display: inline-block">
                                        <div class="page-title-subheading" style="padding-top: 7px">Assalamu'alaikum, </div>
                                        {{ Auth::user()->nama }}
                                        <div class="page-title-subheading" style="padding: 0">{{ Auth::user()->status == 0 ? "Senior Resident" : "Assistant of Senior Resident" }}</div>
                                        <div class="page-title-subheading" style="padding-top: 7px">{{ $tahunaktif }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <a href="{{route('senior.senior') }}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-user-tie icon-gradient bg-grow-early"></i>
                        <p style="font-size: .55rem;">Senior</p>
                    </div>
                    </a>
                    <a href="{{ route('senior.resident') }}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-users icon-gradient bg-malibu-beach"></i>
                        <p style="font-size: .55rem;">Resident</p>
                    </div>
                    </a>
                    <a href="{{ route('senior.usroh') }}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-box icon-gradient bg-heavy-rain"></i>
                        <p style="font-size: .55rem;">Usroh</p>
                    </div>
                    </a>
                    <a href="{{ route('senior.tengko') }}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-lock icon-gradient bg-sunny-morning"></i>
                        <p style="font-size: .55rem;">Tengko</p>
                    </div>
                    </a>
                </div>
            </div>
            @if (Auth::user()->isdivman) 
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5>Divisi Keamanan</h5>
                    </a>
                    <a href="{{route('divman.usroh')}}" onclick="loadui()">
                        <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                            <i class="pe-7s-box2 icon-gradient bg-sunny-morning"></i>
                            <p style="font-size: .55rem;">Usroh</p>
                        </div>
                    </a>
                    <a href="{{route('divman.kamar')}}" onclick="loadui()">
                        <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                            <i class="pe-7s-door-lock icon-gradient bg-malibu-beach"></i>
                            <p style="font-size: .55rem;">Kamar</p>
                        </div>
                    </a>
                    <a href="{{route('divman.senior')}}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-user icon-gradient bg-grow-early"></i>
                        <p style="font-size: .55rem;">Senior</p>
                    </div>
                    <a href="{{ route('divman.resident')}}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-users icon-gradient bg-malibu-beach"></i>
                        <p style="font-size: .55rem;">Resident</p>
                    </div>
                    </a>
                    <a href="{{ route('divman.tengko')}}" onclick="loadui()">
                        <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                            <i class="pe-7s-hammer icon-gradient bg-strong-bliss"></i>
                            <p style="font-size: .55rem;">Tengko</p>
                        </div>
                    </a>
                    <a href="{{ route('divman.poin') }}" onclick="loadui()">
                        <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                            <i class="pe-7s-note icon-gradient bg-mixed-hopes"></i>
                            <p style="font-size: .55rem;">Rekap Poin</p>
                        </div>
                    </a>
                    <a href="{{route('divman.tahun')}}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-date icon-gradient bg-deep-blue"></i>
                        <p style="font-size: .55rem;">Tahun</p>
                    </div>
                    </a>
                    <a href="{{ route('divman.pengaturan')}}" onclick="loadui()">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-settings icon-gradient bg-strong-bliss"></i>
                        <p style="font-size: .55rem;">Pengaturan</p>
                    </div>
                    </a>
                </div>
            </div>
            @endif
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5>Resident</h5>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-warning">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Resident Putra</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>{{ $rputra }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-primary">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Resident Putri</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>{{ $rputri }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-heavy-rain">
                                <div class="widget-content-wrapper text-dark">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Resident</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-dark"><span>{{ $resident }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection