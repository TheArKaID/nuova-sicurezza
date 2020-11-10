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
                        <div>Kamar {{$tahun}}</div>
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
                        <form action="/s/d-kamar" method="get">
                            <div class="row">
                                <input type="text" placeholder="Penjelasan..." value="{{ isset($_GET['cari']) ? $_GET['cari'] : '' }}" name="cari" id="cari" class="form-control" style="width: 66.6%">
                                <button type="submit" class="btn btn-sm btn-primary" style="width: 33.3%" onclick="loadui()">Cari</button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <a href="{{route('divman.kamar.tambah')}}" class="btn btn-success btn-md" style="float: right" onclick="loadui()"><i class="fa fa-plus-square"></i></a>
                    <table class="mb-0 table table-hover table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kamar</th>
                            <th>Usroh</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $row=1;
                            @endphp
                            @foreach ($kamar as $row => $k)
                                <tr class='clickable-row' data-url='{{route('divman.kamar.detail', $k->id)}}'>
                                    <th scope="row">{{ $kamar->firstItem() + $row }}</th>
                                    <td>{{$k->nomor}}</td>
                                    <td>{{$k->usroh->nama}}</td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    {{ $kamar->links() }}
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