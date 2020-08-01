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
                        <div>{{ $usroh->nama }}</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="row" style="display: grid">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper clickable-row" style="float: left" data-url='{{isset($senior[0]) ? route('senior.senior.detail', $senior[0]["id"]) : '#'}}'>
                                <div class="widget-content-left mr-1">
                                    <div class="widget-content-left">
                                        @if (isset($senior[0]))
                                            <img class="rounded-circle" src="{{ asset('storage/foto/' .$tahun. '/senior/' .$senior[0]['foto'])}}" alt="" width="30">
                                        @else
                                            <img class="rounded-circle" src="{{ asset('images/user-default.jpg')}}" alt="" width="30">
                                        @endif
                                    </div>
                                </div>
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">{{isset($senior[0]) ? $senior[0]['nama'] : "-"}}</div>
                                    <div class="widget-subheading opacity-7">SR</div>
                                </div>
                            </div>
                            <div class="widget-content-wrapper clickable-row" style="float: right; text-align: right" data-url='{{isset($senior[1]) ? route('senior.senior.detail', $senior[1]["id"]) : '#'}}'>
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">{{isset($senior[1]) ? $senior[1]['nama'] : "-"}}</div>
                                    <div class="widget-subheading opacity-7">ASR</div>
                                </div>
                                <div class="widget-content-left mr-1">
                                    <div class="widget-content-left">
                                        @if (isset($senior[1]))
                                            <img class="rounded-circle" src="{{ asset('storage/foto/' .$tahun. '/senior/' .$senior[1]['foto'])}}" alt="" width="30">
                                        @else
                                            <img class="rounded-circle" src="{{ asset('images/user-default.jpg')}}" alt="" width="30">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    
                    <hr>

                    <div class="row">
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <tbody>
                                @foreach ($resident as $r)
                                    <tr class='clickable-row' data-url='{{route('senior.resident.detail', $r->id)}}'>
                                        <td class="text-center text-muted">{{$r->kamar->nomor}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img class="rounded-circle" src="{{ asset('storage/foto/' .$tahun. '/resident/' .$r->foto)}}" alt="" width="40" height="40">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{$r->nama}}</div>
                                                        <div class="widget-subheading opacity-7">{{$r->nim}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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

@section('scripts')

<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("url");
        });
    });
</script>    
@endsection