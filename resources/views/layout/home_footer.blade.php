<!--### Footer Start ###-->
<footer class="footer-wrapper pt-9 pb-9">
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <div class="footer-col">
                    <h5><b>Vehicle Manager</b></h5>
                    <!-- <img class="mb-4 logo" src="{{asset('panel_assets/images/logo.png')}}"/> -->
                    <p class="mb-4">
                        We provide the highest level of independent expertise in most disciplines of pathology including
                        haematology, biochemistry, microbiology, and virology.
                    </p>

                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Your Email Address" aria-label="Your Email Address" name="newsletter_email" id="newsletter_email" aria-describedby="email-addon">
                            <span class="input-group-text email-addon-btn" id="email-addon"><i class="fas fa-paper-plane"></i></span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <div class="footer-col footer-col-2">
                    <h3 class="mb-4 pb-3">Important Links</h3>

                    <ul class="footer-link-list list-unstyled">
                        <li><a href="#">Health Check</a></li>
                        <li><a href="#">Pathology Blood Testing</a></li>
                        <li><a href="#">COVID-19 Testing</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <div class="footer-col footer-col-3">
                    <h3 class="mb-4 pb-3">Services</h3>

                    <ul class="footer-link-list list-unstyled">
                        <li><a href="#">Test Profiles</a></li>
                        <li><a href="#">Our Process</a></li>
                        <li><a href="#">Free Consultations</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <div class="footer-col footer-col-4">
                    <h3 class="mb-4 pb-3">More</h3>

                    <ul class="footer-link-list list-unstyled">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Terms and conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<section class="copyright py-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p>© <?php echo date('Y'); ?> {{env('LAB_NAME')}} All rights reserved.</p>
            </div>
        </div>
    </div>
</section>
<!--### Footer End ###-->
<script src="{{asset('panel_assets/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('panel_assets/js/wow.min.js')}}"></script>
<script src="{{asset('panel_assets/js/main.js')}}"></script>
<script src="{{asset('panel_assets/lobibox/dist/js/lobibox.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--Datetime picker--}}
{{--https://xdsoft.net/jqplugins/datetimepicker/--}}
<link rel="stylesheet" href="{{asset('panel_assets/datetimepicker/build/jquery.datetimepicker.min.css')}}">
<script src="{{asset('panel_assets/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>
{{--WAIT ME PLUGIN--}}
<link rel="stylesheet" href="{{asset('panel_assets/waitme/waitMe.min.css')}}">
<script src="{{asset('panel_assets/waitme/waitMe.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        datetimepicker_load();
    });

    function block_page(selector = '.main') {
        $(selector).waitMe({
            effect: 'bounce',
            text: 'Processing',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            maxSize: '',
            waitTime: -1,
            textPos: 'vertical',
            fontSize: '',
            source: '',
        });
    }

    function unblock_page(selector = '.main') {
        $(selector).waitMe('hide');
    }

    function datetimepicker_load() {
        $('.datepicker').datetimepicker({
            format: 'd/m/Y',
            timepicker: false,
            timepickerScrollbar: false,
            scrollInput: false,
        });

        $('.datetimepicker').datetimepicker({
            format: 'd/m/Y H:i',
            timepickerScrollbar: false,
            scrollInput: false,
        });
    }

    $(document).ajaxStart(function() {
        block_page();
    });

    $(document).ajaxComplete(function() {
        unblock_page();
    });
</script>
</body>

</html>