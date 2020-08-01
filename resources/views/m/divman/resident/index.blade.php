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
                        <div>Resident {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <a href="{{route('divman.resident.tambah')}}" class="btn btn-success btn-sm" style="float: right"><i class="fa fa-plus-square"></i></a>
                    <table class="mb-0 table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Kamar</th>
                            <th>Usroh</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $row=1;
                            @endphp
                            @foreach ($resident as $r)
                                <tr class='clickable-row' data-url='{{route('divman.resident.detail', $r->id)}}'>
                                    <th scope="row">{{$row}}</th>
                                    <td>{{$r->nama}}</td>
                                    <td>{{$r->kamar->nomor}}</td>
                                    <td>{{$r->usroh->nama}}</td>
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

@section('scripts')

<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("url");
        });
    });
</script>    
@endsection