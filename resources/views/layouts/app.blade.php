<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes"/>
    <title>@yield('title', 'Мебель для гостиниц')</title>
    <meta name="description" content="@yield('description', '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#eee">
    @stack('og')
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon" />
    <link rel="canonical" href="@yield('canonical', request()->url())"/>
</head>
<body>
    <div class="loader">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="loader__bg"></div>

    <header>
        <div class="top__line">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="logo">
                            <a href="/">
                                <img src="{{ asset('img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="address">
                            <span class="box_rounded">
                                {{ svg('map') }}
                            </span>
                            г. Симферополь, проспект победы 209Н
                            <div class="phone">
                                <a href="#">
                                    <span class="box_rounded">
                                        {{ svg('phone') }}
                                    </span>
                                    +7(978) 706-50-92 Ярослава
                                </a>
                            </div>
                            <div class="phone">
                                <a href="#">
                                    <span class="box_rounded">
                                        {{ svg('phone') }}
                                    </span>
                                    +7(978) 706-50-93 Владимир
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="search__socials-icons">
                            <div class="btn call__popup" data-target="popup__recall">
                                Перезвонить Вам?
                                {{ svg('call') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav id="sticker">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="box_catalog">
                            <div class="btn_catalog">
                                каталог товаров
                            </div>
                            <div class="btn_toggle">
                                <span></span>
                            </div>
                            @include('layouts.partials.categories_menu')
                        </div>
                    </div>
                    <div class="col-9">
                        @includeWhen($menu->get('menu_header'), 'layouts.menus.header', ['menu' => $menu])
                        <div class="call__popup call__btn visible__sm"></div>
                        <div class="burger-mob visible__sm">
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer itemtype="http://schema.org/WPFooter" itemscope="" @unless(isset($map))class="not_map" @endunless>
        @isset($map)
            <div class="map">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A12411d9035b4f83093cb17a321a2359ea473e2d59cb36b1c72b205a623335ba8&amp;source=constructor" width="100%" height="650" frameborder="0"></iframe>
            </div>
        @endisset
        <div class="@isset($map)contacts_map @endisset">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        @includeWhen($menu->get('menu_header'), 'layouts.menus.footer', ['menu' => $menu])
                    </div>
                    <div class="col-2">
                        <ul>
                            <li><a href="{{ route('page.show',['alias' => 'blog']) }}">Блог</a></li>
                            <li><a href="{{ route('page.show', ['alias' => 'kontakti']) }}">Контакты</a></li>
                            <li><a href="{{ route('page.show',['alias' => 'sitemap']) }}">Карта сайта</a></li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <div class="contact">
                            {{ svg('map') }}
                            Республика Крым, Симферополь
                        </div>
                        <div class="contact">
                            {{ svg('phone') }}
                            <a href="tel:+79787157355" title="Позвонить">+7 (978) 715-73-55</a>
                        </div>
                        <div class="contact">
                            {{ svg('phone') }}
                            <a href="tel:+79787971006" title="Позвонить">+7 (978) 797-10-06</a>
                        </div>
                    </div>
                    <div class="col-4 right flex">
                        <div class="develop">
                            <div class="develop__link">
                                <a href="/" target="_blank" rel="nofollow">
                                    Создание, продвижение и <br/>техподдержка сайтов
                                </a>
                            </div>
                            <div class="develop__logo">
                                <a href="https://krasber.ru" target="_blank" rel="nofollow">
                                    <img src="{{ asset('img/krasber.svg') }}" alt="Веб-студия Красбер">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="copyright">&copy; <span itemprop="copyrightYear">2019</span>. Море ламината. Все права защищены.</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="mobile__menu">
        @includeWhen($menu->get('menu_header'), 'layouts.menus.footer_mobile', ['menu' => $menu])
        <div class="close-menu-btn"></div>
        <div class="menu-overlay-mob"></div>
    </div>

    @include('layouts.forms.recall')
    <div class="popup__show-bg"></div><div class="notify"></div>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}" async></script>
</body>
</html>
