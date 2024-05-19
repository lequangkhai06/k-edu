<?php
include "../config.php";
$item = isset($_POST["item"]) ? $_POST["item"] : "";
$item_id = isset($_POST["item_id"]) ? $_POST["item_id"] : "";
$status = isset($_POST["status"]) ? $_POST["status"] : "";
$slug = isset($_POST["slug"]) ? $_POST["slug"] : "";
if ($item == "" || $item_id == "" || $status == "" || $slug == "") {
    echo swal("Thông báo", "Không đủ thông tin.", "error", false);
    return;
}
if (!isset($users)) {
    echo swal("Thông báo", "Bạn chưa đăng nhập.", "login", false);
    return;
}

// check slug
$course = $conn->query("SELECT * FROM webinars WHERE slug = '{$slug}'", 1)->fetch_array();

if (!$course) {
    echo swal("Thông báo", "Khóa học không tồn tại.", "error", false);
    return;
}

$orderItem = $conn->query("SELECT * FROM order_items WHERE webinar_id = '{$course['id']}' AND user_id = '{$users['id']}' ", 1)->fetch_array();
// kiểm tra người dùng đã tham gia khóa học chưa
if (!$orderItem) {
    echo swal("Thông báo", "Bạn chưa tham gia khóa học này.", "error", false);
    return;
}

$orderID = $conn->query("SELECT * FROM orders WHERE trans_id =  '{$orderItem['trans_id']}' AND status = 'success'")->fetch_array();
// kiểm tra trạng thái orders
if (!$orderID) {
    echo swal("Thông báo", "Đơn hàng chưa được thanh toán.", "error", false);
    return;
}

if ($status == "false") {
    echo swal("Thông báo", "Không thể thay đổi trạng thái.", "error", false);
} else {
    $file_id = 0;
    $text_lesson_id = 0;
    $is_query = false;
    if ($item == 'file_id') {
        $checkIdLesson = $conn->query("SELECT * FROM files WHERE webinar_id = '{$course['id']}' AND id = '{$item_id}' ", 1)->fetch_array();
        // kiem tra id bai hoc file
        if (!$checkIdLesson) {
            echo swal("Thông báo", "Bài học không tồn tại.", "error", false);
        } else {
            $chapter_id = $checkIdLesson['chapter_id'];
            $file_id = $checkIdLesson['id'];
            $is_query = true;
        }
    } elseif ($item == 'text_lesson') {
        $checkIdTextLesson = $conn->query("SELECT * FROM text_lessons WHERE webinar_id = '{$course['id']}' AND id = '{$item_id}' ", 1)->fetch_array();
        // kiem tra id bai hoc text_lessons
        if (!$checkIdTextLesson) {
            echo swal("Thông báo", "Bài học không tồn tại.", "error", false);
        } else {
            $chapter_id = $checkIdTextLesson['chapter_id'];
            $text_lesson_id = $checkIdTextLesson['id'];
            $is_query = true;
        }
    }
    // insert db
    if ($is_query) {
        $query = $base->insert_if_not_exists(
            "user_passed_lesson",
            [],
            [
                "email"     => $user_email,
                "webinar_id" => $course['id'],
                "webinar_type" => $item,
                "chapter_id" => $chapter_id,
                "text_lesson_id" => $text_lesson_id,
                "file_id" => $file_id,
                "created_time" => $date
            ]
        );
        if ($query) {
            echo swal("Thông báo", "Thay đổi trạng thái thành công.", "success", true);
        } else {
            echo swal("Thông báo", "Đã thay đổi trạng thái trước đó.", "error", false);
        }
    }
}
