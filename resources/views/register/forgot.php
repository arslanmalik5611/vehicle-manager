<section class="main py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-5 left-col mb-5 mb-md-0">
                <div class="left-col-content">
                    <h3 class="mb-5 text-capitalize">Forgot Password</h3>

                    <form action="#" class="sign-in-form" id="forgot_form">
                        <div class="mb-4">
                            <label for="email" class="form-label mb-3 default-label">Email address</label>
                            <input type="email" class="form-control rounded-pill default-input" name="email" id="email"
                                   placeholder="name@domain.com">
                        </div>

                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                               value="<?= $this->security->get_csrf_hash(); ?>">
                        <button type="submit" class="btn default-btn mb-4 w-100 forgot-btn">Send Link to Email <i
                                class="fas fa-chevron-right ms-3 go-icon"></i> <i
                                class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i>
                        </button>
                    </form>
                    <div class="sign-in-text forget-text text-center me-auto">
                        <a class="mb-4 d-block" href="<?php echo base_url('login'); ?>">Want to login?</a>
                        <!--<h6 class="mb-4"><span>OR</span></h6>-->
                    </div>

                    <!--<div class="social-sign-up mx-auto">
                        <button type="button" class="btn default-btn default-btn-2 mb-4 w-100">
                            <i class="fab fa-google me-3"></i>  Sign Up With Google
                        </button>

                        <button type="button" class="btn default-btn  default-btn-2 w-100">
                            <i class="fab fa-facebook-f me-3"></i>Sign Up With Facebook
                        </button>
                    </div>-->
                </div>
            </div>

            <div class="col-md-6 ms-auto image-col ps-4 ps-lg-0">
                <img src="<?php echo base_url('assets/images/home/') ?>image-1.webp" alt=""
                     class="w-100 mb-5 mt-4 mt-md-5 wow animate__animated animate__zoomIn">

                <div class="about-company text-center mx-auto">
                    <h3 class="mb-3">You're in good company!</h3>
                    <p class="px-2">Over 500,000 companies use Remind Me Later across 184+ countries</p>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        $("#forgot_form").on('submit', function (e) {
            $('.forgot-btn').attr('disabled', true);
            $('.go-icon').hide();
            $('.spinner-icon').show();
            e.preventDefault();
            $.ajax({
                url: base_url + "register/forgot_password",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        $('.go-icon').show();
                        $('.spinner-icon').hide();
                        Lobibox.notify('success', {
                            size: 'mini',
                            sound: false,
                            delay: 2000,
                            msg: data.message
                        });

                    } else {
                        $('.forgot-btn').attr('disabled', false);
                        $('.go-icon').show();
                        $('.spinner-icon').hide();
                        Lobibox.notify('error', {
                            size: 'mini',
                            sound: false,
                            msg: data.error
                        });
                    }
                }
            });
        });
    });
</script>