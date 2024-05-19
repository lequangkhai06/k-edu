<section class="home-sections home-sections-swiper container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Đăng Ký Tài Khoản</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5 mt-4">
                    <form action="#" class="login-form" id="fregister" method="post">
                        <div class="form-group">
                            <label class="input-label" for="email">Nhập địa chỉ email: <sup>(<strong class="text-danger">*</strong>)</sup></label>
                            <div class="input-group">
                                <input name="email" type="email" class="form-control mr-1" value="" id="email" placeholder="Nhập địa chỉ email của bạn" required autocomplete="off">
                                <button class="btn btn-primary btn-sm send-code btn-cs"><i data-feather="send" width="15" height="15" class="mr-10"></i> Gửi mã</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-label" for="email">Nhập mã xác minh: <sup>(<strong class="text-danger">*</strong>)</sup></label>
                            <input name="verification_code" id="verification_code" type="text" class="form-control " value="" placeholder="Nhập mã vừa nhận trong hòm thư" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="input-label" for="mobile">Số điện thoại: <sup>(<strong class="text-danger">*</strong>)</sup></label>
                            <input name="phone" class="form-control" value="" placeholder="Nhập số điện thoại của bạn" required type="number" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="input-label" for="name">Họ và tên: <sup>(<strong class="text-danger">*</strong>)</sup></label>
                            <input name="name" type="text" value="" class="form-control" placeholder="Nhập họ và tên của bạn" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <span class="text-danger">
                                Để bảo đảm an toàn: mật khẩu phải gồm từ 8 kí tự, có kí tự đặc biệt, kí tự thường, số và in hoa.
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="password">Mật khẩu: <sup>(<strong class="text-danger">*</strong>)</sup></label>
                            <input name="password" type="password" class="form-control " id="password" placeholder="Nhập mật khẩu của bạn" required>
                        </div>

                        <div class="form-group ">
                            <label class="input-label" for="confirm_password">Nhập lại mật khẩu: <sup>(<strong class="text-danger">*</strong>)</sup></label>
                            <input name="repassword" type="password" class="form-control " id="confirm_password" placeholder="Nhập lại mật khẩu của bạn" required>
                        </div>
                        <!-- recaptcha token -->
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse" value="">
                        <div class="form-group align-items-center">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-block mt-20 register-btn btn-cs">Đăng Ký</button>
                            </div>
                        </div>
                        <div class="text-center mt-20">
                            <span class="text-secondary d-inline-flex align-items-center justify-content-center font-weight-bold">Hoặc với</span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="/login/social_account?type=google" target="_blank" class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center">
                                    <img src="https://i.imgur.com/CfqexPf.png" class="mr-1" alt=" google svg" />
                                    <span class="flex-grow-1 text-black font-weight-bold">Google</span>
                                </a>
                            </div>
                            <!-- <div class="col">
                                <a href="/login/social_account?type=facebook" target="_blank" class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center ">
                                    <img src="https://i.imgur.com/IpgCXXP.png" class="mr-1" alt="facebook svg" />
                                    <span class="flex-grow-1 text-black font-weight-bold">FB</span>
                                </a>
                            </div> -->
                            <div class="col">
                                <a href="/login/social_account?type=zalo" target="_blank" class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center ">
                                    <img src="https://i.imgur.com/SkkEo9V.png" class="mr-1" alt="zalo svg" />
                                    <span class="flex-grow-1 text-black font-weight-bold">Zalo</span>
                                </a>
                            </div>
                        </div>
                        <div class="mt-20 text-center">
                            <span>Bạn đã có tài khoản?</span>
                            <a href="/login" class="text-secondary font-weight-bold">Đăng nhập ngay</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $("#fregister").validate({
            rules: {
                email: {
                    required: false
                },
                verification_code: {
                    required: true
                },
                phone: {
                    required: true
                },
                name: {
                    required: true
                },
                password: {
                    required: true
                },
                repassword: {
                    required: true
                },
            },
            submitHandler: function(e) {
                event.preventDefault();
                $('.register-btn').html('<i class="fa-light fa-spinner-third fa-spin mr-5"></i> Loading...').prop('disabled', true);
                grecaptcha.ready(function() {
                    grecaptcha.execute('<?= $G_Captcha['site_key']; ?>', {
                        action: 'auth'
                    }).then(function(token) {
                        var recaptchaResponse = document.getElementById('recaptchaResponse');
                        recaptchaResponse.value = token;
                        $.ajax({
                            url: "<?= $domain; ?>handler/execute/auth.php?action=register",
                            type: 'post',
                            data: $('#fregister').serialize(),
                            dataType: 'json',
                            success: function(response) {
                                $('.register-btn').html("Đăng Ký").prop('disabled', false);
                                Swal.fire(response.title, response.message, response.type).then(function() {
                                    if (response.reload) {
                                        window.location.href = "/home";
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                alert('Lỗi kết nối mạng!')
                                // Xử lý lỗi
                                console.log(xhr);
                                console.log(status);
                                console.log(error);
                            }
                        });
                    });
                });
            }
        });

        $('.send-code').click(function() {
            if ($('#email').val() == '') {
                alert('Vui lòng điền địa chỉ email!');
                $('#email').focus();
            } else {
                $('.send-code').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop('disabled', true);
                $.ajax({
                    url: "<?= $domain; ?>handler/execute/sendCode.php?action=email",
                    type: 'post',
                    data: {
                        email: $('#email').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response);
                        if (response.type == 'success') {
                            $('.send-code').html('Đã gửi').prop('disabled', true);
                            $('#email').prop('readOnly', true);
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "center", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();
                        } else {
                            $('.send-code').html('Gửi lại mã').prop('disabled', false);
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "center", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "linear-gradient(to right, #FF5733, #900C3F)",
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Lỗi kết nối mạng!')
                        // Xử lý lỗi
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
            }
        });
    });
</script>

<style>
    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group .form-control {
        flex: 1;
        margin-right: 5px;
    }
</style>