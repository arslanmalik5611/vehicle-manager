<script src="{{asset('panel_assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('panel_assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('panel_assets/js/main.js')}}"></script>
<script src="{{asset('panel_assets/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('panel_assets/datatables/datatables.min.js')}}"></script>
<script src="{{asset('panel_assets/lobibox/dist/js/lobibox.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('panel_assets/tinymce/tinymce.min.js')}}"></script>
{{--Datetime picker--}}
{{--https://xdsoft.net/jqplugins/datetimepicker/--}}
<link rel="stylesheet" href="{{asset('panel_assets/datetimepicker/build/jquery.datetimepicker.min.css')}}">
<script src="{{asset('panel_assets/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>
{{--WAIT ME PLUGIN--}}
<link rel="stylesheet" href="{{asset('panel_assets/waitme/waitMe.min.css')}}">
<script src="{{asset('panel_assets/waitme/waitMe.min.js')}}"></script>

<script type="text/javascript" src="{{asset('panel_assets/js/portal_setup.js')}}"></script>
<script type="text/javascript" src="{{asset('panel_assets/js/footer.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        ajax_setup();
        select2_load();
        tinymce_initialize();
        datetimepicker_load();
        var active_mmenu = '{{$view_name}}';
        active_mmenu = active_mmenu.replace('.', `\\.`);
        $(`.${active_mmenu}`).addClass('active-submenu active');
        $('.active-submenu').parents('.list-unstyled').addClass('show');
    });
</script>

@yield('page_level_scripts')
</body>
</html>
