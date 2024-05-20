<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
if (!isset($users)) {
    die('<script>location.href="/login"</script>');
}
// ------------------------------------------------
if (!isset($_GET['order_id'])) {
    die('<script>location.href="/home"</script>');
}
// ------------------------------------------------
$myfile = fopen("log-coins.txt", "a+");
fwrite($myfile, print_r($_GET, true) . PHP_EOL);
fclose($myfile);
// ------------------------------------------------
$checkOrder = $conn->query("SELECT * FROM orders WHERE trans_id = '{$_GET['order_id']}' AND status = 'success'");
$Show_Data = true;
if ($checkOrder->num_rows >= 1) {
    $checkOrder_Data = $checkOrder->fetch_array();
    if (isset($_GET['order_id'])) {
        // Kiểm tra webinars
        $checkWebinars = $conn->query("SELECT * FROM webinars WHERE id = '{$checkOrder_Data['webinar_id']}' AND status = 'active'");
        if ($checkWebinars->num_rows >= 1) {
            // Data Webnars
            $webinars = $checkWebinars->fetch_array();
            $OrderItemInsert = $base->insert_if_not_exists(
                "order_items",
                [
                    "webinar_id" => $webinars['id'],
                    "user_id"   => $user_id
                ],
                [
                    "user_id"    => $user_id,
                    "order_id"  => $checkOrder_Data['id'],
                    "webinar_id"     => $webinars['id'],
                    "trans_id" => $checkOrder_Data['trans_id'],
                    "amount" => $checkOrder_Data['amount'],
                    "total_amount"   => $checkOrder_Data['total_amount'],
                    "type"           => "coins",
                    "created_at" => time()
                ]
            );
            if ($OrderItemInsert) {
                $order_info = [
                    'name' => $users['name'],
                    'webinar_title' => $webinars['title'],
                    'webinar_price' => number_format($webinars['price']),
                    'webinar_image' => $webinars['thumbnail'],
                    'webinar_payment_method' => 'K-COINS',
                    'webinar_time' => date('d/m/Y - H:i:s', time())
                ];
                if ($user_email != "") {
                    // Gửi email
                    $send_mail = send_mail($user_email, 'Complete Order', 0, 'course-order', $order_info);
                    if ($send_mail) {
                        echo '<div class="alert alert-success" role="alert">Email đã được gửi tới: ' . $user_email . '</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Có lỗi khi gửi mail tới: ' . $user_email . '</div>';
                    }
                }
                // Cộng 1 người dùng tham gia khóa học
                $conn->query("UPDATE webinars SET `user_order` = `user_order` + 1 WHERE `id` = '{$checkOrder_Data['webinar_id']}'");
                $Show_Data = true;
                $MSG = 'Hoàn tất, khóa học bạn đã được thanh toán thành công bằng K-COINS.';
            } else {
                $MSG = 'Khóa học này đã được thanh toán trước đó.';
            }
        } else {
            $MSG = 'Khóa học không tồn tại hoặc đã bị ẩn.';
        }
    }
} else {
    $MSG = 'Đơn hàng không tồn tại hoặc đã được thanh toán trước đó.';
}
?>
<section class="container mt-45">
    <h2 class="text-center">Kiểm tra trạng thái đơn hàng #<?= $_GET['order_id']; ?></h2>
    <small class="font-weight-bold">Đơn hàng thanh toán bằng: COINS</small>
    <?php if ($Show_Data) { ?>
        <div class="mt-20"></div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Tên khóa học</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Mã giao dịch</th>
                        <!-- <th scope="col">Ngân hàng</th> -->
                        <!-- <th scope="col">Thời gian</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><?= $webinars['title']; ?></th>
                        <td><?= number_format($checkOrder_Data['amount']); ?>đ</td>
                        <td><strong class="text-primary">Đã thanh toán</strong></td>
                        <td><?= $checkOrder_Data['trans_id']; ?></td>
                        <!-- <td><?= $_GET['vnp_BankCode']; ?></td> -->
                        <!-- <td><?= date('d/m/Y - H:i:s', time()); ?></td> -->
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <div class="mt-20"></div>
    <div class="d-flex align-items-center mb-25 p-15 rounded-sm" style="border: solid 1px #43d477">
        <div class="primary-transparent-alert__icon d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-bags-shopping text-white"></i>
        </div>

        <div class="ml-10">
            <div class="font-13 font-weight-bold"><?= $MSG; ?></div>
        </div>
    </div>

    <button class="btn btn-sm btn-primary" onclick="window.location.href='/home'"><i class="fa-solid fa-house mr-5"></i> Về trang chủ</button>

</section>

<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');
?>