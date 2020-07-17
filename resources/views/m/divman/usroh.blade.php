@extends('layouts.senior-m')

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
                        <div>Usroh {{$tahun->tahunajaran}}</div>
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
                            <th>Usroh</th>
                            <th>Lantai</th>
                            <th>Gedung</th>
                        </tr>
                        </thead>
                        <tbody>
                            {{-- @php
                                $row=1;
                            @endphp
                            @foreach ($resident as $r)
                                <tr class='clickable-row' data-url='#/{{$r->id}}'>
                                    <th scope="row">{{$row}}</th>
                                    <td>{{$r->idkamar}}</td>
                                    <td>{{$r->nama}}</td>
                                    <td>{{$r->nim}}</td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach --}}
                        </tbody>
                    </table>
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