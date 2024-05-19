<?php
include "../config.php";
$action = isset($_GET["action"]) ? $_GET["action"] : "";
if ($action == 'add') {
    $slug = isset($_POST["slug"]) ? $_POST["slug"] : "";
    if ($slug == "") {
        echo swal("Thông báo", "Không được bỏ trống thông tin", "error", false);
        return;
    }
    if (!isset($users)) {
        echo swal("Thông báo", "Đăng nhập để thêm khóa học vào danh sách yêu thích bạn nhé!", "error", false);
        return;
    }

    $checkSlug = $conn->query("SELECT * FROM webinars WHERE slug = '{$slug}'")->num_rows;
    $checkCourse = $conn->query("SELECT * FROM favourite_courses WHERE course_slug = '{$slug}' AND user_id = '{$users['id']}' ")->num_rows;
    if ($checkSlug <= 0) {
        echo swal("Thông báo", "Khóa học không tồn tại!", "error", false);
    } elseif ($checkCourse == 1) {
        echo swal("Thông báo", "Khóa học này đã tồn tại trong danh sách yêu thích của bạn!", "error", false);
    } elseif ($checkSlug == 1) {
        $base->insert_if_not_exists(
            "favourite_courses",
            [
                "user_id"     => $users['id'],
                "course_slug" => $slug
            ],
            [
                "user_id"     => $users['id'],
                "course_slug" => $slug,
                "time"        => $date
            ]
        );
        echo swal("Thông báo", "Thêm khóa học thành công!", "success", true);
    }
}
