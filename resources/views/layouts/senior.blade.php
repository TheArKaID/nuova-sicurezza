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
</head>
@php
    $uisetting['fixedsidebar'] = 1;
    $uisetting['headeroption'] = 1;
    $uisetting['fixedheader'] = 1;
    $uisetting['sidebar'] = 1;
    $uisetting['fixedfooter'] = 1;
    $uisetting['sidebaroption'] = 1;
    $page = 'home';
    $error = null;
    $success = null;
@endphp
<body>
    <div class="app-container app-theme-white body-tabs-shadow <?php echo $uisetting['fixedsidebar'] == 1 ? ' fixed-sidebar' : ''; echo $uisetting['fixedheader'] == 1 ? ' fixed-header' : ''; echo $uisetting['fixedfooter'] == 1 ? ' fixed-footer' : ''; echo $uisetting['sidebar'] == 1 ? ' closed-sidebar' : '';?>">
        <div class="app-header header-shadow <?php echo $uisetting['headeroption']; ?>">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic <?php echo $uisetting['sidebar'] == '1' ? '' : ' is-active' ?>"
                            onclick="setSidebarView(this)"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
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
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>
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
                                            class="dropdown-menu dropdown-menu-right">
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
        <div class="ui-theme-settings">
            <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button>
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    <div class="theme-settings__options-wrapper">
                        <h3 class="themeoptions-heading">Layout Options
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="fixed-header">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" data-toggle="toggle" onclick="setFixedHeader(this)"
                                                            data-onstyle="success" <?php echo $uisetting['fixedheader'] == 1 ? 'checked' : ''?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Header
                                                </div>
                                                <div class="widget-subheading">Makes the header top fixed, always
                                                    visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="fixed-sidebar">
                                                    <div class="switch-animate switch-on">
                                                        <input type="checkbox" data-toggle="toggle" onclick="setFixedSidebar(this)"
                                                            data-onstyle="success" <?php echo $uisetting['fixedsidebar'] == 1 ? 'checked' : ''?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Sidebar
                                                </div>
                                                <div class="widget-subheading">Makes the sidebar left fixed, always
                                                    visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="fixed-footer">
                                                    <div class="switch-animate switch-off">
                                                        <input type="checkbox" data-toggle="toggle" onclick="setFixedFooter(this)"
                                                            data-onstyle="success" <?php echo $uisetting['fixedfooter'] == 1 ? 'checked' : ''?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Fixed Footer
                                                </div>
                                                <div class="widget-subheading">Makes the app footer bottom fixed, always
                                                    visible!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>
                                Header Options
                            </div>
                            <button type="button"
                                class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class"
                                onclick="setHeader('')"
                                data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-header-cs-class" 
                                            onclick="setHeader('bg-primary header-text-light')"
                                            data-class="bg-primary header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-header-cs-class" 
                                            onclick="setHeader('bg-secondary header-text-light')"
                                            data-class="bg-secondary header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-success switch-header-cs-class" 
                                            onclick="setHeader('bg-success header-text-dark')"
                                            data-class="bg-success header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-info switch-header-cs-class" 
                                            onclick="setHeader('bg-info header-text-dark')"
                                            data-class="bg-info header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-header-cs-class" 
                                            onclick="setHeader('bg-warning header-text-dark')"
                                            data-class="bg-warning header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-header-cs-class" 
                                            onclick="setHeader('bg-danger header-text-light')"
                                            data-class="bg-danger header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-header-cs-class" 
                                            onclick="setHeader('bg-light header-text-dark')"
                                            data-class="bg-light header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-header-cs-class" 
                                            onclick="setHeader('bg-dark header-text-light')"
                                            data-class="bg-dark header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-header-cs-class" 
                                            onclick="setHeader('bg-focus header-text-light')"
                                            data-class="bg-focus header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-header-cs-class" 
                                            onclick="setHeader('bg-alternate header-text-light')"
                                            data-class="bg-alternate header-text-light">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-header-cs-class" 
                                            onclick="setHeader('bg-vicious-stance header-text-light')"
                                            data-class="bg-vicious-stance header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" 
                                            onclick="setHeader('bg-midnight-bloom header-text-light')"
                                            data-class="bg-midnight-bloom header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-header-cs-class" 
                                            onclick="setHeader('bg-night-sky header-text-light')"
                                            data-class="bg-night-sky header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-header-cs-class" 
                                            onclick="setHeader('bg-slick-carbon header-text-light')"
                                            data-class="bg-slick-carbon header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-header-cs-class" 
                                            onclick="setHeader('bg-asteroid header-text-light')"
                                            data-class="bg-asteroid header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-header-cs-class" 
                                            onclick="setHeader('bg-royal header-text-light')"
                                            data-class="bg-royal header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-header-cs-class" 
                                            onclick="setHeader('bg-warm-flame header-text-dark')"
                                            data-class="bg-warm-flame header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-header-cs-class" 
                                            onclick="setHeader('bg-night-fade header-text-dark')"
                                            data-class="bg-night-fade header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-header-cs-class" 
                                            onclick="setHeader('bg-sunny-morning header-text-dark')"
                                            data-class="bg-sunny-morning header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-header-cs-class" 
                                            onclick="setHeader('bg-tempting-azure header-text-dark')"
                                            data-class="bg-tempting-azure header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-header-cs-class" 
                                            onclick="setHeader('bg-amy-crisp header-text-dark')"
                                            data-class="bg-amy-crisp header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-header-cs-class" 
                                            onclick="setHeader('bg-heavy-rain header-text-dark')"
                                            data-class="bg-heavy-rain header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-header-cs-class" 
                                            onclick="setHeader('bg-mean-fruit header-text-dark')"
                                            data-class="bg-mean-fruit header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-header-cs-class" 
                                            onclick="setHeader('bg-malibu-beach header-text-light')"
                                            data-class="bg-malibu-beach header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-header-cs-class" 
                                            onclick="setHeader('bg-deep-blue header-text-dark')"
                                            data-class="bg-deep-blue header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-header-cs-class" 
                                            onclick="setHeader('bg-ripe-malin header-text-light')"
                                            data-class="bg-ripe-malin header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-header-cs-class" 
                                            onclick="setHeader('bg-arielle-smile header-text-light')"
                                            data-class="bg-arielle-smile header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-header-cs-class" 
                                            onclick="setHeader('bg-plum-plate header-text-light')"
                                            data-class="bg-plum-plate header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-header-cs-class" 
                                            onclick="setHeader('bg-happy-fisher header-text-dark')"
                                            data-class="bg-happy-fisher header-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" 
                                            onclick="setHeader('bg-happy-itmeo header-text-light')"
                                            data-class="bg-happy-itmeo header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" 
                                            onclick="setHeader('bg-mixed-hopes header-text-light')"
                                            data-class="bg-mixed-hopes header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-header-cs-class" 
                                            onclick="setHeader('bg-strong-bliss header-text-light')"
                                            data-class="bg-strong-bliss header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-header-cs-class" 
                                            onclick="setHeader('bg-grow-early header-text-light')"
                                            data-class="bg-grow-early header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-header-cs-class" 
                                            onclick="setHeader('bg-love-kiss header-text-light')"
                                            data-class="bg-love-kiss header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-header-cs-class" 
                                            onclick="setHeader('bg-premium-dark header-text-light')"
                                            data-class="bg-premium-dark header-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-header-cs-class" 
                                            onclick="setHeader('bg-happy-green header-text-light')"
                                            data-class="bg-happy-green header-text-light">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Sidebar Options</div>
                            <button type="button"
                                class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class"
                                onclick="setSidebar('')"
                                data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-primary sidebar-text-light')"
                                            data-class="bg-primary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-secondary sidebar-text-light')"
                                            data-class="bg-secondary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-success switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-success sidebar-text-dark')"
                                            data-class="bg-success sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-info switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-info sidebar-text-dark')"
                                            data-class="bg-info sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-warning sidebar-text-dark')"
                                            data-class="bg-warning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-danger sidebar-text-light')"
                                            data-class="bg-danger sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-light sidebar-text-dark')"
                                            data-class="bg-light sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-dark sidebar-text-light')"
                                            data-class="bg-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-focus sidebar-text-light')"
                                            data-class="bg-focus sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-alternate sidebar-text-light')"
                                            data-class="bg-alternate sidebar-text-light">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-vicious-stance sidebar-text-light')"
                                            data-class="bg-vicious-stance sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-midnight-bloom sidebar-text-light')"
                                            data-class="bg-midnight-bloom sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-night-sky sidebar-text-light')"
                                            data-class="bg-night-sky sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-slick-carbon sidebar-text-light')"
                                            data-class="bg-slick-carbon sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-asteroid sidebar-text-light')"
                                            data-class="bg-asteroid sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-royal sidebar-text-light')"
                                            data-class="bg-royal sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-warm-flame sidebar-text-dark')"
                                            data-class="bg-warm-flame sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-night-fade sidebar-text-dark')"
                                            data-class="bg-night-fade sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-sunny-morning sidebar-text-dark')"
                                            data-class="bg-sunny-morning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-tempting-azure sidebar-text-dark')"
                                            data-class="bg-tempting-azure sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-amy-crisp sidebar-text-dark')"
                                            data-class="bg-amy-crisp sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-heavy-rain sidebar-text-dark')"
                                            data-class="bg-heavy-rain sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-mean-fruit sidebar-text-dark')"
                                            data-class="bg-mean-fruit sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-malibu-beach sidebar-text-light')"
                                            data-class="bg-malibu-beach sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-deep-blue sidebar-text-dark')"
                                            data-class="bg-deep-blue sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-ripe-malin sidebar-text-light')"
                                            data-class="bg-ripe-malin sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-arielle-smile sidebar-text-light')"
                                            data-class="bg-arielle-smile sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-plum-plate sidebar-text-light')"
                                            data-class="bg-plum-plate sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-happy-fisher sidebar-text-dark')"
                                            data-class="bg-happy-fisher sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-happy-itmeo sidebar-text-light')"
                                            data-class="bg-happy-itmeo sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-mixed-hopes sidebar-text-light')"
                                            data-class="bg-mixed-hopes sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-strong-bliss sidebar-text-light')"
                                            data-class="bg-strong-bliss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-grow-early sidebar-text-light')"
                                            data-class="bg-grow-early sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-love-kiss sidebar-text-light')"
                                            data-class="bg-love-kiss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-premium-dark sidebar-text-light')"
                                            data-class="bg-premium-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-sidebar-cs-class"
                                            onclick="setSidebar('bg-happy-green sidebar-text-light')"
                                            data-class="bg-happy-green sidebar-text-light">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow <?php echo $uisetting['sidebaroption']; ?>">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                onclick="setSidebarView(this)"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
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
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="index?page=home" <?php echo $page=="home" ? "class='mm-active'" : false;?>>
                                    <i class="metismenu-icon pe-7s-home"></i>
                                    Home
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Master Sicurezza</li>
                            <li>
                                <a href="index?page=senior"  <?php echo $page=="senior" ? "class='mm-active'" : false;?>>
                                    <i class="metismenu-icon pe-7s-user">
                                    </i>Senior
                                </a>
                            </li>
                            <li>
                                <a href="index?page=usroh" <?php echo $page=="usroh" ? "class='mm-active'" : false;?>>
                                    <i class="metismenu-icon pe-7s-box2">
                                    </i>Usroh
                                </a>
                            </li>
                            <li>
                                <a href="index?page=resident" <?php echo $page=="resident" ? "class='mm-active'" : false;?>>
                                    <i class="metismenu-icon pe-7s-users">
                                    </i>Resident
                                </a>
                            </li>
                            <li>
                                <a href="index?page=pelanggaran" <?php echo $page=="pelanggaran" ? "class='mm-active'" : false;?>>
                                    <i class="metismenu-icon pe-7s-hammer">
                                    </i>Pelanggaran
                                </a>
                            </li>
                            <li>
                                <a href="index?page=poin" <?php echo $page=="poin" ? "class='mm-active'" : false;?>>
                                    <i class="metismenu-icon pe-7s-note">
                                    </i>Rekap Poin
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Master Tahun Ajaran</li>
                            <li>
                                <a href="{{route('tahun')}}"  <?php echo $page=="tahun" ? "class='mm-active'" : false;?>>
                                    <i class="metismenu-icon pe-7s-date">
                                    </i>Manage Tahun
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
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
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 1
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 2
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Footer Link 3
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <div class="badge badge-success mr-1 ml-0">
                                                <small>NEW</small>
                                            </div>
                                            Footer Link 4
                                        </a>
                                    </li>
                                </ul>
                            </div>
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