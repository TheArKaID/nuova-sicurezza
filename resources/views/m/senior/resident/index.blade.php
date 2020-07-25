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
                    <div id="accordion" class="accordion-wrapper mb-3">
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($resident as $usroh => $res)
                            <div class="card">
                                <div id="headingOne">
                                    <button type="button" data-toggle="collapse" data-target="#collapse{{$num}}" aria-expanded="false" aria-controls="collapseOne" class="list-group-item-action list-group-item btn-link btn-block">
                                        <h5 class="m-0 p-0">{{$usroh}}</h5>
                                    </button>
                                </div>
                                <div data-parent="#accordion" id="collapse{{$num}}" aria-labelledby="headingOne" class="collapse">
                                    <div class="card-body">
                                        <table class="mb-0 table table-hover table-responsive">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kamar</th>
                                                <th>Nama</th>
                                                <th>NIM</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $row=1;
                                                @endphp
                                                @foreach ($res as $r)
                                                    <tr class='clickable-row' data-url='{{ route('senior.resident.detail', $r->id)}}'>
                                                        <th scope="row">{{$row}}</th>
                                                        <td>{{$r->kamar->nomor}}</td>
                                                        <td>{{$r->nama}}</td>
                                                        <td>{{$r->nim}}</td>
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
                            @php
                                $num++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        <div>
    </div>
@endsection

@section('scripts')
<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("url");
        });
    });
</script>    
@endsection