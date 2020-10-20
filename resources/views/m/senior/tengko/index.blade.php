@extends('layouts.senior-m')

@section('styles')
<style>
    .iconwrap{
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
                        <div class="page-title-icon">
                            <i class="pe-7s-home icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Tengko {{ $tahun }}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <ul class="nav nav-justified">
                        <li class="nav-item"><a data-toggle="tab" href="#tab-ringan" class="nav-link active show">Ringan</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#tab-sedang" class="nav-link show">Sedang</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#tab-berat" class="nav-link show">Berat</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <form action="{{ route('senior.tengko') }}" method="get">
                            <div class="row justify-content-center">
                                <div class="col-xs-10">
                                    <input type="text" placeholder="Penjelasan..." value="{{ isset($_GET['cari']) ? $_GET['cari'] : '' }}" name="cari" id="cari" class="form-control">
                                </div>
                                <div class="col-xs-2">
                                    <button type="submit" class="form-control btn-primary">Cari</button>
                                </div>
                                <small class="text-primary">*Pencarian akan berlaku untuk semua Tipe</small>
                            </div>
                        </form>
                        <div class="tab-pane active show" id="tab-ringan" role="tabpanel">
                            <table class="mb-0 table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Penjelasan</th>
                                    <th>Poin</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $row=1;
                                    @endphp
                                    @foreach ($tengko['ringan'] as $r)
                                        <tr>
                                            <th scope="row">{{$row}}</th>
                                            <td>{{$r->penjelasan}}</td>
                                            <td>{{$r->poin}}</td>
                                        </tr>
                                        @php
                                            $row++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>   
                        </div>
                        <div class="tab-pane show" id="tab-sedang" role="tabpanel">
                            <table class="mb-0 table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Penjelasan</th>
                                    <th>Poin</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $row=1;
                                    @endphp
                                    @foreach ($tengko['sedang'] as $s)
                                        <tr>
                                            <th scope="row">{{$row}}</th>
                                            <td>{{$s->penjelasan}}</td>
                                            <td>{{$s->poin}}</td>
                                        </tr>
                                        @php
                                            $row++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane show" id="tab-berat" role="tabpanel">
                            <table class="mb-0 table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Penjelasan</th>
                                    <th>Poin</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $row=1;
                                    @endphp
                                    @foreach ($tengko['berat'] as $b)
                                        <tr>
                                            <th scope="row">{{$row}}</th>
                                            <td>{{$b->penjelasan}}</td>
                                            <td>{{$b->poin}}</td>
                                        </tr>
                                        @php
                                            $row++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection