@extends('layouts.senior-m')

@section('styles')
<style>
    p {
        text-align: justify;
        text-justify: inter-word;
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
                        <h5>Sicurezza</h5>
                    </div>
                </div>
            </div>
        <div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="card-body">
                                    <p>
                                        Apabila anda memiliki Pertanyaan, Kritik ataupun Saran, 
                                        silahkan menghubungi nomor di bawah ini
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" data-url="6285712141966">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                    <div class="widget-content-left">
                                        <i class="rounded-circle fa fa-user fa-2x" width="52"></i>
                                    </div>
                                </div>
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">Arifia Kasastra R</div>
                                    <div class="widget-subheading opacity-10">
                                        <span><b class="text-success">+62 857 1214 1966</b> (WA)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" data-url="6289691908367">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                    <div class="widget-content-left">
                                        <i class="rounded-circle fa fa-user fa-2x" width="52"></i>
                                    </div>
                                </div>
                                <div class="widget-content-left flex2">
                                    <div class="widget-heading">Muhammad Miftah</div>
                                    <div class="widget-subheading opacity-10">
                                        <span><b class="text-primary">+62 896 9190 8367</b> (WA)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function($) {
        $(".list-group-item").click(function() {
            window.open("https://wa.me/"+ $(this).data("url") +"?text=Assalamu'alaikum", "_blank");
            loadui();
        });
    });
</script>
@endsection