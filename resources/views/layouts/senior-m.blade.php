<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('assets/admin/css/main.css')}}" rel="stylesheet">
    @laravelPWA
    @yield('styles')
</head>
@php
    $uisetting['fixedsidebar'] = 1;
    $uisetting['headeroption'] = 1;
    $uisetting['fixedheader'] = 1;
    $uisetting['sidebar'] = 0;
    $uisetting['fixedfooter'] = 1;
    $uisetting['sidebaroption'] = 1;
    $page = 'home';
    $error = null;
    $success = null;
    
    // Untuk Tombol Back
    $url = explode('/', Request::url());
    array_pop($url);
    $url = implode('/', $url);

@endphp
<body>
    @yield('modals')
    <div class="app-container app-theme-white body-tabs-shadow <?php echo $uisetting['fixedsidebar'] == 1 ? ' fixed-sidebar' : ''; echo $uisetting['fixedheader'] == 1 ? ' fixed-header' : ''; echo $uisetting['fixedfooter'] == 1 ? ' fixed-footer' : ''; echo $uisetting['sidebar'] == 1 ? ' closed-sidebar' : '';?>">
        <div class="app-header header-shadow <?php echo $uisetting['headeroption']; ?>">
            <div class="app-header__logo" style="width: auto; display:flex">
                <div class="logo-src">
                    @if (!Request::is('s'))
                        <a href="/s">
                            <h5>Sicurezza</h5>
                        </a>
                    @endif
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div class="row">
                    @if (!Request::is('s'))
                        <a href="{{$url}}" class="btn btn-warning" style="line-height: 1">
                            <i class='fa fa-arrow-left'></i>
                        </a>
                    @else
                        <a href="/s">
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
                    <div>
                        <h5>Sicurezza</h5>
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
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu dropdown-menu-right" style="top: 35% !important">
                                            <button type="button" tabindex="0" class="dropdown-item">User
                                                Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="index?proses=proses-logout" tabindex="0" class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        Alina Mclourd
                                    </div>
                                    <div class="widget-subheading">
                                        VP People Manager
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button"
                                        class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
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
                    <div class='mb-3 card text-white card-body bg-danger'>
                        <h5 class='text-white card-title'>GAGAL!</h5>
                        {{ $errors->first() }}
                    </div>
                @endif
                
                @if (session()->has('sukses'))
                    <div class='mb-3 card text-white card-body bg-success'>
                        <h5 class='text-white card-title'>BERHASIL!</h5>
                        {{session()->get('sukses')}}
                    </div>
                @endif
                
                <?php 
                    if($error){
                        echo "<div class='mb-3 card text-white card-body bg-danger'>
                        <h5 class='text-white card-title'>GAGAL!</h5>";
                        switch ($error) {
                            case 'login':
                                echo "username atau password salah";
                                break;
                            case 'usroh':
                                echo "id usroh tidak sesuai format";
                                break;
                            case 'usroh-available':
                                echo "id usroh sudah terdaftar";
                                break;
                            case 'usroh-null':
                                echo "data usroh tidak ditemukan";
                                break;
                            case 'resident':
                                echo "nomor kamar tidak sesuai format";
                                break;
                            case 'resident-available':
                                echo "kamar sudah ditempati";
                                break;
                            case 'resident-null':
                                echo "data resident tidak ditemukan";
                                break;
                            case 'pelanggaran':
                                echo "masukan poin harus angka";
                                break;
                            case 'pelanggaran-null':
                                echo "data pelanggaran tidak ditemukan";
                                break;
                            case 'senior-available':
                                echo "sr/asr di usroh tujuan sudah ada";
                                break;
                            case 'senior-null':
                                echo "data senior tidak ditemukan";
                                break;
                            case 'tahun-1':
                                echo "Tahun Awal harus lebih rendah 1 tahun dari Tahun Akhir";
                                break;
                            case 'tahun-available':
                                echo "Tahun Ajaran sudah ada";
                                break;
                            case 'tahun-hapus':
                                echo "Tahun sedang Aktif. Silahkan ubah Tahun Aktif Terlebih dahulu";
                                break;
                            case 'resident-fotosize':
                                echo "Ukuran Foto maksimal 1 MB";
                                break;
                            case 'resident-fototype':
                                echo "Type file harus .png";
                                break;
                            default:
                                echo "";
                                break;
                            }
                        echo "</div>";
                    } elseif ($success) {
                        echo "<div class='mb-3 card text-white card-body bg-success'>
                            <h5 class='text-white card-title'>BERHASIL!</h5>";
                        switch ($success) {
                            case 'tahun-tambah':
                                echo "Tahun Telah Ditambahkan";
                                break;
                            case 'tahun-update':
                                echo "Tahun Telah Diubah";
                                break;
                            case 'tahun-hapus':
                                echo "Tahun Telah Dihapus";
                                break;
                            case 'resident-tambah':
                                echo "Resident Telah Ditambahkan";
                                break;
                            case 'resident-hapus':
                                echo "Resident Telah Dihapus";
                                break;
                            case 'pelanggaran-tambah':
                                echo "Pelanggaran Telah Ditambahkan";
                                break;
                            case 'pelanggaran-hapus':
                                echo "Pelanggaran Telah Dihapus";
                                break;
                            case 'senior-hapus':
                                echo "Senior Telah Dihapus";
                                break;
                            case 'senior-tambah':
                                echo "Senior Telah Ditambahkan";
                                break;
                            case 'resident-import':
                                echo "Data Resident Berhasil di Import";
                                break;
                            case 'pelanggaran-edit':
                                echo "Data Pelanggaran Berhasil Diedit";
                                break;
                            case 'senior-edit':
                                echo "Data Senior Berhasil Diedit";
                                break;
                            case 'usroh-edit':
                                echo "Data Usroh Berhasil Diedit";
                                break;
                            case 'resident-edit':
                                echo "Data Resident Berhasil Diedit";
                                break;
                            default:
                                echo "";
                                break;
                        }
                        echo "</div>";
                    }
                ?>
                    
                    @yield('content')

                </div>
                <div class="app-wrapper-footer" style="width: 100%;">
                    <div class="app-footer" style="position: unset;">
                        <div class="app-footer__inner" style="margin-left: unset">
                            <ul class="nav text-center" style="width: 100%">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        <div class="badge badge-success mr-1 ml-0">
                                            <small>NEW</small>
                                        </div>
                                        Unires
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        UMY
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

    @yield('scripts')
</body>

</html>