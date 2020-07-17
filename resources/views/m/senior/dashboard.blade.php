@extends('layouts.senior-m')

<style>
    .iconwrap{
        width: 25% !important; 
        margin-right: unset !important;
    }
    .iconwrap-d{
        width: 33% !important; 
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
                    <a href="/s/resident">
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
            @if (Auth::user()->isdivman) 
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5>Divisi Keamanan</h5>
                    <a href="#1">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-user icon-gradient bg-grow-early"></i>
                        <p style="font-size: .55rem;">Senior</p>
                    </div>
                    </a>
                    <a href="#4">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-box2 icon-gradient bg-sunny-morning"></i>
                        <p style="font-size: .55rem;">Usroh</p>
                    </div>
                    </a>
                    <a href="#2">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-users icon-gradient bg-malibu-beach"></i>
                        <p style="font-size: .55rem;">Resident</p>
                    </div>
                    </a>
                    <a href="#3">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-hammer icon-gradient bg-strong-bliss"></i>
                        <p style="font-size: .55rem;">Peraturan</p>
                    </div>
                    </a>
                    <a href="#3">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-note icon-gradient bg-mixed-hopes"></i>
                        <p style="font-size: .55rem;">Rekap Poin</p>
                    </div>
                    </a>
                    <a href="{{route('divman.tahun')}}">
                    <div class="font-icon-wrapper font-icon-lg iconwrap-d">
                        <i class="pe-7s-date icon-gradient bg-deep-blue"></i>
                        <p style="font-size: .55rem;">Tahun</p>
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
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                        class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <h5 class="card-title">Frekuensi Pelanggaran</h5>
                    <canvas id="chart-area" style="display: block; width: 450px; height: 225px;" width="450" height="225"
                        class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                        class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <h5 class="card-title">Median Poin</h5>
                    <canvas id="canvas" style="display: block; width: 450px; height: 225px;" height="225"
                        class="chartjs-render-monitor" width="450"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                        class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <h5 class="card-title">Doughnut</h5>
                    <canvas id="doughnut-chart" style="display: block; width: 450px; height: 225px;" width="450"
                        height="225" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"
                        class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <h5 class="card-title">Polar Chart</h5>
                    <canvas id="polar-chart" style="display: block; width: 450px; height: 225px;" width="450" height="225"
                        class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection