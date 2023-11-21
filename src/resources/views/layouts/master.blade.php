@include('easycrud::views.layouts.header')
@include('easycrud::views.layouts.navbar')
@include('easycrud::views.layouts.sidebar')
<div class="content-wrapper">
    @yield('easycrud::content')
</div>
@include('easycrud::views.layouts.footer')