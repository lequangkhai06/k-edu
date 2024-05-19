<div id="app">

    <div class="top-navbar d-flex border-bottom" id="top-navbar">
        <div class="container d-flex justify-content-between flex-column flex-lg-row">
            <div class="top-contact-box border-bottom d-flex flex-column flex-md-row align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-between justify-content-md-center">
                    <div class="js-currency-select custom-dropdown position-relative">
                        <form>

                            <div class="custom-dropdown-toggle d-flex align-items-center cursor-pointer">
                                <div class="mr-5 text-secondary">
                                    <span class="js-lang-title font-14">VND (đ)</span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <form class="mr-15 mx-md-20">
                        <div class="language-select">
                            <div>
                                <button type="button" onclick="changeLanguage('vi')" class="btn btn-default btn-sm"><img src="https://i.imgur.com/17fJve5.png" width="25" height="27" class="mr-5">Tiếng Việt<span class="caret" style="margin-left: 5px;"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="xs-w-100 d-flex align-items-center justify-content-between ">
                <div class="d-flex">
                    <div class="dropdown">
                        <button type="button" class="btn btn-transparent dropdown-toggle" id="navbarNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell" width="20" height="20" class="mr-10"></i>

                            <span class="badge badge-circle-danger d-flex align-items-center justify-content-center">57</span>
                        </button>

                        <div class="dropdown-menu pt-20" aria-labelledby="navbarNotification">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-auto navbar-notification-card" data-simplebar>
                                    <div class="d-md-none border-bottom mb-20 pb-10 text-right">
                                        <i class="close-dropdown" data-feather="x" width="32" height="32" class="mr-10"></i>
                                    </div>


                                    <div class="d-flex align-items-center p-15 border rounded-sm">
                                        <div class="d-flex-center size-40 rounded-circle bg-gray100">
                                            <i data-feather="bell" width="20" height="20" class="text-gray"></i>
                                        </div>
                                        <div class="ml-5">
                                            <div class="text-secondary font-14"><span class="font-weight-bold">57</span> Thông báo</div>

                                            <a href="/panel/notifications/mark-all-as-read" class="delete-action d-block mt-5 font-12 cursor-pointer text-hover-primary" data-title="Convert unread messages to read" data-confirm="Yes; Mark all as read!">
                                                Đánh dấu đã đọc.
                                            </a>
                                        </div>
                                    </div>

                                    <a href="/panel/notifications?notification=2191">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request approved</h4>
                                            <span class="notify-at d-block mt-5">3 Jun 2023 | 05:04</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2185">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">3 Jun 2023 | 05:04</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2186">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">3 Jun 2023 | 05:04</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2187">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request submitted</h4>
                                            <span class="notify-at d-block mt-5">3 Jun 2023 | 05:04</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2189">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">You got cashback!</h4>
                                            <span class="notify-at d-block mt-5">3 Jun 2023 | 05:04</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2183">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment request submitted</h4>
                                            <span class="notify-at d-block mt-5">3 Jun 2023 | 05:03</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2182">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">17 Mar 2023 | 18:50</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2160">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request approved</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 06:12</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2149">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 06:03</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2150">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 06:03</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2151">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request submitted</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 06:03</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2147">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment request submitted</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 06:03</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2143">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 05:38</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2144">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New user registered with your affiliate code</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 05:38</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2133">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 05:26</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2134">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New user registered with your affiliate code</h4>
                                            <span class="notify-at d-block mt-5">16 Mar 2023 | 05:26</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2118">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">You got cashback!</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:20</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2114">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:20</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2115">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:20</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2116">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment paid successfully</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:20</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2113">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request approved</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2107">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2108">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2109">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request submitted</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2111">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">You got cashback!</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2105">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment request submitted</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 20:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2077">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 19:24</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2078">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 19:24</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2079">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment paid successfully</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 19:24</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2081">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">You got cashback!</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 19:24</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2068">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New reward point</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 18:30</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2064">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">You received a gift</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 18:30</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2053">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request approved</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 17:25</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2050">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 17:24</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2051">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment verification request submitted</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 17:24</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2047">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Installment request submitted</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 17:23</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2019">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Upcoming course published and is accessible</h4>
                                            <span class="notify-at d-block mt-5">15 Mar 2023 | 15:30</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=2007">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Certificate</h4>
                                            <span class="notify-at d-block mt-5">1 Jul 2022 | 04:40</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1998">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">27 Jun 2022 | 05:37</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1989">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">25 Jun 2022 | 05:20</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1988">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">25 Jun 2022 | 05:19</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1987">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">new badge</h4>
                                            <span class="notify-at d-block mt-5">25 Jun 2022 | 05:17</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1964">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">24 Jun 2022 | 16:50</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1902">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">new badge</h4>
                                            <span class="notify-at d-block mt-5">19 Jun 2022 | 01:50</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1866">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Offline payment submitted</h4>
                                            <span class="notify-at d-block mt-5">4 Mar 2022 | 11:58</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1860">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New badge</h4>
                                            <span class="notify-at d-block mt-5">4 Mar 2022 | 11:44</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1811">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New badge</h4>
                                            <span class="notify-at d-block mt-5">4 Mar 2022 | 07:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1781">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">4 Mar 2022 | 02:34</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1778">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New purchase completed</h4>
                                            <span class="notify-at d-block mt-5">4 Mar 2022 | 02:34</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1779">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New meeting request</h4>
                                            <span class="notify-at d-block mt-5">4 Mar 2022 | 02:34</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1769">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New badge</h4>
                                            <span class="notify-at d-block mt-5">3 Mar 2022 | 05:18</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1695">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New financial document</h4>
                                            <span class="notify-at d-block mt-5">1 Mar 2022 | 17:01</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1694">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New purchase completed</h4>
                                            <span class="notify-at d-block mt-5">1 Mar 2022 | 17:01</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1636">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New badge</h4>
                                            <span class="notify-at d-block mt-5">28 Oct 2021 | 04:03</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1630">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">New badge</h4>
                                            <span class="notify-at d-block mt-5">27 Oct 2021 | 16:21</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1612">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Offline payment approved</h4>
                                            <span class="notify-at d-block mt-5">11 Aug 2021 | 13:53</span>
                                        </div>
                                    </a>
                                    <a href="/panel/notifications?notification=1611">
                                        <div class="navbar-notification-item border-bottom">
                                            <h4 class="font-14 font-weight-bold text-secondary">Offline payment approved</h4>
                                            <span class="notify-at d-block mt-5">11 Aug 2021 | 13:52</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="mt-10 navbar-notification-action">
                                    <a href="#" class="btn btn-sm btn-danger btn-block">Xem tất cả thông báo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!isset($_COOKIE['AUTH'])) { ?>
                    <div class="d-flex align-items-center ml-md-50">
                        <a href="/login" class="font-weight-bold py-5 px-10 mr-10 text-dark-blue font-14">Đăng nhập</a>
                        <a href="/register" class="font-weight-bold py-5 px-10 text-dark-blue font-14">Đăng ký</a>
                    </div>
            </div>
        </div>
    </div>

<?php } else { ?>

    <div class="custom-dropdown navbar-auth-user-dropdown position-relative ml-50">
        <div class="custom-dropdown-toggle d-flex align-items-center navbar-user cursor-pointer">
            <img src="<?= $users['avatar']; ?>" class="rounded-circle" alt="<?= $users['name']; ?>">
            <span class="font-16 user-name ml-10 text-dark-blue font-14"><?= $users['name']; ?></span>
        </div>

        <div class="custom-dropdown-body pb-10">

            <div class="dropdown-user-avatar d-flex align-items-center p-15 m-15 mb-10 rounded-sm border">
                <div class="size-40 rounded-circle position-relative">
                    <img src="<?= $users['avatar']; ?>" class="img-cover rounded-circle" alt="<?= $users['name']; ?>">
                </div>

                <div class="ml-5">
                    <div class="font-14 font-weight-bold text-secondary"><?= $users['name']; ?></div>
                    <span class="mt-5 text-black font-12"><?= $user_email; ?></span><br>
                    <span class="mt-5 text-black font-12"><?= UserLevel($users['level']); ?></span><br>
                    <span class="mt-5 font-12 text-danger font-weight-bold"><?= number_format($users['coins']); ?> Coins</span>
                </div>
            </div>

            <ul class="my-8">
                <li class="navbar-auth-user-dropdown-item">
                    <a href="/panel" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                        <img src="/assets/default/img/icons/user_menu/dashboard.png" class="icons">
                        <span class="ml-5">Bảng điều khiển</span>
                    </a>
                </li>


                <li class="navbar-auth-user-dropdown-item">
                    <a href="/panel/my-courses" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                        <img src="/assets/default/img/icons/user_menu/my_courses.png" class="icons">
                        <span class="ml-5">Khóa học của tôi</span>
                    </a>
                </li>


                <li class="navbar-auth-user-dropdown-item">
                    <a href="/panel/support" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                        <img src="/assets/default/img/icons/user_menu/support.png" class="icons">
                        <span class="ml-5">Hỗ trợ</span>
                    </a>
                </li>

                <li class="navbar-auth-user-dropdown-item">
                    <a href="/payment/card" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                        <img src="/assets/default/img/icons/user_menu/recharge.png" class="icons">
                        <span class="ml-5">Nạp tiền</span>
                    </a>
                </li>

                <li class="navbar-auth-user-dropdown-item">
                    <a href="/panel/setting" class="d-flex align-items-center w-100 px-15 py-10 text-gray font-14 bg-transparent">
                        <img src="/assets/default/img/icons/user_menu/settings.png" class="icons">
                        <span class="ml-5">Cài đặt</span>
                    </a>
                </li>

                <li class="navbar-auth-user-dropdown-item">
                    <a href="/logout" class="d-flex align-items-center w-100 px-15 py-10 text-danger font-14 bg-transparent">
                        <img src="/assets/default/img/icons/user_menu/logout.png" class="icons">
                        <span class="ml-5">Đăng xuất</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>
</div>
</div>
</div>


<?php } ?>
<div id="navbarVacuum"></div>
<nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a class="navbar-brand navbar-order d-flex align-items-center justify-content-center mr-0 " href="/home">
                <img src="https://i.imgur.com/daD12T2.png" class="img-cover" alt="site logo">
            </a>

            <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent">
                <div class="navbar-toggle-header text-right d-lg-none">
                    <button class="btn-transparent" id="navbarClose">
                        <i data-feather="x" width="32" height="32"></i>
                    </button>
                </div>

                <ul class="navbar-nav mr-auto d-flex align-items-center">
                    <li class="mr-lg-25">
                        <div class="menu-category">
                            <ul>
                                <li class="cursor-pointer user-select-none d-flex xs-categories-toggle">
                                    <i data-feather="grid" width="20" height="20" class="mr-10 d-none d-lg-block"></i>
                                    Danh Mục
                                    <ul class="cat-dropdown-menu">
                                        <?php
                                        $get = $conn->query("SELECT * FROM categories WHERE parent_id = 0 ORDER BY id DESC");
                                        if ($get->num_rows > 0) {
                                            while ($row = $get->fetch_array()) {
                                        ?>
                                                <li>
                                                    <a href="#">
                                                        <div class="d-flex align-items-center">
                                                            <img src="/store/1/default_images/categories_icons/code.png" class="cat-dropdown-menu-icon mr-10">
                                                            <?= $row['title']; ?>
                                                        </div>

                                                        <i data-feather="chevron-right" width="20" height="20" class="d-none d-lg-inline-block ml-10"></i>
                                                        <i data-feather="chevron-down" width="20" height="20" class="d-inline-block d-lg-none"></i>
                                                    </a>

                                                    <ul class="sub-menu" data-simplebar>
                                                        <?php
                                                        $child = $conn->query("SELECT * FROM categories WHERE parent_id = '{$row["id"]}' ORDER BY id DESC");
                                                        if ($child->num_rows > 0) {
                                                            while ($child_row = $child->fetch_array()) { ?>
                                                                <li>
                                                                    <a href="/categories/<?= ($child_row['slug']); ?>">
                                                                        <img src="/store/1/default_images/categories_icons/sub_categories/layout.png" class="cat-dropdown-menu-icon mr-10">

                                                                        <?= $child_row['title']; ?>
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        } else { ?>
                                                            <li>
                                                                <a href="#">
                                                                    Không có danh mục nào.
                                                                </a>
                                                            </li>

                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                        <?php }
                                        } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/home">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/courses">Khóa học</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/instructor">Giáo viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/forums">Diễn đàn</a>
                    </li>
                </ul>
            </div>

            <div class="nav-icons-or-start-live navbar-order">
                <?php if (!isset($_COOKIE['AUTH'])) {  ?>
                    <a href="/login" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn btn-cs">
                        Bắt đầu học
                    </a>

                    <a href="/login" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                        Bắt đầu học
                    </a>

                <?php } elseif ($users['level'] == 'member') { ?>
                    <a href="/become-instructor" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
                        Đăng khoá học
                    </a>

                    <a href="/become-instructor" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                        Đăng khoá học
                    </a>
                <?php } elseif ($users['level'] == 'instructor') { ?>
                    <a href="/become-instructor" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
                        Tạo khóa học mới
                    </a>

                    <a href="/become-instructor" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                        Tạo khóa học mới
                    </a>
                <?php } else { ?>
                    <a href="/admin" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
                        AdminPanel
                    </a>

                    <a href="/admin" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                        AdminPanel
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>