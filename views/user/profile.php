<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
$id = $_GET['id'];
$profile = $conn->query("SELECT * FROM users WHERE id = '{$id}'", 1)->fetch_array();
if (!$profile) {
    die('<script>location.href="/home"</script>');
}
?>
<section class="site-top-banner position-relative">
    <img src="https://i.imgur.com/F9GwjDM.jpg" class="img-cover" alt="" />
</section>


<section class="container">
    <div class="rounded-lg shadow-sm px-25 py-20 px-lg-50 py-lg-35 position-relative user-profile-info bg-white">
        <div class="profile-info-box d-flex align-items-start justify-content-between">
            <div class="user-details d-flex align-items-center">
                <div class="user-profile-avatar bg-gray200">
                    <img src="<?= $profile['avatar']; ?>" class="img-cover" alt="Ricardo dave" />
                    <?php if ($profile['verified'] == 1) { ?>
                        <span class="user-circle-badge has-verified d-flex align-items-center justify-content-center">
                            <i data-feather="check" width="20" height="20" class="text-white"></i>
                        </span>
                    <?php } else { ?>
                        <span class="user-circle-badge unavailable d-flex align-items-center justify-content-center">
                            <i data-feather="slash" width="20" height="20" class="text-white"></i>
                        </span>
                    <?php } ?>
                </div>
                <div class="ml-20 ml-lg-40">
                    <h1 class="font-24 font-weight-bold text-dark-blue"><?= $profile['name']; ?></h1>
                    <span class="text-gray"></span>

                    <div class="stars-card d-flex align-items-center mt-5">
                        <div class="stars-card d-flex align-items-center  mt-15">

                            <?= StarsRating($profile['stars']); ?>
                        </div>
                    </div>

                    <div class="user-reward-badges d-flex flex-wrap align-items-center mt-15">
                        <div class="mr-15" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Old Membership">
                            <img src="/store/1/default_images/badges/faithful_user.png" width="32" height="32" alt="Faithful User">
                        </div>
                        <div class="mr-15" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Has 1 Class">
                            <img src="/store/1/default_images/badges/junior_vendor.png" width="32" height="32" alt="Junior Vendor">
                        </div>
                        <div class="mr-15" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Classes Rating from 4 to 5">
                            <img src="/store/1/default_images/badges/golden_classes.png" width="32" height="32" alt="Golden Classes">
                        </div>
                        <div class="mr-15" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Classes Sales from 3 to 9">
                            <img src="/store/1/default_images/badges/top_seller.png" width="32" height="32" alt="Top Seller">
                        </div>
                        <div class="mr-15" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Support Rating from 4 to 5">
                            <img src="/store/1/default_images/badges/fantastic_support.png" width="32" height="32" alt="Fantastic Support">
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-actions d-flex flex-column">
                <button type="button" id="followToggle" data-user-id="1016" class="btn btn-primary btn-sm">
                    Contact Email
                </button>

            </div>
        </div>

        <div class="mt-40 border-top"></div>

        <div class="row mt-30 w-100 d-flex align-items-center justify-content-around">
            <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                <div class="state-icon orange p-15 rounded-lg">
                    <img src="/assets/default/img/profile/students.svg" alt="">
                </div>
                <span class="font-20 text-dark-blue font-weight-bold mt-5">4</span>
                <span class="font-14 text-gray">Students</span>
            </div>

            <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                <div class="state-icon blue p-15 rounded-lg">
                    <img src="/assets/default/img/profile/webinars.svg" alt="">
                </div>
                <span class="font-20 text-dark-blue font-weight-bold mt-5"><?= $base->Count_Rows('webinars', "teacher_id = '{$profile['id']}'"); ?></span>
                <span class="font-14 text-gray">Khóa học</span>
            </div>

            <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center">
                <div class="state-icon green p-15 rounded-lg">
                    <img src="/assets/default/img/profile/reviews.svg" alt="">
                </div>
                <span class="font-20 text-dark-blue font-weight-bold mt-5">3</span>
                <span class="font-14 text-gray">Reviews</span>
            </div>


            <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center">
                <div class="state-icon royalblue p-15 rounded-lg">
                    <img src="/assets/default/img/profile/appointments.svg" alt="">
                </div>
                <span class="font-20 text-dark-blue font-weight-bold mt-5">0</span>
                <span class="font-14 text-gray">Meetings</span>
            </div>

        </div>
    </div>
