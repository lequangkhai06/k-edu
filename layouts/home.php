<!-- ------- -->
<!-- Loading -->
<div id="preloader">
    <div id="preloader_status" class="flex-column">
        <img src="https://i.imgur.com/daD12T2.png" style="width: 300px;margin-bottom: 50px;" />
        <div class="spinner-border" role="status">
        </div>
    </div>
</div>
<!-- END: Loading -->
<div class="home-swiper-custom">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner rounded-5 shadow-4-strong">
            <div class="carousel-item active">
                <a href="http://" target="_blank" rel="noopener noreferrer">
                    <img data-src="https://i.imgur.com/R5SailP.jpeg" src="https://i.pinimg.com/originals/c7/e1/b7/c7e1b7b5753737039e1bdbda578132b8.gif" class="lazyload d-block w-100">
                </a>
            </div>
            <div class="carousel-item">
                <a href="http://" target="_blank" rel="noopener noreferrer">
                    <img data-src="https://i.imgur.com/MiJvVsh.jpeg" src="https://i.pinimg.com/originals/c7/e1/b7/c7e1b7b5753737039e1bdbda578132b8.gif" class="lazyload d-block w-100">
                </a>
            </div>
            <div class="carousel-item">
                <a href="http://" target="_blank" rel="noopener noreferrer">
                    <img data-src="https://i.imgur.com/v4z3yD1.jpeg" src="https://i.pinimg.com/originals/c7/e1/b7/c7e1b7b5753737039e1bdbda578132b8.gif" class="lazyload d-block w-100">
                </a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <i class="fa-regular fa-chevron-left fa-lg"></i>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <i class="fa-regular fa-chevron-right fa-lg"></i>
        </a>
    </div>
</div>

