<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sicurezza di Unires</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('assets/admin/css/main.css')}}" rel="stylesheet">
    @laravelPWA
    @yield('styles')
</head>
@php    
    // Untuk Tombol Back
    $url = explode('/', Request::url());
    array_pop($url);
    $url = implode('/', $url);

@endphp
<body>
    <div id="loadingui" style="display: block">
        <div class="blockUI blockOverlay" style="border: medium none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; position: fixed;"></div>
        <div class="blockUI undefined blockPage" style="position: fixed; opacity: 1; left: 30%">
            <div class="body-block-example-1 d-none" style="cursor: default;">
                <div class="loader-wrapper d-flex justify-content-center align-items-center">
                    <div class="loader">
                        <div class="ball-rotate">
                            <div style="background-color: rgb(247, 185, 36);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('modals')
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header fixed-footer closed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo" style="width: auto; display:flex">
                <div class="logo-src">
                    @if (!Request::is('s'))
                        <a href="/s" onclick="loadui()">
                            <h5>Sicurezza</h5>
                        </a>
                    @endif
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div class="row">
                    @if (!Request::is('s'))
                        <a href="{{$url}}" class="btn btn-warning" style="line-height: 1" onclick="loadui()">
                            <i class='fa fa-arrow-left'></i>
                        </a>
                    @else
                        <a href="/s" onclick="loadui()">
                            <h5>Sicurezza</h5>
                        </a>
                    @endif
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content" style="top: 160px;">
                <div class="app-header-left">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            Your Profile Viewed by <span id="viewername">Nobody</span>
                        </div>
                        <div class="ml-auto badge badge-pill badge-success col-md-4">New</div>
                    </div>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <i class="fa fa-user-tie fa-2x rounded-circle" width="42"></i>
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" style="top: 35% !important">
                                            <a href="{{ route('senior.profile') }}" onclick="loadui()"><button type="button" tabindex="0" class="dropdown-item">Profile</button></a>
                                            <h6 tabindex="-1" class="dropdown-header"> - Help - </h6>
                                            <a href="{{ route('senior.help.about') }}"><button type="button" tabindex="0" class="dropdown-item" onclick="loadui()">About</button></a>
                                            <a href="{{ route('senior.help.contact') }}"><button type="button" tabindex="0" class="dropdown-item" onclick="loadui()">Contact</button></a>
                                            <a href="{{ route('senior.help.privacy') }}"><button type="button" tabindex="0" class="dropdown-item" onclick="loadui()">Privacy</button></a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="{{ route('senior.logout') }}" tabindex="0" class="dropdown-item" onclick="loadui()">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-main__outer" style="padding-bottom: unset;padding-left: unset">
                <div class="app-main__inner" style="padding: 15px 15px 0;">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h5 class='card-title'>Gagal!</h5>
                        {{ $error }}
                    </div>
                    @endforeach
                @endif
                
                @if (session()->has('sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h5 class='card-title'>Berhasil!</h5>
                        {{ session()->get('sukses') }}
                    </div>
                @endif
                    
                    @yield('content')

                </div>
                <div class="app-wrapper-footer" style="width: 100%;">
                    <div class="app-footer" style="position: unset;">
                        <div class="app-footer__inner" style="margin-left: unset">
                            <ul class="nav text-center" style="width: 100%">
                                <li class="nav-item">
                                    <a href="https://unires.umy.ac.id" target="_blank" class="mr-1 btn btn-primary">
                                        Unires <span class="badge badge-light">Site</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://umy.ac.id" target="_blank" class="mr-1 btn btn-success">
                                        UMY <span class="badge badge-light">Site</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('assets/admin/js/main.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    <script>
        var loadingui = $('#loadingui');
        jQuery(document).ready(function(){
            loadingui.hide();
        });
        function loadui() {
            loadingui.show();
            setTimeout(() => {
                loadingui.hide();
            }, 10000);
        }
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
         Pusher.logToConsole = true;

        var pusher = new Pusher('a7c47123512fbd61abbe', {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('user.'+{{Auth::user()->id}});
        channel.bind('profile-view', function(data) {
            $('#viewername').html(data.sender.nama);
            alert(JSON.stringify(data.sender));
        });
    </script>
    @yield('scripts')
</body>

</html>