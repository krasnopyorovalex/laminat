<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Административная панель управления сайтом - ООО «Красбер»</title>

    <!-- Styles -->
    <link href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/colors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/override.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('admin.home') }}"><img src="{{ asset('dashboard/assets/images/logo.png') }}" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <p class="navbar-text"><span class="label bg-success">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('dashboard/assets/images/placeholder.png') }}" alt="">
                    <span>{{{ Auth::user()->name }}}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="#" id="logout-btn"><i class="icon-switch2"></i> Выйти</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">

                            <!-- Main -->
                            <li class="navigation-header"><span>Навигация</span> <i class="icon-menu" title="Main pages"></i></li>
                            <li><a href="{{ route('admin.pages.index') }}"><i class="icon-compose"></i> <span>Страницы</span></a></li>
                            <li><a href="{{ route('admin.catalogs.index') }}"><i class="icon-folder-open"></i> <span>Каталог</span></a></li>
                            <li><a href="{{ route('admin.articles.index') }}"><i class="icon-magazine"></i> <span>Статьи</span></a></li>
{{--                            <li><a href="{{ route('admin.guestbooks.index') }}"><i class="icon-bubble2"></i> <span>Отзывы</span></a></li>--}}
                            <li><a href="{{ route('admin.sliders.index') }}"><i class="icon-images2"></i> <span>Слайдер</span></a></li>
                            <li><a href="{{ route('admin.galleries.index') }}"><i class="icon-stack-picture"></i> <span>Галерея</span></a></li>
                            <li><a href="{{ route('admin.menus.index') }}"><i class="icon-lan2"></i> <span>Навигация</span></a></li>
                            <li><a href="{{ route('admin.redirects.index') }}"><i class="icon-transmission"></i> <span>Редиректы</span></a></li>
                            <!-- /main -->

                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->

                <div class="info_btn">
                    <button type="button" data-toggle="modal" data-target="#modal_info-bar" class="btn btn-primary btn-labeled btn-xlg"><b><i class="icon-info3"></i></b> Информация</button>
                </div>

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-default">

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('admin.home') }}"><i class="icon-home2 position-left"></i> Главная</a></li>
                        @section('breadcrumb')
                            <li class="active">Пропишите хлебные крошки</li>
                        @show
                    </ul>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                @yield('content')

                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; <a href="https://krasber.ru" target="_blank">ООО «Красбер»</a> 2017 - {{ date('Y') }}
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<!-- Basic modal -->
<div id="modal_info-bar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Применение shortcode'ов</h5>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Доступные shortcode'ы:</h6>
                <ul>
                    <li>Карта сайта - {sitemap}</li>
                    <li>Блог - {blog}</li>
                    <li>Расписание туров - {schedule}</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn bg-primary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<!-- /basic modal -->

<!-- Scripts -->
<script src="{{ asset('dashboard/assets/js/jquery.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/pace.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/libraries/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/blockui.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/forms/styling/uniform.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/notifications/pnotify.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/libraries/jquery_ui/interactions.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/forms/selects/select2.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/app.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/user_scripts.js') }}" defer></script>
@stack('scripts')
</body>
</html>
