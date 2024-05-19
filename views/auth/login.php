<section class="home-sections home-sections-swiper container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Đăng Nhập Hệ Thống</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5 mt-4">
                    <form action="#" class="login-form" id="flogin" method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control rounded-left" placeholder="Địa chỉ email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control rounded-left" placeholder="Mật khẩu" required>
                        </div>
                        <!-- recaptcha token -->
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse" value="">
                        <div class="form-group align-items-center">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-block mt-20 login-btn btn-cs">Đăng Nhập</button>
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

                        <div class="mt-30 text-center">
                            <a href="#" class="launch-modal">Bạn đã quên mật khẩu?</a>
                        </div>
                        <div class="mt-20 text-center">
                            <span>Bạn chưa có tài khoản?</span>
                            <a href="/register" class="text-secondary font-weight-bold">Đăng ký ngay</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $("#flogin").validate({
            rules: {
                email: {
                    required: true
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: 'Vui lòng nhập địa chỉ email của bạn.',
                password: 'Vui lòng nhập mật khẩu của bạn.'
            },
            submitHandler: function(e) {
                event.preventDefault();
                $('.login-btn').html('<i class="fa-light fa-spinner-third fa-spin mr-5"></i> Loading...').prop('disabled', true);
                grecaptcha.ready(function() {
                    grecaptcha.execute('<?= $G_Captcha['site_key']; ?>', {
                        action: 'auth'
                    }).then(function(token) {
                        var recaptchaResponse = document.getElementById('recaptchaResponse');
                        recaptchaResponse.value = token;
                        $.ajax({
                            url: "<?= $domain; ?>handler/execute/auth.php?action=login",
                            type: 'post',
                            data: $('#flogin').serialize(),
                            dataType: 'json',
                            success: function(response) {
                                $('.login-btn').html("Đăng Nhập").prop('disabled', false);
                                Swal.fire(response.title, response.message, response.type).then(function() {
                                    if (response.reload) {
                                        if (response.type == 'success') {
                                            window.location.href = "/home";
                                        } else {
                                            window.location.href = "";
                                        }
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
            },
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="forgetpassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgetpasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgetpasswordLabel">Đặt lại mật khẩu</h5>
            </div>
            <div class="modal-body">
                <form id="fresetpassword" method="post">
                    <div class="form-group">
                        <div class="input-group mb-3 input-group-sm">
                            <input type="email" id="reset_email" class="form-control" placeholder="Nhập địa chỉ email tài khoản của bạn">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-sm send-code" type="button"><i data-feather="send" width="15" height="15" class="mr-5"></i></button>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="full_name" class="form-control" value="" placeholder="Thông tin email..." readonly>
                        </div>
                        <div class="input-group mb-3 confirm">
                            <input type="text" id="confirm-code" class="form-control" value="" placeholder="Nhập mã xác minh vừa nhận">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="ref();">Đóng</button>
                <button type="button" class="btn btn-primary btn-sm reset-password">Đặt lại mật khẩu</button>
            </div>
        </div>
    </div>
</div>

<script>
    function ref() {
        var xacnhan = confirm("Bạn có chắc chắn muốn đóng hộp thoại đặt lại mật khẩu không?");
        if (xacnhan) {
            location.href = "";
        } else {
            alert("Đã hủy thao tác!");
        }
    }
    $(document).ready(function() {
        /* Open Modal */
        $('.launch-modal').click(function() {
            $('#forgetpassword').modal({
                backdrop: 'static'
            });
        });
        /* User Info */
        $('.send-code').prop('disabled', true);
        $('.confirm').hide();
        $('.reset-password').hide();
        $('#reset_email').change(function() {
            $.ajax({
                url: "<?= $domain; ?>handler/execute/auth.php?action=user_info",
                method: "POST",
                dataType: "JSON",
                data: {
                    email: $("#reset_email").val()
                },
                success: function(response) {
                    if (response.type == 'success') {
                        alert('Đã tìm thấy thông tin email');
                        $('.send-code').prop('disabled', false);
                    } else {
                        $('.send-code').prop('disabled', true);
                    }
                    $('#full_name').val(response.message);
                },
                error: function() {
                    alert('Disconnect to server!');
                }
            });
        });
        /* Reset Password */
        $('.send-code').click(function() {
            if ($('#reset_email').val() == '') {
                alert('Hãy điền email!')
            } else {
                $('.send-code').html('<i class="fa-light fa-spinner-third fa-spin fa-lg"></i>').prop('disabled', true);
                $.ajax({
                    url: "<?= $domain; ?>handler/execute/sendCode.php?action=reset-password",
                    type: 'post',
                    data: {
                        email: $('#reset_email').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.type == 'success') {
                            $('.confirm').show();
                            $('.reset-password').show();
                            $('.send-code').html('Đã gửi').prop('disabled', true);
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
        /* Xác minh mã */
        $('.reset-password').click(function() {
            if ($('.confirm-code').val() == '') {
                alert('Vui lòng điền mã để đặt lại mật khẩu')
            } else {
                $('.reset-password').html('<i class="fa-light fa-spinner-third fa-spin fa-lg"></i>').prop('disabled', true);
                $.ajax({
                    url: "<?= $domain; ?>handler/execute/sendCode.php?action=confirm-code",
                    type: 'post',
                    data: {
                        email: $('#reset_email').val(),
                        code: $('#confirm-code').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.type == 'success') {
                            $('.reset-password').html('Đã gửi về email').prop('disabled', true);
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
                            $('.reset-password').html('Thử lại').prop('disabled', false);
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