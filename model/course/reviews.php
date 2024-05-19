<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
$course_id = isset($_POST['course_id']) ? $_POST['course_id'] : "";
$course = $conn->query("SELECT * FROM webinars WHERE id = '{$course_id}'", 1)->fetch_array();
if (!$course) {
    echo "<p>Không có nhận xét nào.</p>";
    return;
}
$review_query = $conn->query("SELECT * FROM webinar_reviews WHERE webinar_id = '{$course['id']}' AND status = 'active' order by id desc");
if ($review_query->num_rows > 0) {
    while ($row = $review_query->fetch_array()) {
        $reviewer = $conn->query("SELECT * FROM users WHERE id =  '{$row['user_id']}'")->fetch_array();
        $reviewerAvatar = $reviewer["avatar"];
        $reviewerName = $reviewer["name"];
        $reviewerEmail = $reviewer["email"];
        if ($row["user_type"] == "hide") {
            $reviewerAvatar = "https://i.imgur.com/h0Ajgaa.png";
            $reviewerName = "Ẩn danh";
            $reviewerEmail = "";
        }
?>

        <!-- HIỂN THỊ BÌNH LUẬN -->
        <div class="comments-card shadow-lg rounded-sm border px-20 py-15 mt-30 bg-secondary">
            <div class="d-flex align-items-center justify-content-between">
                <div class="user-inline-avatar d-flex align-items-center mt-10">
                    <div class="avatar bg-gray200">
                        <img src="<?= $reviewerAvatar; ?>" class="img-cover" alt="">
                    </div>
                    <div class="d-flex flex-column ml-5">
                        <span class="font-weight-500 text-white"><?= $reviewerName; ?></span>

                        <div class="stars-card d-flex align-items-center justify-content-start mt-5">

                            <?= StarsRating($row['rates']); ?>

                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <span class="font-12 text-white mr-10 font-weight-bold"><?= time_ago($row['created_at']); ?></span>
                </div>
            </div>

            <div class="mt-20 text-white font-14">
                <?= $row['description']; ?>
            </div>

        </div>
        <!-- KẾT THÚC HIỂN THỊ BÌNH LUẬN -->

<?php }
} ?>

<script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>