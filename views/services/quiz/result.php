<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
if (!$users) {
    die('<script>location.href="/login"</script>');
}
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$result_id = isset($_GET['result_id']) ? $_GET['result_id'] : 0;

// Lấy thông tin quiz dựa trên id
$quiz = $conn->query("SELECT * FROM quizzes WHERE id = '{$id}'")->fetch_array();
if (!$quiz) {
    die('<script>location.href="/home"</script>');
}

// Lấy thông tin webinar liên quan đến quiz
$get = $conn->query("SELECT * FROM webinars WHERE id = '{$quiz["webinar_id"]}'");
$count = $get->num_rows;
$course_data = $get->fetch_array();

// Lấy thông tin câu hỏi của quiz
$quiz_question = $conn->query("SELECT * FROM quizzes_questions WHERE quiz_id = '{$id}'");
$total_quiz_question = $quiz_question->num_rows;

// Lấy thông tin kết quả quiz
$query_data_result = $conn->query("SELECT * FROM quizzes_results WHERE id = '{$result_id}' AND user_id = '{$user_id}' AND quiz_id = '{$quiz["id"]}' AND (status = 'passed' OR status = 'failed')");
$query_data_result2 = $conn->query("SELECT * FROM quizzes_results WHERE user_id = '{$user_id}' AND quiz_id = '{$quiz["id"]}' AND (status = 'passed' OR status = 'failed')");
$data_result = $query_data_result->fetch_array();
$total_result = $query_data_result2->num_rows;

// Kiểm tra nếu người dùng đã vượt quá số lần thử
$remake = true;
if ($total_result >= $quiz["attempt"]) {
    $remake = false;
}

// Lấy điểm số cao nhất của người dùng
$query_max_grade = $conn->query("SELECT MAX(user_grade) as max_user_grade FROM quizzes_results WHERE user_id = '{$user_id}' AND quiz_id = '{$quiz["id"]}'");
$max_user_grade = 0;
if ($query_max_grade->num_rows > 0) {
    $row = $query_max_grade->fetch_assoc();
    $max_user_grade = $row["max_user_grade"];
}

