@extends('layouts.senior-m')

@section('styles')
    <style>
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
                        <div>{{ $usroh->nama }}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row" style="display: grid">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper" style="float: left">
                                <div class="widget-content-left mr-1">
                                    <div class="widget-content-left">
                                        <img class="rounded-circle" src="assets/images/avatars/4.jpg" alt="" width="30">
                                    </div>
                                </div>
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">John Doe</div>
                                    <div class="widget-subheading opacity-7">SR</div>
                                </div>
                            </div>
                            <div class="widget-content-wrapper" style="float: right; text-align: right">
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">John Doe</div>
                                    <div class="widget-subheading opacity-7">ASR</div>
                                </div>
                                <div class="widget-content-left mr-1">
                                    <div class="widget-content-left">
                                        <img class="rounded-circle" src="assets/images/avatars/4.jpg" alt="" width="30">
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <hr>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td class="text-center text-muted">U401A</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img class="rounded-circle" src="assets/images/avatars/4.jpg" alt="" width="40">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">John Doe</div>
                                                    <div class="widget-subheading opacity-7">Teknik Mesin</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">20170140001</td>
                                </tr>
                                <tr>
                                    <td class="text-center text-muted">U401B</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img class="rounded-circle" src="assets/images/avatars/3.jpg" alt="" width="40">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">Ruben Tillman</div>
                                                    <div class="widget-subheading opacity-7">Agribisnis</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">20170140011</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection