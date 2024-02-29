@include('layout.portal.header')
@include('layout.portal.aside')
<!--Container Main start-->
<div id="main-pd" class="height-100">
    @yield('content')
</div>
<!--Container Main end-->
@include('layout.portal.footer')
