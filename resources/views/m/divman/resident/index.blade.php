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
                    <div class="container">
                        <form action="/s/d-resident" method="get">
                            <div class="row">
                                <input type="text" placeholder="Nama Resident" value="{{ isset($_GET['nama']) ? $_GET['nama'] : '' }}" name="nama" id="nama" class="form-control" style="width: 66.6%">
                                <button type="submit" class="btn btn-md btn-primary" style="width: 33.3%" onclick="loadui()">Cari</button>
                            </div>
                        </form>
                    </div>
                    <a href="{{route('divman.resident.tambah')}}" class="btn btn-success btn-sm mt-2" onclick="loadui()" style="float: right; margin-bottom: 5px"><i class="fa fa-plus-square"></i></a>
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