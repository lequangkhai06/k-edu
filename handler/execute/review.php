<?php
include "../config.php";
$action = isset($_GET["action"]) ?? "";
if (!$users) {
    echo swal("Lỗi", "Bạn chưa đăng nhập", "error", false);
    return;
}
switch ($action) {
    case 'create_review':
        $course_id = isset($_POST["course_id"]) ? $_POST["course_id"] : 0;
        // kiểm tra xem có sở hữu khoá học hay không
        if (!$base->checkUserCourse($course_id, $user_id)) {
            echo swal("Lỗi", "Bạn không sở hữu hoặc tham gia khoá học này!", "error", true);
            return;
        }
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $anonymous_user = isset($_POST['anonymous_user']) ? $_POST['anonymous_user'] : false;
        $star_rating = isset($_POST['star_rating']) ? $_POST['star_rating'] : "";
        if ($description == null || $star_rating == "") {
            echo swal("Lỗi", "Vui lòng điền đầy đủ thông tin!", "error", true);
            return;
        }
        if ($anonymous_user) {
            $anonymous_user = "hide";
        } else {
            $anonymous_user = "show";
        }
        // insert db
        $reviewInsert = $base->insert_if_not_exists(
            "webinar_reviews",
            [
                "user_id" => 0,
            ],
            [
                "user_id"    => $user_id,
                "webinar_id" => $course_id,
                "user_type"     => $anonymous_user,
                "rates" => $star_rating,
                "description" => $description,
                "liked" => 0,
                "created_at"    => time()
            ]
        );
        echo swal("Thành Công", "Đã gửi đánh giá của bạn!", "success", true);

        break;

    default:
        # code...
        break;
}
