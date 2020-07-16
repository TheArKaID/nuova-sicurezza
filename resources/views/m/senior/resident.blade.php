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
                        <div>Resident 2020/2021</div>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Table with hover</h5>
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kamar</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class='clickable-row' data-url='#1'>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr class='clickable-row' data-url='#2'>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr class='clickable-row' data-url='#3'>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
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