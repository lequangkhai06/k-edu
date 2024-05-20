<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
if (!isset($users)) {
    die('<script>location.href="/login"</script>');
}
?>

<section class="container mt-45">
    <div class="d-flex align-items-center mb-25 p-15 danger-transparent-alert">
        <div class="danger-transparent-alert__icon d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-bell fa-shake"></i>
        </div>

        <div class="ml-10">
            <div class="font-13 font-weight-bold">Nạp tiền vào tài khoản bằng <b class="text-secondary">thẻ cào điện thoại</b> không chiết khấu phần trăm (VD: nạp 100k nhận 100k).</div>
            <div class="font-13 font-weight-bold">Nạp qua <b class="text-secondary">ví điện tử MOMO</b> nhận thêm khuyến mãi 20% (áp dụng trong tuần lễ vàng).</div>
            <div class="font-13 font-weight-bold">Quá trình xử lý diễn ra tự động 100%</div>
            <div class="font-13 font-weight-bold">Quý khách hàng có bất kì thắc mắc, câu hỏi vui lòng liên hệ qua bộ phận chăm sóc khách hàng góc trái màn hình nhé <3 </div>
                    <div class="font-10 font-weight-bold">Mọi hành vi spam gây ảnh hưởng tới hệ thống sẽ bị khóa tài khoản vĩnh viễn.</div>
            </div>
        </div>
        <h2 class="text-center">NẠP TIỀN VÀO TÀI KHOẢN</h2>

        <div class="rounded-sm shadow mt-20 py-20 px-10 px-md-30 " style="border: solid 1px #43d477">
            <div class="row mb-30">
                <!-- THE CAO -->
                <form class="col-12 col-lg-6" method="post" id="card_payment_form">
                    <div class="form-group text-center mt-30">
                        <p>
                            <font class="">
                                <img src="https://i.imgur.com/1DcFqZv.png" class="mr-5" width="32" height="32"> NẠP BẰNG THẺ CÀO
                            </font>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn loại thẻ cào <sup>(<strong class="text-danger">*</strong>)</sup></label>
                        <select name="card_telco" id="card_telco" class="form-control" required>
                            <option value="">-- Chọn --</option>
                            <option value="VIETTEL">Viettel</option>
                            <option value="MOBIFONE">Mobifone</option>
                            <option value="VINAPHONE">Vinaphone</option>
                            <option value="VNMOBI">Vietnamobile</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Chọn mệnh giá thẻ <sup>(<strong class="text-danger">*</strong>)</sup></label>
                        <select name="card_amount" id="card_amount" class="form-control" required>
                            <option value="">-- Chọn --</option>
                            <option value="10000">10,000 đ</option>
                            <option value="20000">20,000 đ</option>
                            <option value="30000">30,000 đ</option>
                            <option value="50000">50,000 đ</option>
                            <option value="100000">100,000 đ</option>
                            <option value="200000">200,000 đ</option>
                            <option value="300000">300,000 đ</option>
                            <option value="500000">500,000 đ</option>
                            <option value="1000000">1,000,000 đ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Mã thẻ <sup>(<strong class="text-danger">*</strong>)</sup></label>
                        <input type="number" class="form-control" id="card_pin" name="card_pin" placeholder="Nhập mã thẻ cào" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="">Serial thẻ <sup>(<strong class="text-danger">*</strong>)</sup></label>
                        <input type="number" class="form-control" id="card_serial" name="card_serial" placeholder="Nhập mã serial" autocomplete="off" required>
                    </div>
                    <div class="danger-transparent-alert">
                        <div class="ml-10">
                            <small>Chọn sai mệnh giá thẻ phạt: mất 50% giá trị thẻ thật!</small><br>
                            <small>Ví dụ: thẻ cào có mệnh giá thật là 20k nhưng bạn chọn mệnh giá là 50k, trong trường hợp thẻ đúng bạn chỉ nhận được 50% giá trị là 10k thôi bạn nhé!</small><br>
                            <small>Xử lý thẻ cào từ 1-5 phút.</small>
                        </div>
                    </div>
                    <!-- recaptcha token -->
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse" value="">
                    <button type="submit" class="btn btn-sm btn-primary mt-25 btn-block card-submit"><i data-feather="chevron-right" width="18" height="18" class="mr-5"></i> NẠP THẺ NGAY</button>
                </form>
                <script>
                    $('#card_payment_form').submit(function(event) {
                        event.preventDefault();
                        $('.card-submit').html('<i class="fa-light fa-spinner-third fa-spin mr-5"></i> LOADING ...').prop('disabled', true);
                        grecaptcha.ready(function() {
                            grecaptcha.execute('<?= $G_Captcha['site_key']; ?>', {
                                action: 'post_card'
                            }).then(function(token) {
                                var recaptchaResponse = document.getElementById('recaptchaResponse');
                                recaptchaResponse.value = token;
                                $.ajax({
                                    url: "<?= $domain; ?>handler/execute/card.php?token=<?= bin2hex(random_bytes(32)); ?>",
                                    type: 'post',
                                    data: $('#card_payment_form').serialize(),
                                    dataType: 'json',
                                    success: function(response) {
                                        $('.card-submit').html('NẠP THẺ NGAY').prop('disabled', false);
                                        Swal.fire(response.title, response.message, response.type).then(function() {
                                            if (response.reload) {
                                                if (response.type == 'success') {
                                                    window.location.href = "";
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
                    });
                </script>
                <!-- MOMO -->
                <form class="col-12 col-lg-6">
                    <div class="form-group text-center mt-30">
                        <p>
                            <font class="">
                                <img src="https://i.imgur.com/Z0Fpe4n.png" class="mr-5" width="32" height="32"> NẠP BẰNG VÍ MOMO <button type="button" class="btn btn-sm btn-haha" data-toggle="modal" data-target="#QRCODE_MODAL"><span class="animate-text">QR CODE</span></button>
                            </font>
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên chủ tài khoản</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?= $MOMO_Name; ?>" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text text-white"><i class="fa fa-clone copyrow" aria-hidden="true" data-clipboard-text="<?= $MOMO_Name; ?>" data-toggle="tooltip" title="" data-original-title="Sao chép"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?= $MOMO_Phone; ?>" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text text-white"><i class="fa fa-clone copyrow" aria-hidden="true" data-clipboard-text="<?= $MOMO_Phone; ?>" data-toggle="tooltip" title="" data-original-title="Sao chép"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung chuyển khoản</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?= $MOMO_Trans_Code; ?>" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text text-white"><i class="fa fa-clone copyrow" aria-hidden="true" data-clipboard-text="<?= $MOMO_Trans_Code; ?>" data-toggle="tooltip" title="" data-original-title="Sao chép"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Mã giao dịch (kiểm tra bằng ứng dụng MOMO sau khi chuyển khoản)</label>
                        <input type="text" placeholder="Nhập mã giao dịch tại đây" class="form-control" required>
                    </div>
                    <div class="danger-transparent-alert">
                        <div class="ml-10">
                            <small>Quý khách hàng vui lòng chuyển khoản đúng số điện thoại, nội dung được cung cấp bên trên!</small><br>
                            <small>Sau khi chuyển xong, MOMO sẽ cung cấp mã giao dịch, vui lòng điền vào thông tin trên và hoàn tất quá trình nạp tiền.</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-25 btn-block"><i data-feather="chevron-right" width="18" height="18" class="mr-5"></i> KIỂM TRA MÃ GIAO DỊCH</button>
                </form>
            </div>
        </div>

        <h2 class="mt-50 text-center">- LỊCH SỬ GIAO DỊCH -</h2>
        <span class="badge bg-secondary text-white"><i class="fa-duotone fa-rotate fa-spin mr-5"></i>Cập nhật dữ liệu tự động.</span>
        <div class="rounded-sm shadow mt-20 py-20 px-10 table_data" style="border: solid 1px #43d477">
            <!-- REALTIME DATA -->
        </div>
        <br>
        <small class="font-weight-bold">Dữ liệu được cập nhật theo thời gian thực, giúp khách hàng dễ dàng theo dõi giao dịch.</small><br>
        <small class="font-weight-bold">Khi có bất kì thắc mắc hoặc câu hỏi nào, vui lòng sao chép mã giao dịch và nhắn tin trực tiếp để nhân viên dễ dàng hỗ trợ.</small><br>
</section>

<script>
    Pusher.logToConsole = false;

    var pusher = new Pusher('84ac4d7309d8e57416d6', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('user');
    channel.bind('history_recharge', function(data) {
        // có dữ liệu mới
        getData();
        Toastify({
            text: data.message,
            duration: 3000,
            newWindow: true,
            close: false,
            gravity: "bottom",
            position: "center",
            stopOnFocus: true,
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function() {}
        }).showToast();
    });

    getData();

    function getData() {
        $.get('<?= $domain; ?>model/user/history_recharge.php', function(result) {
            $('.table_data').html(result);
        });
    }
</script>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="QRCODE_MODAL" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="text-center">QR Code Nạp Tiền Bằng MOMO</h2>
                <div class="col-12 text-center" id="MOMO_QR">
                    <img src="https://vietqr.co/api/generate/momo/<?= $MOMO_Phone; ?>/VIETQR.CO/100.000/<?= $MOMO_Trans_Code; ?>?style=2&logo=1&isMask=1&bg=65" class="img-thumbnail img-fluid" width="85%" style="margin-bottom: 20px;margin-top:20px" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');
?>