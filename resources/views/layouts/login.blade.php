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
</head>
<body class="login-container">

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                @yield('content')

                <!-- Footer -->
                <div class="footer text-muted text-center">
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

<!-- Scripts -->
<script src="{{ asset('dashboard/assets/js/jquery.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/pace.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/libraries/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/loaders/blockui.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/plugins/forms/styling/uniform.min.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/app.js') }}" defer></script>
<script src="{{ asset('dashboard/assets/js/core/user_scripts.js') }}" defer></script>
</body>
</html>