<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
if (!isset($users)) {
    exit('<script>location.href="/home"</script>');
}
?>
<style>
    .nowrap {
        white-space: nowrap;
    }
</style>
<!--Table-->
<div class="table-responsive">
    <table class="table table-hover table-fixed table-bordered">
        <thead>
            <tr class="bg-info">
                <th>Mã giao dịch</th>
                <th>Loại thẻ</th>
                <th>Loại</th>
                <th>Mã thẻ</th>
                <th>Mã serial</th>
                <th>Mệnh giá</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th>Thời gian xử lý</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_history = $conn->query("SELECT * FROM history_recharge WHERE email = '{$user_email}' ORDER BY id DESC");
            if ($get_history->num_rows > 0) {
                while ($info_history = $get_history->fetch_array()) {
            ?>
                    <tr>
                        <td><?= $info_history['trans_id']; ?></td>
                        <td><?= $info_history["telco"]; ?></td>
                        <td><?= $info_history['type']; ?></td>
                        <td><?= $info_history["serial"]; ?></td>
                        <td><?= $info_history["pin"]; ?></td>
                        <td><?= number_format($info_history["amount"]); ?>đ</td>
                        <td><?= status_card($info_history["status"]); ?></td>
                        <td><?= date('d/m/Y - H:i:s', $info_history["time"]); ?></td>
                        <td><?php
                            if ($info_history['status'] == 0) {
                                echo '<p><i class="fa-duotone fa-spinner-third fa-spin" style="--fa-secondary-opacity: 0.5;"></i></p>';
                            } else {
                                echo count_callback_time($info_history['callback_time'] - $info_history['time']);
                            } ?>
                        </td>
                    </tr>
                <?php }
            } else { ?>
            <tr>
                <td>Không có giao dịch nào.</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>