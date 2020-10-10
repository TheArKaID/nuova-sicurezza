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
                    <a href="{{route('divman.resident.tambah')}}" class="btn btn-success btn-sm" onclick="loadui()" style="float: right; margin-bottom: 5px"><i class="fa fa-plus-square"></i></a>
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
                            @foreach ($resident as $row => $r)
                                <tr class='clickable-row' data-url='{{route('divman.resident.detail', $r->id)}}'>
                                    <th scope="row">{{$resident->firstItem() + $row}}</th>
                                    <td>{{$r->nama}}</td>
                                    <td>{{$r->kamar->nomor}}</td>
                                    <td>{{$r->usroh->nama}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$resident->links()}}
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