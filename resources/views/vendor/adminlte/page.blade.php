@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation (fullscreen mode) --}}
        @if($preloaderHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        <aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

            {{-- Sidebar brand logo --}}
            @if(config('adminlte.logo_img_xl'))
                @include('adminlte::partials.common.brand-logo-xl')
            @else
                @include('adminlte::partials.common.brand-logo-xs')
            @endif
        
            {{-- Sidebar menu --}}
            <div class="sidebar">
                <nav class="pt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                        data-widget="treeview" role="menu"
                        @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                            data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                        @endif
                        @if(!config('adminlte.sidebar_nav_accordion'))
                            data-accordion="false"
                        @endif>
                        
                        {{-- @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item') --}}

                        {{-- PENGGUNA --}}
                        <li class="nav-header">
                            Data Pengguna
                        </li>
                        
                        <li id="" class="nav-item">
                            <a class="nav-link {{Route::is('user.all')? 'active' : ''}}" href="{{route('user.all')}}" >
                               <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Seluruh pengguna 
                                </p>
                            </a>
                        </li>

                        {{-- MODEL BAJU --}}
                        <li class="nav-header">
                            Model Baju
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Route::is('clothing.all')? 'active' : ''}}" href="{{ route('clothing.all') }} ">
                                <i class="nav-icon far fa-fw fa-circle"></i>
                                <p>
                                    Daftar Baju
                                </p>
                            </a>
                        </li>

                        {{-- INFO TENTANG --}}
                        <li class="nav-header">
                            Informasi VFR
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    Tentang VFR
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        
        </aside>
        

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