// Kiểm tra nếu không có kết quả
if (!$data_result) {
    echo '<script>
    Toastify({
        text: "Kết quả không tồn tại trên hệ thống!",
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

// Giải mã chuỗi JSON thành mảng PHP chứa kết quả người dùng
$json_string = $data_result["results"];
$data = json_decode($json_string, true);

// Tạo mảng chứa kết quả chi tiết của từng câu hỏi
$result_array = [];
foreach ($data as $item) {
    foreach ($item as $key => $value) {
        $result_array[] = [
            'key' => $key,
            'user_ans' => $value['user_ans'],
            'correct' => $value['correct'],
            'status' => $value['status'],
            'grade' => $value['grade'],
            'total_grade' => $value['total_grade']
        ];
    }
}

// Kiểm tra nếu quiz chưa có câu hỏi nào
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

// Kiểm tra nếu creator đã ẩn đáp án
if ($quiz["show_result"] == "hide") {
    echo '<script>
    Toastify({
        text: "ĐÁP ÁN ĐÃ ẨN!",
        duration: 4000,
        newWindow: true,
        close: true,
        gravity: "bottom",
        position: "center",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, rgb(246, 60, 60), rgb(205,92,92))",
        },
    }).showToast();
    </script>';
}

// Lấy thông tin người tạo quiz
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
        <h1 class="font-weight-bold text-dark-blue">KẾT QUẢ: <?= $quiz["title"]; ?></h1>
        <p class="text-gray font-14 mt-5">
            <a href="/course/<?= $course_data['slug']; ?>" target="_blank" class="text-black">Khoá học: <?= $course_data["title"]; ?></a>
            | Bởi
            <span class="font-weight-bold">
                <a href="/users/profile/<?= $creator["id"]; ?>" target="_blank" class="font-14 "> <?= $creator["name"]; ?></a>
            </span>
        </p>

        <div class="mt-2">
            <div class="d-flex flex-wrap">
                <button class="btn btn-primary js-settings-quizz m-1" data-toggle="modal" data-target="#exampleModal">
                    <i data-feather="settings" class="mr-1"></i> <b>Cấu hình</b>
                </button>
                <button onclick="window.location.href='/quizzes/<?= $id; ?>/start'" class="btn btn-danger js-settings-quizz m-1" <?= $remake == false ? 'disabled' : ""; ?>>
                    <i data-feather="refresh-ccw" class="mr-1"></i> <b>Làm lại</b>
                </button>
            </div>
        </div>


        <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/58.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5"><?= $max_user_grade ?>/<?= $quiz["total_mark"]; ?></strong>
                        <span class="font-16 text-gray">Điểm cao nhất của bạn</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/88.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5"><?= $total_result; ?>/<?= $quiz["attempt"]; ?></strong>
                        <span class="font-16 text-gray">Làm bài lại</span>
                    </div>
                </div>
                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/45.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5"><?= $data_result["user_grade"]; ?></strong>
                        <span class="font-16 text-gray">Điểm của bạn</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/44.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-secondary mt-5">
                            <div class="d-flex align-items-center timer ltr" id="clock"><?php echo $data_result["user_grade"] >= $quiz["pass_mark"]  ? "<span class='text-primary'>Đạt</span>" : "<span class='text-danger'>Chưa đạt</span>"; ?></div>
                        </strong>
                        <span class="font-16 text-gray">Trạng thái</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-30">
        <div class="alert alert-secondary text-light" role="alert">
            <h2>Giải thích kí hiệu:</h2>
            <br>
            <ul>
                <li><i class="fa-sharp fa-solid fa-square-info mr-2"></i>Thí sinh không chọn đáp án nào.</li>
                <li><i class="fa-solid fa-badge-check mr-2"></i>Đáp án của thí sinh chọn.</li>
                <li><i class="fa-solid fa-square-question mr-2"></i>Đáp án đã được ẩn.</li>
                <li>Các đáp án được đánh dấu màu xanh là đáp án đúng.</li>
            </ul>
        </div>
    </section>

    <section class="mt-30 quiz-form">
        <form action="#" method="post" class="" id="quiz_form">
            <input type="hidden" name="webinar_id" value="<?= $quiz["webinar_id"]; ?>" class="form-control" placeholder="" />
            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <?php
                $i = -1;
                while ($question = $quiz_question->fetch_array()) {
                    $quizzes_questions_answers = $conn->query("select * from quizzes_questions_answers where question_id = '{$question["id"]}'");
                    $i += 1;
                    $user__ans = $result_array[$i]["user_ans"];
                    $quizz_ans = $result_array[$i]["correct"];
                    $title_icon = '<i class="fa-solid fa-xmark mr-2 fa-lg" style="color: #ff0000;"></i>';
                    if ($quizz_ans == $user__ans) {
                        $title_icon = '<i class="fa-solid fa-check mr-2 fa-lg" style="color: #39c098;"></i>';
                    }
                ?>
                    <!-- qs -->
                    <div class="question">
                        <h3><?= $title_icon; ?> <?= $question["title"]; ?></h3>
                        <div class="mt-2"></div>
                        <ul class="list-group">
                            <?php
                            while ($answers = $quizzes_questions_answers->fetch_array()) {
                                if ($quiz["show_result"] == "show") {
                                    $active_ans = "wr-active";
                                    $icon_ans = "fa-solid fa-shield-xmark";
                                    if ($answers["id"] == $quizz_ans) {
                                        $active_ans = "active";
                                    }
                                    if ($user__ans == $answers["id"]) {
                                        $icon_ans = "fa-solid fa-badge-check";
                                    }
                                    if ($user__ans == 0) {
                                        $icon_ans = "fa-sharp fa-solid fa-square-info";
                                    }
                                } else {
                                    $icon_ans = "fa-solid fa-square-question";
                                    $active_ans = "";
                                }
                            ?>
                                <li class="list-group-item <?= $active_ans; ?>" style="display: flex;align-items: center;"><i style="margin-right: 20px;" class="<?= $icon_ans; ?>"></i><?= $answers["title"]; ?></li>

                            <?php } ?>

                        </ul>
                    </div>
                    <hr class="">

                <?php } ?>

            </div>

            <!-- <div class="align-items-center mt-30">
                <button type="submit" class="btn btn-sm btn-danger btn-block submit-btn" style="border-radius: 10px !important;">Nộp bài</button>
            </div> -->
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
                    <hr>
                    <div class="mt-2"></div>
                    <div class="custom-control">
                        <a class="text-danger text-center" href="/users/profile/<?= $quiz["creator_id"]; ?>" target="_blank" rel="noopener noreferrer">
                            <p>Báo lỗi cho giáo viên.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery cookie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
<script>
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
    // $("#quiz_form").submit(function(e) {
    //     $('.submit-btn').html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span> Loading...').prop("disabled", true);
    //     e.preventDefault();
    //     var formData = $(this).serialize();
    //     $.ajax({
    //         type: "POST",
    //         url: "<?= $domain; ?>handler/execute/quiz.php?action=submit",
    //         data: formData,
    //         success: function(response) {
    //             $('.submit-btn').html("Nộp bài").prop("disabled", false);
    //             // Handle the response from the server
    //             console.log(response);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error("Error:", error);
    //         }
    //     });
    // });
</script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');
?>