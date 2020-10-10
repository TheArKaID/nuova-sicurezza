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
                        <div>Tengko {{$tahun}}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <a href="{{route('divman.tengko.tambah')}}" onclick="loadui()" class="btn btn-success btn-sm" style="float: right"><i class="fa fa-plus-square"></i></a>
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
                                <tr class='clickable-row' data-url='{{route('divman.tengko.detail', $t->id)}}'>
                                    <th scope="row">{{$row}}</th>
                                    <td class="text-center">
                                        <div class="mb-2 mr-2 badge 
                                            {{ $t->tipe=="Ringan" ? "badge-warning" : "" }}
                                            {{ $t->tipe=="Sedang" ? "badge-danger" : "" }}
                                            {{ $t->tipe=="Berat" ? "badge-dark" : "" }}">
                                            {{$t->tipe}}
                                        </div>
                                    </td>
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

@section('scripts')

<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("url");
            loadui();
        });
    });
</script>    
@endsection