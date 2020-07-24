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
                <div class="card-body">
                    <table class="mb-0 table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipe</th>
                            <th>Penjelasan</th>
                            <th>Poin</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $row=1;
                            @endphp
                            @foreach ($tengko as $t)
                                <tr>
                                    <th scope="row">{{$row}}</th>
                                    <td>{{$t->tipe}}</td>
                                    <td>{{$t->penjelasan}}</td>
                                    <td>{{$t->poin}}</td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        <div>
    </div>
@endsection