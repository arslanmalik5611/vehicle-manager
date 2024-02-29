<section class="main py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-5 left-col mb-5 mb-md-0">
                <div class="left-col-content">
                    <h3 class="mb-5 text-capitalize">Sign Up</h3>

                    <form action="#" class="sign-in-form" id="register_form">
                        <div class="mb-4">
                            <label for="full_name" class="form-label mb-3 default-label">Full Name</label>
                            <input type="text" class="form-control rounded-pill default-input" name="full_name"
                                   id="full_name"
                                   placeholder="Username or name@domain.com">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label mb-3 default-label">Email Address</label>
                            <input type="email" class="form-control rounded-pill default-input" name="email" id="email"
                                   placeholder="Your@email.com">
                        </div>

                        <div class="mb-4">
                            <label for="country_id" class="form-label mb-3 default-label">Country</label>
                            <select class="form-select rounded-pill default-select" name="country_id" id="country_id">
                                <?php
                                foreach ($countries as $country):
                                    ?>
                                    <option value='<?php echo $country['id']; ?>'><?php echo $country['name']; ?></option>";
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label mb-3 default-label">Password</label>
                            <input type="password" class="form-control rounded-pill default-input" name="password"
                                   id="password"
                                   placeholder="Password">
                        </div>

                        <div class="mb-4">
                            <label for="confirm-password" class="form-label mb-3 default-label">Confirm Password</label>
                            <input type="password" class="form-control rounded-pill default-input" name="cpassword"
                                   id="confirm-password"
                                   placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="rid" value="<?php echo $rid;?>">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                               value="<?= $this->security->get_csrf_hash(); ?>">
                        <button type="submit" class="btn default-btn mb-4 w-100 register-btn">Sign Up <i
                                    class="fas fa-chevron-right ms-3 go-icon"></i> <i
                                    class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i></button>
                    </form>
                    <!--<div class="sign-in-text forget-text text-center me-auto">
                        <h6 class="mb-4"><span>OR</span></h6>
                    </div>

                    <div class="social-sign-up mx-auto text-center">
                        <button type="button" class="btn default-btn default-btn-2 mb-4 w-100">
                            <i class="fab fa-google me-3"></i> Sign Up With Google
                        </button>

                        <button type="button" class="btn default-btn default-btn-2 w-100 mb-4">
                            <i class="fab fa-facebook-f me-3"></i>Sign Up With Facebook
                        </button>

                        <a class="mb-4 d-block">Already have an account? Sign in now.</a>
                    </div>-->
                </div>
            </div>

            <div class="col-md-6 ms-auto image-col ps-4 ps-lg-0">
                <img src="<?php echo base_url('assets/images/home/'); ?>image-1.webp" alt=""
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
        $("#register_form").on('submit', function (e) {
            $('.register-btn').attr('disabled', true);
            $('.go-icon').hide();
            $('.spinner-icon').show();
            e.preventDefault();
            $.ajax({
                url: base_url + "register/createaccount",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (data) {
                    if (data.status) {
                        $('.go-icon').show();
                        $('.spinner-icon').hide();
                        Lobibox.notify('success', {
                            size: 'mini',
                            delay: false,
                            delayIndicator: false,
                            msg: data.message
                        });

                    } else {
                        $('.register-btn').attr('disabled', false);
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