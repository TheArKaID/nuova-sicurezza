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
                        <div>Resident {{Auth::user()->usroh->nama}}</div>
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
                            <th>Kamar</th>
                            <th>Nama</th>
                            <th>NIM</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if ($resident!==null)
                                @foreach ($resident as $row => $r)
                                    <tr class='clickable-row' data-url='{{ route('senior.resident.detail', $r->id)}}'>
                                        <th scope="row">{{$row+1}}</th>
                                        <td>{{$r->kamar->nomor}}</td>
                                        <td>{{$r->nama}}</td>
                                        <td>{{$r->nim}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4" style="text-align: center"><i>Tidak ada Resident</i></td></tr>
                            @endif  
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