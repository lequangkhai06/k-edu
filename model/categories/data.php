<?php
// sleep(5);
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
if (isset($_POST['slug'])) { ?>
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>

        <?php
        $page = isset($_POST['page']) ? $_POST['page'] : "";
        $char = isset($_POST['char']) ? $_POST['char'] : "";
        $sort = isset($_POST['sort']) ? $_POST['sort'] : "";
        $price = isset($_POST['price']) ? $_POST['price'] : "";
        $slug = isset($_POST['slug']) ? $_POST['slug'] : "";
        $categories = $conn->query("SELECT * FROM categories WHERE slug = '{$slug}'", 1)->fetch_array();
        // tìm kiếm qua tên, mô tả
        if ($char) {
            $sql_char = " AND title LIKE '%{$char}%' AND seo_description LIKE '%{$char}%'";
        } else {
            $sql_char = " ";
        }
        // tìm kiếm option
        if ($sort == "" || $sort == "newest") {
            $sql_sapxep = "id DESC";
        } elseif ($sort == 'inexpensive') {
            $sql_sapxep = "price ASC";
        } elseif ($sort == 'expensive') {
            $sql_sapxep = "price DESC";
        } elseif ($sort == 'bestsellers') {
            $sql_sapxep = "user_order DESC";
        }
        // tìm kiếm theo giá
        if ($price == 1) {
            $sql_price = "AND `price` <= 100000 ";
        } elseif ($price == 2) {
            $sql_price = "AND `price` BETWEEN 100000 AND 400000 ";
        } elseif ($price == 3) {
            $sql_price = "AND `price` BETWEEN 400000 AND 800000 ";
        } elseif ($price == 4) {
            $sql_price = "AND `price` BETWEEN 800000 AND 1000000 ";
        } elseif ($price == 5) {
            $sql_price = "AND `price` >= 1000000 ";
        } else {
            $sql_price = '';
        }
        $total_records = $conn->query("SELECT * FROM webinars WHERE type = 'text_lesson' $sql_price AND category_id = '{$categories['id']}' $sql_char")->num_rows;
        $config = array(
            "current_page" => $page,
            "total_record" => $total_records,
            "limit" => "5",
            "range" => "5",
            "link_first" => "",
            "link_full" => "?page={page}"
        );

        $paging = new Pagination;
        $paging->init($config);
        $get = $conn->query("SELECT * FROM webinars WHERE type = 'text_lesson' $sql_price AND category_id = '{$categories['id']}' $sql_char ORDER BY $sql_sapxep LIMIT {$paging->getConfig()['start']}, {$paging->getConfig()['limit']}");
        if ($get->num_rows > 0) {
            while ($row = $get->fetch_array()) {
                $author = $conn->query("SELECT * FROM users WHERE id =  '{$row['teacher_id']}'")->fetch_array();
        ?>
                <div class="webinar-card webinar-list webinar-list-2 d-flex mt-30">
                    <div class="image-box">
                        <?php if ($row['discount'] != 0) { ?>
                            <span class="badge badge-danger">Giảm <?= $row['discount']; ?>%</span>
                        <?php } elseif ($row['discount'] == 0 && $row['price'] == 0) { ?>
                            <span class="badge badge-primary">Miễn phí</span>
                        <?php } ?>

                        <a href="/course/<?= $row['slug']; ?>">
                            <img src="<?= $row['thumbnail']; ?>" class="img-cover">
                        </a>

                        <div class="progress-and-bell d-flex align-items-center">

                        </div>
                    </div>

                    <div class="webinar-card-body w-100 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="/course/<?= $row['slug']; ?>">
                                <h3 class="webinar-title font-weight-bold font-20 text-dark-blue"><?= $row['title']; ?></h3>
                            </a>
                        </div>
                        <div class="mt-2"></div>
                        <div class="user-inline-avatar d-flex align-items-center">
                            <div class="avatar bg-gray200">
                                <img src="<?= $author['avatar']; ?>" class="img-cover" alt="<?= $author['name']; ?>">
                            </div>
                            <a href="/users/profile/<?= $author['id']; ?>" target="_blank" class="user-name ml-5 font-14 placeholder-glow"><?= $author['name']; ?></a>
                        </div>

                        <div class="stars-card d-flex align-items-center  mt-15">

                            <?= StarsRating($row['stars']); ?>
                        </div>

                        <div class="d-flex justify-content-between mt-auto">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i data-feather="clock" width="20" height="20" class="webinar-icon"></i>
                                    <span class="duration ml-5 font-14">0:35 Hours</span>
                                </div>

                                <div class="vertical-line h-25 mx-15"></div>

                                <div class="d-flex align-items-center">
                                    <i data-feather="calendar" width="20" height="20" class="webinar-icon"></i>
                                    <span class="date-published ml-5 font-14"><?= date('d/m/Y - H:i', $row['created_at']); ?></span>
                                </div>
                            </div>
                            <div class="webinar-price-box d-flex flex-column justify-content-center align-items-center">
                                <?php if ($row['price'] == 0) { ?>
                                    <span class="real font-14"><?= FormatPrice($row['price']); ?></span>
                                <?php } else { ?>
                                    <span class="off ml-10"><?= FormatPrice($row['price'] * 2); ?></span>
                                    <span class="real font-14"><?= FormatPrice($row['price']); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php  } ?>
        <?php
            echo $paging->html_course();
        } else { ?>
            <div class="form-group text-center">
                <img src="https://i.imgur.com/rQCNdgH.png" class="img-fluid mt-25" style="width:20%;">
                <p class="mt-25 text-gray font-weight-bold">Chưa có khóa học nào.</p>
            </div>
        <?php } ?>


    <?php } else {  ?>
        Phương thức không được phép.
        <!-- js -->
        <script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
    <?php } ?>

<?php } ?>