@include('layout.home_header')
<section class="main py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-5 left-col mb-5 mb-md-0">
                <div class="left-col-content">
                    <h3 class="mb-5 text-capitalize">Sign In</h3>

                    <form action="#" class="sign-in-form" id="login_form">
                        <div class="mb-4">
                            <label for="email" class="form-label mb-3 default-label">Email address</label>
                            <input type="email" class="form-control rounded-pill default-input" name="email" id="email"
                                   placeholder="name@domain.com">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label mb-3 default-label">Password</label>
                            <input type="password" class="form-control rounded-pill default-input" name="password"
                                   id="password"
                                   placeholder="password">
                        </div>
                        <input type="hidden" value="admin" name="client">
                        <button type="submit" class="btn default-btn mb-4 w-100 login-btn">Login <i
                                class="fas fa-chevron-right ms-3 go-icon"></i> <i
                                class="fas fa-circle-notch fa-spin spinner-icon" style="display: none"></i>
                        </button>
                    </form>
                    <div class="sign-in-text forget-text text-center me-auto">
                        <a class="mb-4 d-block" href="{{env('BASE_URL').'forgot'}}">Forget Your Password?</a>
                        <h6 class="mb-4"><span>OR</span></h6>
                    </div>

                    <div class="social-sign-up mx-auto">
                        <a href="{{env('BASE_URL').'register'}}" type="button" class="btn default-btn default-btn-2 mb-4 w-100">
                            <i class="fas fa-check-circle me-3"></i> Register
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ms-auto image-col ps-4 ps-lg-0">
                <img src="{{asset('panel_assets/images/home/image-1.webp')}}" alt=""
                     class="w-100 mb-5 mt-4 mt-md-5 wow animate__animated animate__zoomIn">

                <div class=" text-center mx-auto">
                    <h3 class="mb-3">You're at right place!</h3>
                    <p class="px-2">We help your primary care doctors make a diagnosis about your health or any medical
                        problems you may have.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        var token = localStorage.getItem("user_token");
        if (token) {
            window.location = base_url;
        }

        $("#login_form").on('submit', function (e) {
            $('.login-btn').attr('disabled', true);
            $('.go-icon').hide();
            $('.spinner-icon').show();
            e.preventDefault();
            $.ajax({
                url: api_url + "auth/login-backend",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function (data) {
                    if (data.status == true) {
                        localStorage.setItem("user_token", data.token.token);
                        window.location = base_url;

                        $('.go-icon').show();
                        $('.spinner-icon').hide();
                        Lobibox.notify('success', {
                            size: 'mini',
                            sound: false,
                            delay: 2000,
                            msg: 'Login successful. Redirecting...'
                        });
                        setTimeout(function () {
                            window.location = base_url;
                        }, 500);

                    } else {
                        $('.login-btn').attr('disabled', false);
                        $('.go-icon').show();
                        $('.spinner-icon').hide();
                        Lobibox.notify('error', {
                            size: 'mini',
                            sound: false,
                            msg: data.message
                        });

                    }
                }
            });
        });
    });
</script>
