@extends('layouts.auth')

@section('styles')
    <style>
        .empty-state {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
        }
        .empty-state-icon {
            position: relative;
            background-color: #6777ef;
            width: 80px;
            height: 80px;
            border-radius: 5px;
            font-size: 38pt;
            color: white
        }
    </style>
@endsection
@section('content')
    <div class="col-md-4"></div>
    <div class="col-md-4 centered">
        <div class="card">
            <div class="card-body"><h5 class="card-title">Login</h5>
                <div class="empty-state" data-height="400" style="height: 400px;">
                    <div class="empty-state-icon bg-danger">
                        <span style="">?</span>
                    </div>
                    <h4>Kami tidak dapat membuka Sicurezza saat ini</h4>
                    <p class="lead">
                        Pastikan anda memiliki koneksi internet yang stabil.
                    </p>
                    <a href="{{route('senior.login')}}" class="btn btn-success mt-4">Refresh!</a>
                </div>
            </div>
        </div>
    </div>
    <div class="vol-md-4"></div>

@endsection