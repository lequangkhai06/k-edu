<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
$id = $_GET['id'];
$quiz = $conn->query("SELECT * FROM quizzes WHERE id = '{$id}'", 1)->fetch_array();
if (!$quiz) {
    die('<script>location.href="/home"</script>');
}
$get = $conn->query("SELECT * FROM webinars WHERE id = '{$quiz["webinar_id"]}'");
$count = $get->num_rows;
$course_data = $get->fetch_array();
$quiz_question = $conn->query("SELECT * FROM quizzes_questions WHERE quiz_id = '{$id}'");
$total_quiz_question = $quiz_question->num_rows;
if ($total_quiz_question == 0) {
    echo '<script>
    Toastify({
        text: "Chưa có câu hỏi nào được cập nhật, vui lòng quay trở lại sau!",
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "bottom",
        position: "center",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, rgb(246, 60, 60), rgb(205,92,92))",
        },
    }).showToast();
    setTimeout(() => {
        window.location.href="/home";
    }, 3000);
    </script>';
    return;
}
// Lấy thông tin creator 
if ($base->getUserInfo($quiz["creator_id"])) {
    $creator = $base->getUserInfo($quiz["creator_id"]);
} else {
    $creator = [
        "name" => "Không xác định",
        "id" => 0,
    ];
}
?>
<div class="container mb-4">
    <section class="mt-40">
        <h1 class="font-weight-bold text-dark-blue"><?= $quiz["title"]; ?></h1>
        <p class="text-gray font-14 mt-5">
            <a href="https://lms.rocket-soft.org/course/Learn-Linux-in-5-Days" target="_blank" class="text-black">Khoá học: <?= $course_data["title"]; ?></a>
            | Bởi
            <span class="font-weight-bold">
                <a href="/users/profile/<?= $creator["id"]; ?>" target="_blank" class="font-14 "> <?= $creator["name"]; ?></a>
            </span>
        </p>

        <div class="mt-2">
            <button class="btn btn-primary js-settings-quizz" data-toggle="modal" data-target="#exampleModal">
                <i data-feather="settings" class="mr-1"></i> <b>Cấu hình</b>
            </button>
        </div>

        <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/58.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5">70/<?= $quiz["total_mark"]; ?></strong>
                        <span class="font-16 text-gray">Điểm số</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/88.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5">2/<?= $quiz["attempt"]; ?></strong>
                        <span class="font-16 text-gray">Làm bài lại</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/47.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5"><?= $total_quiz_question; ?></strong>
                        <span class="font-16 text-gray">Câu hỏi</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/clock.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5">
                            <div class="d-flex align-items-center timer ltr" id="clock">----</div>
                        </strong>
                        <span class="font-16 text-gray">Thời gian còn lại</span>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <section class="mt-30 quiz-form">
        <form action="#" method="post" class="" id="quiz_form">
            <input type="hidden" name="webinar_id" value="<?= $quiz["webinar_id"]; ?>" class="form-control" placeholder="" />
            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <?php
                while ($question = $quiz_question->fetch_array()) {
                    $quizzes_questions_answers = $conn->query("select * from quizzes_questions_answers where question_id = '{$question["id"]}'");
                ?>
                    <!-- qs -->
                    <div class="question">
                        <h3><?= $question["title"]; ?></h3>
                        <div class="mt-2"></div>
                        <div class="list-group">

                            <?php $i = 1;
                            while ($answers = $quizzes_questions_answers->fetch_array()) {
                                $i += rand(100, 999);
                            ?>
                                <div class="list-group-item list-group-item-action" aria-current="true">
                                    <!-- form check -->
                                    <div class="form-check">
                                        <input class="form-check-input active" value="<?= $answers["id"]; ?>" type="radio" name="<?= $answers["question_id"]; ?>" id="<?= $answers["question_id"] + $i; ?>">
                                        <label class="form-check-label stretched-link" for="<?= $answers["question_id"] + $i; ?>">
                                            <?= $answers["title"]; ?>
                                        </label>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                    <hr class="">

                <?php } ?>

            </div>

            <div class="align-items-center mt-30">
                <button type="submit" class="btn btn-sm btn-danger btn-block submit-btn" style="border-radius: 10px !important;">Nộp bài</button>
            </div>
        </form>
    </section>

</div>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="section-title after-line font-20 text-dark-blue mb-25">Cấu hình chung</h3>

                <div class="form-group">
                    <div class="custom-control">
                        <label class="switch mr-2">
                            <input type="checkbox" id="sp-mode">
                            <span class="slider round"></span>
                        </label>
                        <span>Chế độ tập trung</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery cookie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
<?php
$session_namespace = strtolower(SlugURL($quiz["title"]) . $id);
if (!isset($_SESSION[$session_namespace]['end_time'])) {
    // Nếu chưa tồn tại, thiết lập biến session
    $_SESSION[$session_namespace]['end_time'] = strtotime('+1 minutes', time()) * 1000;
}
?>
<script>
    Toastify({
        text: "BẮT ĐẦU TÍNH GIỜ LÀM BÀI!",
        duration: 2000,
        newWindow: true,
        close: true,
        gravity: "bottom",
        position: "center",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(160deg, #0093E9 0%, #80D0C7 100%)",
        },
    }).showToast();

    const endTime = <?= $_SESSION[$session_namespace]['end_time']; ?>;

    function updateClock() {
        const now = new Date().getTime();
        const timeLeft = endTime - now;
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        if (seconds < 0) {
            $('.quiz-form').addClass('hide-element');
            Toastify({
                text: "ĐÃ HẾT THỜI GIAN LÀM BÀI!",
                duration: 5000,
                newWindow: true,
                close: true,
                gravity: "bottom",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%)",
                },
            }).showToast();
            $('.submit-btn').prop("disabled", true);
            stopClock();
            document.getElementById('clock').innerHTML = `----`;
            return 0;
        }
        document.getElementById('clock').innerHTML = `${minutes} phút ${seconds} giây`;
    }

    function stopClock() {
        clearInterval(intervalID);
    }

    var intervalID = setInterval(updateClock, 1000);

    // change simple mode
    $(document).ready(function() {
        // $('.submit-btn').prop('disabled', true);
        var simpleMode = Cookies.get('simple_mode');
        if (simpleMode === undefined) {
            simpleMode = 'off';
            Cookies.set('simple_mode', simpleMode, {
                expires: 7
            });
        }
        updateUI(simpleMode);
        $('#sp-mode').click(function() {
            simpleMode = (simpleMode === 'on') ? 'off' : 'on';
            Cookies.set('simple_mode', simpleMode, {
                expires: 7
            });
            updateUI(simpleMode);
        });

        function updateUI(simpleMode) {
            var isChecked = (simpleMode === 'on');
            $("#sp-mode").prop("checked", isChecked);
            if (isChecked) {
                $('#top-navbar, #navbar, #footer').addClass("hide-element");
            } else {
                $('#top-navbar, #navbar, #footer').removeClass("hide-element");
            }
        }
    });

    // gửi dữ liệu lên server
    $("#quiz_form").submit(function(e) {
        $('.submit-btn').html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Loading...').prop("disabled", true);
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "<?= $domain; ?>handler/execute/quiz.php?action=submit",
            data: formData,
            success: function(response) {
                $('.submit-btn').html("Nộp bài").prop("disabled", false);
                // Handle the response from the server
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
</script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');
?>