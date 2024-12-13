@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\preloaderHelper')

@if ($layoutHelper->isLayoutTopnavEnabled())
    @php($def_container_class = 'container')
@else
    @php($def_container_class = 'container-fluid')
@endif

{{-- Default Content Wrapper --}}
<div class="{{ $layoutHelper->makeContentWrapperClasses() }}">

    {{-- Preloader Animation (cwrapper mode) --}}
    @if ($preloaderHelper->isPreloaderEnabled('cwrapper'))
        @include('adminlte::partials.common.preloader')
    @endif

    {{-- Content Header --}}
    @hasSection('content_header')
        <div class="content-header">
            <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                @yield('content_header')
                <div class="container-fluid">
                    <div class="row mb-2">
                        @error('messageError')
                            <div class="col-12 mt-3">
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            </div>
                        @enderror
                        @if(Session::has('messageSuccess'))
                            <div class="col-12 mt-3">
                                <div class="alert alert-success" role="alert">
                                    {{Session::get('messageSuccess')}}
                                </div>
                            </div>
                        @endif
                    </div><!-- /.row -->

                </div><!-- /.container-fluid -->
            </div>
 
        </div>
    @endif

    {{-- Main Content --}}
    <div class="content">
        <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
            @stack('content')
            @yield('content')
        </div>
    </div>

</div>
