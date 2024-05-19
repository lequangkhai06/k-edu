<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$info_acc = $conn->query("SELECT * FROM list_accounts WHERE id = '{$id}'", 1)->fetch_array();
$json_data = json_decode($info_acc['detail'], true);
$detail['code'] = $json_data['code'];
$detail['type_account'] = $json_data['type_account'];
$detail['note'] = $json_data['note'];
$full_detail = addslashes(json_encode($detail));
$detail_random['code'] = $json_data['code'];
$full_detail_random = addslashes(json_encode($detail_random));

if (!$users) {
    echo swal("Lỗi", "Bạn chưa đăng nhập!", "error", false);
} elseif (!$id) {
    echo swal("Lỗi", "Lỗi vui lòng thử lại sau", "error", false);
} elseif (!$_GET) {
    echo swal("Lỗi", "Lỗi không xác định", "error", false);
} elseif ($info_acc["status"] == '1') {
    echo swal("Lỗi", "Tài khoản đã được bán", "error", false);
} else {
    // using giftcode
    if (isset($_SESSION['giftcode'])) {
        if (isset($_SESSION['id_acc'])) {
            if (isset($_SESSION['new_price'])) {
                if ($_SESSION['id_acc'] == $info_acc['id']) {
                    $info_giftcode = $conn->query("SELECT * FROM giftcode WHERE giftcode = '{$_SESSION['giftcode']}'", 1)->fetch_array();
                    if ($info_giftcode) {
                        $total_price = $info_acc['price'] / 100 * $info_giftcode['percent'];
                        $use_giftcode = true;
                    }
                } else {
                    $total_price = $info_acc['price'];
                    $use_giftcode = false;
                }
            }
        }
    } else {
        $total_price = $info_acc['price'];
        $use_giftcode = false;
    }
    if ($total_price > $users['price']) {
        echo swal("Lỗi", "Bạn không đủ tiền để mua tài khoản này", "error", false);
    } else {
        if ($use_giftcode) {
            // update usecode
            $conn->query("UPDATE giftcode SET use_gift = use_gift + 1 WHERE giftcode = '{$_SESSION['giftcode']}'");
            // update history
            $conn->query("INSERT INTO history_giftcode SET username = '{$users["username"]}', giftcode = '{$info_giftcode['giftcode']}', type_gift = '{$info_giftcode['type_gift']}', value_gift = '{$info_giftcode['value_gift']}', time = '" . time() . "'");
        }
        // set status account
        $conn->query("UPDATE list_accounts SET status = '1' WHERE id = '{$id}' LIMIT 1");
        // update price
        $conn->query("UPDATE users SET price = price - '{$total_price}' WHERE `username` = '{$users['username']}'");
        // unset session
        unset($_SESSION['giftcode']);
        unset($_SESSION['id_acc']);
        unset($_SESSION['new_price']);
        // buy acc 
        if ($info_acc["type_game"] == "FreeFire") {
            $conn->query("INSERT INTO history_buy SET username = '{$users["username"]}', users_post = '{$info_acc["username"]}', type = '{$info_acc["type"]}', id_acc = '{$info_acc['id']}', account = '{$info_acc['accounts']}', pass = '{$info_acc['password']}', price = '{$info_acc['price']}', detail = '{$full_detail}', time_at = '{$date}'");
            echo swal("Thành công", "Mua tài khoản thành công", "success", true);
            // buy acc random
        } else {
            $conn->query("INSERT INTO history_buy SET username = '{$users["username"]}', users_post = '{$info_acc["username"]}', type = '{$info_acc["type"]}', id_acc = '{$info_acc['id']}', account = '{$info_acc['accounts']}', pass = '{$info_acc['password']}', price = '{$info_acc['price']}', detail = '{$full_detail_random}', time_at = '{$date}'");
            echo swal("Thành công", "Mua tài khoản thành công", "success", true);
        }
    }
}