<section class="home-sections home-sections-swiper container">
    <div class="d-flex justify-content-between">
        <div>
            <h2 class="section-title">Khóa học mới nhất</h2>
            <p class="section-hint">Các khóa học vừa được cập nhật & giảm giá</p>
        </div>

        <a href="/products" class="btn btn-border-white">Xem tất cả...</a>
    </div>

    <div class="mt-10 position-relative">
        <div class="swiper-container new-products-swiper px-12">
            <div class="swiper-wrapper py-20">
                <?php
                $get = $conn->query("SELECT * FROM webinars WHERE type = 'text_lesson' AND status = 'active' ORDER BY id DESC LIMIT 0,8");
                if ($get->num_rows > 0) {
                    while ($row = $get->fetch_array()) {
                        $category = $conn->query("SELECT * FROM categories WHERE id =  '{$row['category_id']}'")->fetch_array();
                        $author = $conn->query("SELECT * FROM users WHERE id =  '{$row['teacher_id']}'")->fetch_array();
                ?>
                        <div class="swiper-slide">
                            <div class="product-card">
                                <figure>
                                    <div class="image-box">
                                        <a href="/course/<?= $row['slug']; ?>" class="image-box__a">
                                            <?php if ($row['discount'] != 0) { ?>
                                                <span class="badge badge-danger">Giảm <?= $row['discount']; ?>%</span>
                                            <?php } elseif ($row['discount'] == 0 && $row['price'] == 0) { ?>
                                                <span class="badge badge-primary">Miễn phí</span>
                                            <?php } ?>
                                            <img data-src="<?= $row['thumbnail']; ?>" src="https://i.imgur.com/fflYdzf.gif" class="img-cover lazyload">
                                        </a>


                                        <div class="hover-card-action">
                                            <button onclick="window.location.href='/course/<?= $row['slug']; ?>'" type="button" class="btn-add-product-to-cart d-flex align-items-center justify-content-center border-0 cursor-pointer">
                                                <i data-feather="eye" width="20" height="20"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <figcaption class="product-card-body">
                                        <div class="user-inline-avatar d-flex align-items-center">
                                            <div class="avatar bg-gray200">
                                                <img src="<?= $author['avatar']; ?>" class="img-cover" alt="<?= $author['name']; ?>">
                                            </div>
                                            <a href="/users/profile/<?= $author['id']; ?>" target="_blank" class="user-name ml-5 font-14"><?= $author['name']; ?></a>
                                        </div>

                                        <a href="/course/<?= $row['slug']; ?>">
                                            <h3 class="mt-15 product-title font-weight-bold font-16 text-dark-blue"><?= $row['title']; ?></h3>
                                        </a>

                                        <?php if (isset($users)) { ?>

                                            <?php if ($base->checkUserCourse($row['id'], $users['id'])) { ?>
                                                <!-- progress -->
                                                <?php $progress = $base->info_course($row['id'], $user_email, 'progress'); ?>
                                                <div class="progress">
                                                    <span class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: <?= $progress; ?>%" aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100"><?= $progress; ?>%</span>
                                                </div>

                                                <!-- end: progress -->

                                            <?php } else { ?>

                                                <div class="progress-hide"></div>


                                            <?php } ?>

                                        <?php } ?>

                                        <span class="d-block font-14 mt-10">Danh Mục: <a href="/categories/<?= ($category['slug']); ?>" target="_blank" class="font-weight-bold"><?= $category['title']; ?></a></span>

                                        <div class="stars-card d-flex align-items-center  mt-15">
                                            <?= StarsRating($row['stars']); ?>
                                        </div>
                                        <?php if ($row['price'] == 0) { ?>
                                            <div class="product-price-box mt-25"><span class="real"><?= FormatPrice($row['price']); ?></span></div>
                                        <?php } else { ?>
                                            <div class="product-price-box mt-25">
                                                <span class="off ml-10"><?= FormatPrice($row['price'] * 2); ?></span>
                                                <span class="real"><?= FormatPrice($row['price']); ?></span>
                                            </div>
                                        <?php } ?>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="swiper-pagination new-products-swiper-pagination"></div>
        </div>
    </div>
</section>

<section class="home-sections home-sections-swiper container">
    <div class="d-flex justify-content-between">
        <div>
            <h2 class="section-title">Đội ngũ giáo viên</h2>
            <p class="section-hint">Đội ngũ giáo viên tiêu biểu</p>
        </div>

        <a href="/instructors" class="btn btn-border-white">Xem tất cả...</a>
    </div>

    <div class="position-relative mt-20">
        <div class="swiper-container organization-swiper-container px-12">
            <div class="swiper-wrapper py-20">
                <?php
                $get = $conn->query("SELECT * FROM users WHERE level = 'instructor' AND stars >= 3 order by stars desc");
                if ($get->num_rows > 0) {
                    while ($row = $get->fetch_array()) {
                ?>
                        <div class="swiper-slide">
                            <div class="home-organizations-card d-flex flex-column align-items-center justify-content-center">
                                <div class="home-organizations-avatar">
                                    <div class="avatar avatar-x-large">
                                        <img src="<?= $row['avatar']; ?>" class="avatar-image img-cover rounded-circle">
                                        <img src="<?= $row['border']; ?>" class="avatar-frame anim-spin">
                                    </div>
                                </div>
                                <a href="/users/profile/<?= $row['id']; ?>" class="mt-25 d-flex flex-column align-items-center justify-content-center">
                                    <div class="mt-4"></div>
                                    <h3 class="home-organizations-title"><?= $row['name']; ?></h3>
                                    <p class="home-organizations-desc mt-10"><?= $row['bio']; ?></p>
                                    <span class="home-organizations-badge badge mt-15">3 Khóa học</span>
                                    <div class="stars-card d-flex align-items-center  mt-15">
                                        <?php
                                        echo StarsRating($row['stars']);
                                        ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
        <style>
            .avatar {
                box-sizing: border-box;
                position: relative;
                border-radius: 50%;
                padding: 4px;
                box-shadow: inset 0 0 0 2px #4D4F6E;
            }

            .avatar-large {
                width: 80px;
                height: 80px;
            }

            .avatar-x-large {
                width: 144px;
                width: 144px;
            }

            .avatar-image {
                max-width: 100%;
                vertical-align: middle;
                border-radius: 50%;
            }

            .avatar-frame {
                position: absolute;
                pointer-events: none;
            }

            .avatar-large .avatar-frame {
                top: -10%;
                left: -10%;
                max-width: 120%;
            }

            .avatar-x-large .avatar-frame {
                top: -12.5%;
                left: -12.5%;
                max-width: 125%;
            }

            .anim-spin {
                animation: spin 30s linear infinite;
            }

            .anim-hue {
                animation: hue 30s linear infinite;
            }

            @keyframes hue {
                100% {
                    filter: hue-rotate(360deg);
                }
            }

            @keyframes spin {
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
        <div class="d-flex justify-content-center">
            <div class="swiper-pagination organization-swiper-pagination"></div>
        </div>
    </div>
</section>