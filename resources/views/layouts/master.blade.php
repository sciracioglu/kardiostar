@include('layouts.header')
@include('layouts.menu')
<div class="container-fluid">
    <div class='d-flex p-2 bd-highlight'>
        <h5>
            @yield('baslik') 
            | <small class="text-muted">@yield('kucuk_baslik')</small>
        </h5>
    </div>
    <div class="d-flex flex-column justify-content-between" id='app'>
    @yield('icerik')
    </div>
</div>
@include('layouts.footer')