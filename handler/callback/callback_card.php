<?php
require "../config.php";
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$status = isset($_GET['status']) ? $_GET['status'] : "";
$tran_id = isset($_GET['request_id']) ? $_GET['request_id'] : "";
if ($tran_id == "") {
    die('order not found!');
}
$check = $conn->query("SELECT * FROM `history_recharge` WHERE `request_id` = '{$tran_id}' AND `status` = 0")->fetch_array();
$myfile = fopen("logCard.txt", "a+");
fwrite($myfile, print_r($_GET, true) . PHP_EOL);
fclose($myfile);
if (isset($_GET['status'])) {
    // Pusher realtime
    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        '84ac4d7309d8e57416d6',
        '3ea1a79b1b75290e7f73',
        '1624420',
        $options
    );
    $pusher_config = [
        'my-channel' => 'user',
        'my-event' => 'history_recharge'
    ];
    if ($check) {
        if ($status == 1) {
            // update amount
            $conn->query("UPDATE history_recharge SET `status` = 1, `callback_time` = '{$date}' WHERE `request_id` = '{$tran_id}'");
            // update cash user
            $conn->query("UPDATE users SET `coins` = `coins` + '{$check["amount"]}', `accumulation` = `accumulation` + '{$check["amount"]}'  WHERE `email` = '{$check['email']}'");
            echo 'success!!';
        } else {
            $conn->query("UPDATE history_recharge SET `status` = 2, `callback_time` = '{$date}'  WHERE `request_id` = '{$tran_id}'");
            echo 'error!!';
        }
        // Pusher message
        $data['message'] = "Thẻ cào serial: {$check['serial']} đã được xử lý!";
        $pusher->trigger($pusher_config['my-channel'], $pusher_config['my-event'], $data);
    } else {
        echo 'order not found!';
    }
} else {
    echo 'order not found!';
}
