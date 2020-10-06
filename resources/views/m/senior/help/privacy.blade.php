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
                <div class="card-body"><h5 class="card-title">Kebijakan Privasi</h5>
                    <div class="scroll-area-md">
                        <div class="scrollbar-container ps--active-y ps">
                            <p>
                                Kami menghargai Privasi yang anda miliki pada perangkat anda, sehingga kami berusaha
                                untuk membuat aplikasi ini dengan prinsip privasi yang baik.
                            </p>
                            <p>
                                Sicurezza memberikan kemudahan dalam pencatatan poin, pengenalan Resident, 
                                Assisten Senior Resident serta Senior Resident yang memungkinkan untuk dimuatnya data diri mereka
                                agar mudah untuk dikenali sesamanya. Karena hal itu, diharapkan pada para SR ASR untuk bisa menggunakan
                                informasi yang dapat dipertanggungjawabkan seperti Nama, NIM dan Foto.
                            </p>
                            <p>
                                Namun demikian, aplikasi ini hanya digunakan untuk internal Unires, khususnya di kalangan 
                                SR dan ASR, serta data yang disimpan pada server internal UMY membuatnya tidak dapat diakses oleh 
                                pihak lainnya.
                            </p>
                            <div class="ps__rail-x" style="left: 0px; bottom: -360px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection