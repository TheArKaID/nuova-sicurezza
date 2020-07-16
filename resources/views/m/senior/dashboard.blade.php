@extends('layouts.senior-m')

<style>
    .iconwrap{
        width: 25% !important; 
        margin-right: unset !important;
    }
    .iconwrap:hover{
        background-color: aliceblue !important;
    }
</style>
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
                        <h5>Hello, Mobile Dashboard</h5>
                        <div>2020/2021
                            <div class="page-title-subheading">Tahun Aktif Saat ini.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <a href="#1">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-user-tie icon-gradient bg-grow-early"></i>
                        <p style="font-size: .55rem;">Senior</p>
                    </div>
                    </a>
                    <a href="#2">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-users icon-gradient bg-malibu-beach"></i>
                        <p style="font-size: .55rem;">Resident</p>
                    </div>
                    </a>
                    <a href="#3">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-lock icon-gradient bg-sunny-morning"></i>
                        <p style="font-size: .55rem;">Peraturan</p>
                    </div>
                    </a>
                    <a href="#4">
                    <div class="font-icon-wrapper font-icon-lg iconwrap">
                        <i class="fa fa-box icon-gradient bg-heavy-rain"></i>
                        <p style="font-size: .55rem;">Usroh</p>
                    </div>
                    </a>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-dark-red">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Resident Putra</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>AAAA</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Resident Putri</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>AAAA</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-mean-fruit">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Resident</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>AAAA</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-dark-red">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Rata-rata Poin Putra</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>AAAA</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Rata-rata Poin Putri</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>AAAA</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content bg-mean-fruit">
                                <div class="widget-content-wrapper text-white">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Rata-rata Poin</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-white"><span>AAAA</span></div>
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