<?php
sleep(1);
include "../config.php";
$action = isset($_GET["action"]) ? $_GET["action"] : "";
# NHẬN KHÓA HỌC MIỄN PHÍ
if ($action == 'free') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $slug = isset($_POST["slug"]) ? $_POST["slug"] : "";
        if (isset($_COOKIE['AUTH'])) {
            // Kiểm tra slug webinars
            $checkSlug = $conn->query("SELECT * FROM webinars WHERE slug = '{$slug}'");
            // Data Webnars
            $webinars = $checkSlug->fetch_array();
            // Kiểm tra người dùng đã sở hữu khóa học hay chưa
            $checkOrder = $conn->query("SELECT * FROM order_items WHERE user_id = '{$users['id']}' AND webinar_id = '{$webinars['id']}'")->num_rows;
            if ($slug == "") {
                echo swal("Thông báo", "Khóa học không tồn tại!", "error", false);
            } elseif ($checkSlug->num_rows <= 0) {
                echo swal("Thông báo", "Khóa học không tồn tại hoặc đã bị tạm ẩn!", "error", false);
            } elseif ($webinars['price'] != 0) {
                echo swal("Thông báo", "Khóa học không thuộc loại miễn phí!", "error", false);
            } elseif ($checkOrder >= 1) {
                echo swal("Thông báo", "Bạn đã sở hữu khóa học này rồi!", "error", false);
            } else {
                $trans_id = 'free' . rand(1000, 9999);
                $orderInsert = $base->insert_if_not_exists(
                    "orders",
                    [
                        "trans_id" => 9999
                    ],
                    [
                        "user_id"    => $users['id'],
                        "webinar_id" => $webinars['id'],
                        "status"     => "success",
                        "payment_method" => 'free',
                        "amount" => 0,
                        "total_amount" => 0,
                        "trans_id"   => $trans_id,
                        "created_at"    => time()
                    ]
                );
                if ($orderInsert) {
                    $order_id = $conn->query("SELECT * FROM orders WHERE trans_id = '{$trans_id}'")->fetch_array();
                    $OrderItemInsert = $base->insert_if_not_exists(
                        "order_items",
                        [
                            "webinar_id" => $webinars['id'],
                            "user_id"   => $users['id']
                        ],
                        [
                            "user_id"    => $users['id'],
                            "order_id"  => $order_id['id'],
                            "webinar_id"     => $webinars['id'],
                            "trans_id" => $trans_id,
                            "amount" => 0,
                            "total_amount"   => 0,
                            "type"           => "free",
                            "created_at" => time()
                        ]
                    );
                    if ($OrderItemInsert) {
                        echo swal("Thông báo", "Nhận khóa học miễn phí thành công!", "success", true);
                    } else {
                        echo swal("Thông báo", "Lỗi truy vấn dữ liệu!", "error", true);
                    }
                } else {
                    echo swal("Thông báo", "Lỗi truy vấn dữ liệu!", "error", true);
                }
            }
        } else {
            echo swal("Thông báo", "Vui lòng đăng nhập để nhận khóa học này!", "login", false);
        }
    } else {
        echo swal("Cảnh báo", "Phương thức không hợp lệ!", "warning", true);
    }
} elseif ($action == '') {
    exit();
}