</section>

<div class="container mt-30">
    <section class="rounded-lg border px-10 pb-35 pt-5 position-relative">
        <ul class="nav nav-tabs d-flex align-items-center px-20 px-lg-50 pb-15" id="tabs-tab" role="tablist">
            <li class="nav-item mr-20 mr-lg-50 mt-30">
                <a class="position-relative text-dark-blue font-weight-500 font-16 active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">Thông tin cơ bản</a>
            </li>
            <li class="nav-item mr-20 mr-lg-50 mt-30">
                <a class="position-relative text-dark-blue font-weight-500 font-16 " id="webinars-tab" data-toggle="tab" href="#webinars" role="tab" aria-controls="webinars" aria-selected="false">Khóa học</a>
            </li>

            <li class="nav-item mr-20 mr-lg-50 mt-30">
                <a class="position-relative text-dark-blue font-weight-500 font-16 " id="badges-tab" data-toggle="tab" href="#badges" role="tab" aria-controls="badges" aria-selected="false">Danh hiệu</a>
            </li>
        </ul>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade px-20 px-lg-50 show active" id="about" role="tabpanel" aria-labelledby="about-tab">

                <div class="mt-40">
                    <h3 class="font-16 text-dark-blue font-weight-bold">Liên hệ</h3>

                    <ul class="list-group-custom">
                        <li class="mt-15 text-gray font-weight-bold">Loại tài khoản: <?= UserLevel($profile['level']); ?></li>
                        <li class="mt-15 text-gray font-weight-bold">Địa chỉ email: <?= $profile['email']; ?></li>
                        <li class="mt-15 text-gray font-weight-bold">Số điện thoại cá nhân: <?= $profile['mobile']; ?></li>
                        <li class="mt-15 text-gray font-weight-bold">Địa chỉ: <?= $profile['address']; ?></li>
                    </ul>
                </div>

                <div class="mt-40">
                    <h3 class="font-16 text-dark-blue font-weight-bold">Giới thiệu bản thân</h3>

                    <div class="mt-30">
                        <?= $profile['bio']; ?>
                    </div>
                </div>

                <div class="mt-40">
                    <h3 class="font-16 text-dark-blue font-weight-bold">Kỹ năng</h3>

                    <div class="d-flex flex-wrap align-items-center pt-10">
                        <div class="bg-gray200 font-14 rounded mt-10 px-10 py-5 text-gray mr-15">Design</div>
                        <div class="bg-gray200 font-14 rounded mt-10 px-10 py-5 text-gray mr-15">Web Development</div>
                        <div class="bg-gray200 font-14 rounded mt-10 px-10 py-5 text-gray mr-15">Mobile Development</div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="webinars" role="tabpanel" aria-labelledby="webinars-tab">
                <div class="mt-20 row">
                    <?php
                    $get = $conn->query("SELECT * FROM webinars WHERE type = 'text_lesson' AND status = 'active' AND teacher_id = '{$profile['id']}'  ORDER BY id DESC");
                    if ($get->num_rows > 0) {
                        while ($row = $get->fetch_array()) {
                            $category = $conn->query("SELECT * FROM categories WHERE id =  '{$row['category_id']}'")->fetch_array();
                            $author = $conn->query("SELECT * FROM users WHERE id =  '{$row['teacher_id']}'")->fetch_array();
                    ?>

                            <div class="col-lg-4 mt-20">
                                <div class="webinar-card">
                                    <figure>
                                        <div class="image-box">
                                            <?php if ($row['discount'] != 0) { ?>
                                                <span class="badge badge-danger">Giảm <?= $row['discount']; ?>%</span>
                                            <?php } elseif ($row['discount'] == 0 && $row['price'] == 0) { ?>
                                                <span class="badge badge-primary">Miễn phí</span>
                                            <?php } ?>

                                            <a href="/course/<?= $row['slug']; ?>">
                                                <img src="<?= $row['thumbnail']; ?>" class="img-cover">
                                            </a>

                                        </div>

                                        <figcaption class="webinar-card-body">
                                            <a href="/course/<?= $row['slug']; ?>">
                                                <h3 class="mt-15 webinar-title font-weight-bold font-16 text-dark-blue"><?= $row['title']; ?></h3>
                                            </a>

                                            <span class="d-block font-14 mt-10">Danh Mục: <a href="/categories/<?= ($category['slug']); ?>" target="_blank" class="font-weight-bold"><?= $category['title']; ?></a></span>

                                            <div class="stars-card d-flex align-items-center  mt-15">
                                                <?= StarsRating($row['stars']); ?>
                                            </div>

                                            <div class="d-flex justify-content-between mt-20">
                                                <div class="d-flex align-items-center">
                                                    <i data-feather="calendar" width="20" height="20" class="webinar-icon"></i>
                                                    <span class="date-published font-14 ml-5"><?= date('d/m/Y', $row['created_at']); ?></span>
                                                </div>
                                            </div>
                                            <?php if ($row['price'] == 0) { ?>
                                                <div class="webinar-price-box mt-25"><span class="real"><?= FormatPrice($row['price']); ?></span></div>
                                            <?php } else { ?>
                                                <div class="webinar-price-box mt-25">
                                                    <span class="off ml-10"><?= FormatPrice($row['price'] * 2); ?></span>
                                                    <span class="real font-14"><?= FormatPrice($row['price']); ?></span>
                                                </div>
                                            <?php } ?>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>

                    <?php }
                    } ?>
                </div>
            </div>

            <div class="tab-pane fade" id="badges" role="tabpanel" aria-labelledby="badges-tab">
                <div class="user-reward-badges badges-lg row align-items-center mt-10 mt-lg-20">


                    <div class="col-6 col-lg-3 mt-20 mt-lg-0">
                        <div class="rounded-lg badges-item py-20 py-lg-40 shadow-sm px-10 px-lg-25 d-flex flex-column align-items-center">
                            <img src="/store/1/default_images/badges/faithful_user.png" class="rounded-circle" alt="Faithful User">

                            <span class="font-16 font-weight-bold text-dark-blue mt-15 mt-lg-25">Faithful User</span>
                            <span class="font-14 text-gray mt-5 mt-lg-10 text-center">Old Membership</span>
                        </div>
                    </div>


                    <div class="col-6 col-lg-3 mt-20 mt-lg-0">
                        <div class="rounded-lg badges-item py-20 py-lg-40 shadow-sm px-10 px-lg-25 d-flex flex-column align-items-center">
                            <img src="/store/1/default_images/badges/junior_vendor.png" class="rounded-circle" alt="Junior Vendor">

                            <span class="font-16 font-weight-bold text-dark-blue mt-15 mt-lg-25">Junior Vendor</span>
                            <span class="font-14 text-gray mt-5 mt-lg-10 text-center">Has 1 Class</span>
                        </div>
                    </div>


                    <div class="col-6 col-lg-3 mt-20 mt-lg-0">
                        <div class="rounded-lg badges-item py-20 py-lg-40 shadow-sm px-10 px-lg-25 d-flex flex-column align-items-center">
                            <img src="/store/1/default_images/badges/golden_classes.png" class="rounded-circle" alt="Golden Classes">

                            <span class="font-16 font-weight-bold text-dark-blue mt-15 mt-lg-25">Golden Classes</span>
                            <span class="font-14 text-gray mt-5 mt-lg-10 text-center">Classes Rating from 4 to 5</span>
                        </div>
                    </div>


                    <div class="col-6 col-lg-3 mt-20 mt-lg-0">
                        <div class="rounded-lg badges-item py-20 py-lg-40 shadow-sm px-10 px-lg-25 d-flex flex-column align-items-center">
                            <img src="/store/1/default_images/badges/top_seller.png" class="rounded-circle" alt="Top Seller">

                            <span class="font-16 font-weight-bold text-dark-blue mt-15 mt-lg-25">Top Seller</span>
                            <span class="font-14 text-gray mt-5 mt-lg-10 text-center">Classes Sales from 3 to 9</span>
                        </div>
                    </div>


                    <div class="col-6 col-lg-3 mt-20 mt-lg-0">
                        <div class="rounded-lg badges-item py-20 py-lg-40 shadow-sm px-10 px-lg-25 d-flex flex-column align-items-center">
                            <img src="/store/1/default_images/badges/fantastic_support.png" class="rounded-circle" alt="Fantastic Support">

                            <span class="font-16 font-weight-bold text-dark-blue mt-15 mt-lg-25">Fantastic Support</span>
                            <span class="font-14 text-gray mt-5 mt-lg-10 text-center">Support Rating from 4 to 5</span>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>
</div>

<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');

?>