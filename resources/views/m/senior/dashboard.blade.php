@extends('layouts.senior-m')

<style>
    .bgmenu{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        height: auto;
        background: #fafbfc;
        box-shadow: 0 .46875rem 2.1875rem
        rgba(4,9,20,0.03),0 .9375rem 1.40625rem rgba(4,9,20,0.03),0 .25rem .53125rem rgba(4,9,20,0.05),0 .125rem .1875rem
        rgba(4,9,20,0.03);
        position: relative;
        z-index: 10;
        transition: all .2s;
    }

    .menu{
        display: flex;
        order: 3;
        padding: 0 1.5rem;
        height: 60px;
        align-items: center;
    }

    .rowmenu{
        width: 100%;
        justify-content: space-between;
        align-items: center;
        align-content: center;
        margin-left: unset !important;
        margin-right: unset !important;
    }
</style>
@section('content')
    Hello, Mobile Dashboard
    <div class="bgmenu">
        <div class="row rowmenu">
            <div class="menu">
                <span>
                    <a class="btn btn-primary" href="#">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-home fa-w-6"></i>
                        </span>
                    </a>
                </span>
            </div>
            <div class="menu">
                <span>
                    <a class="btn btn-primary" href="#">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-user fa-w-6"></i>
                        </span>
                    </a>
                </span>
            </div>
            <div class="menu">
                <span>
                    <a class="btn btn-primary" href="#">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-users fa-w-6"></i>
                        </span>
                    </a>
                </span>
            </div>
            <div class="menu">
                <span>
                    <a class="btn btn-primary" href="#">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-user-tie fa-w-6"></i>
                        </span>
                    </a>
                </span>
            </div>
        </div>
    </div>
@endsection