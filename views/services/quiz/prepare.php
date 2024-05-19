<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
if (!$users) {
    die('<script>location.href="/login"</script>');
}
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$quiz = $conn->query("SELECT * FROM quizzes WHERE id = '{$id}'")->fetch_array();
if (!$quiz) {
    die('<script>location.href="/home"</script>');
}
$session_namespace = strtolower(SlugURL($quiz["title"]) . $id);
?>
<div class="container mb-4">
    <section class="mt-40">
        <h1 class="font-weight-bold text-dark-blue text-center">CHUẨN BỊ THAM GIA BÀI KIỂM TRA.</h1>
        <hr>
        <p class="text-gray font-14 mt-5 text-center">
        <h2 class="text-black text-center"><?= $quiz["title"]; ?></h2>
        </p>
        <div class="mt-2"></div>
        <div class="d-flex align-items-center justify-content-center w-100 h-100">
            <div class="learning-content-box d-flex align-items-center justify-content-center flex-column p-15 p-lg-30 rounded-lg">
                <div class="learning-content-box-icon">
                    <img src="/assets/default/img/learning/quiz.svg" alt="downloadable icon">
                </div>
                <h4 class="font-16 font-weight-bold text-dark ">Bài kiểm tra trắc nghiệm</h4>
                <span class="font-14 font-weight-500 text-dark mt-5">Đi tới trang bài kiểm tra để biết thêm thông tin.</span>
                <span class="font-14 font-weight-500 text-danger mt-5">Bài kiểm tra có thể cần mật khẩu để tham gia.</span>
                <div class="d-flex flex-wrap">
                    <a href="/home" target="_blank" class="btn btn-primary btn-sm mt-15 m-1"><i data-feather="home" width="18" height="18" class="mr-5"></i> Về trang chủ
                    </a>
                    <a data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm mt-15 m-1 text-light"><i data-feather="chevron-right" width="18" height="18" class="mr-5"></i>
                        Bắt Đầu</a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="section-title after-line font-20 text-dark-blue mb-25">XÁC NHẬN THAM GIA BÀI KIỂM TRA</h3>
                <?php if ($quiz["password"] != null && !isset($_SESSION[$session_namespace]['password'])) { ?>
                    <!-- confirm-password -->
                    <form class="form-group" method="post" action="#" id="submit-password-form">
                        <input type="hidden" name="quiz_id" value="<?= $quiz["id"]; ?>">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Nhập mật khẩu..." autocomplete="off" required>
                        <div class="mt-2"></div>
                        <small id="passwordHelp" class="form-text text-muted">Với mỗi lần tham gia, bạn chỉ cần nhập mật khẩu 1 lần duy nhất.</small>
                        <div class="mt-3"></div>
                        <button class="form-control btn btn-sm btn-primary btn-block submit-btn">Kiểm tra mật khẩu</button>
                    </form>
                    <!-- -- -->
                <?php } ?>
                <div class="alert alert-secondary text-light" role="alert" style="padding: 1rem 1rem !important;" id="alert-msg">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-sm btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn-sm btn btn-primary" id="contiune-btn">Tiếp tục</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var continue_btn = $("#contiune-btn");
        var alert_msg = $("#alert-msg");
        if ($("#submit-password-form").length > 0) {
            alert_msg.html("Vui lòng nhập mật khẩu để tiếp tục!");
            continue_btn.prop('disabled', true);
            $("#submit-password-form").submit(function(e) {
                e.preventDefault();
                $('.submit-btn').html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Loading...').prop("disabled", true);
                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "<?= $domain; ?>handler/execute/quiz.php?action=verify_password",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        $('.submit-btn').html('Kiểm tra mật khẩu').prop("disabled", false);
                        if (response.status == "success") {
                            alert_msg.html("Bạn có chắc chắn muốn tham gia bài kiểm tra này hay không?");
                            $("#submit-password-form").addClass('hide-element');
                            continue_btn.prop("disabled", false);
                            continue_btn.click(function() {
                                window.location.href = response.url;
                            });
                        } else {
                            Toastify({
                                text: response.message,
                                duration: 2000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "center",
                                stopOnFocus: true,
                                style: {
                                    background: "linear-gradient(160deg, #0093E9 0%, #80D0C7 100%)",
                                },
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        } else {
            alert_msg.html("Bạn có chắc chắn muốn tham gia bài kiểm tra này hay không?");
            continue_btn.click(function() {
                window.location.href = "/quizzes/<?= $id; ?>/start";
            });
        }
    });
</script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');
?>