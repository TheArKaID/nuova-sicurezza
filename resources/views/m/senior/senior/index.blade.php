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
                        <div>Senior {{$tahun}}</div>
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
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Usroh</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $row=1;
                            @endphp
                            @foreach ($senior as $s)
                                <tr class='clickable-row' data-url='{{route('senior.senior.detail', $s->id)}}'>
                                    <th scope="row">{{$row}}</th>
                                    <td>{{$s->nama}}</td>
                                    <td>{{$s->status==0 ? "SR" : "ASR"}}</td>
                                    <td>{{$s->usroh->nama}}</td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row" style="text-align: center; display: block">
                        <a href="{{ route('senior.senior.x') }}" class="btn btn-primary" style="padding: 5px;">
                            <i class="fa fa-2x fa-sync clickable-row" style="line-height: 1"></i>
                        </a>
                    </div>
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