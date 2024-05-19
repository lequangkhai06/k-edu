<footer class="footer bg-dark position-relative user-select-none" style="background: linear-gradient(284.28deg,#1D4350 30%,#2c146c 70%); border-radius: 15px 15px 0 0;" id="footer">
    <div class="container">
        <div class="mt-40 py-25 d-flex align-items-center justify-content-between">
            <div class="footer-logo">
                <a href="/">
                    <img data-src="https://i.imgur.com/20yb0Kn.png" class="lazy img-cover">
                    <div class="mt-2"></div>
                    <p class="text-white text-center">Hệ thống học tập online.</p>
                </a>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <span class="header d-block text-white font-weight-bold">PHƯƠNG THỨC THANH TOÁN</span>
                    <!-- <small>Tất cả tiến trình thanh toán hoàn toàn tự động</small> -->
                    <div class="mt-20">
                        <p>
                            <font color="#ffffff">
                                <img src="https://i.imgur.com/8e5cahl.png" class="mr-5" width="35" height="35"> VNPAY
                            </font>
                        </p>
                        <div class="mt-2"></div>
                        <p>
                            <font color="#ffffff">
                                <img src="/assets//default//img//icons/momo.png" class="mr-5" width="32" height="32"> MOMO
                            </font>
                        </p>
                        <div class="mt-2"></div>
                        <p>
                            <font color="#ffffff">
                                <img src="https://i.imgur.com/1DcFqZv.png" class="mr-5" width="32" height="32"> THẺ CÀO
                            </font>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <span class="header d-block text-white font-weight-bold">KẾT NỐI</span>
                    <div class="mt-20">
                        <a href="https://zalo.me/" target="_blank">
                            <font color="#ffffff">
                                <img src="https://i.imgur.com/xLJLNnG.png" class="mr-5" width="35" height="35"> ZALO
                            </font>
                        </a>
                        <div class="mt-2"></div>
                        <a href="https://www.facebook.com/kedu.lms" target="_blank">
                            <font color="#ffffff">
                                <img src="https://i.imgur.com/EeYrQ9y.png" class="mr-5" width="32" height="32"> FANPAGE
                            </font>
                        </a>
                        <div class="mt-2"></div>
                        <a href="//youtube.com/" target="_blank">
                            <font color="#ffffff">
                                <img src="https://i.imgur.com/OyNGIG6.png" class="mr-5" width="32" height="32"> YOUTUBE
                            </font>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright-card">
        <div class="container d-flex align-items-center justify-content-between py-15">
            <div class="font-14 text-white">&copy; 2023 - Designed by <strong class="animate-text">Khai</strong></div>

            <div class="d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center text-white font-14">
                    <i data-feather="phone" width="20" height="20" class="mr-5"></i>
                    0387290xxx
                </div>

                <div class="border-left mx-5 mx-lg-15 h-100"></div>

                <div class="d-flex align-items-center text-white font-14">
                    <i data-feather="map-pin" width="20" height="20" class="mr-10"></i>
                    Đắk Nông - Việt Nam
                </div>
            </div>
        </div>
    </div>
    <!-- Back To Top -->
    <button type="button" id="backtotop" class="tw-h-10 tw-w-10 tw-fixed tw-rounded tw-text-2xl tw-text-white tw-rounded-full tw-flex tw-items-center tw-justify-center btn-sm btn btn-primary rounded-pill BackToTop" style="right: 2%; bottom: 45px; z-index: 1000; border-radius: 15px !important;">
        <i class="bx bx-up-arrow-alt"></i>
    </button>

    <!-- <div class="d-none" id="advertisingModalSettings">
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="section-title font-16 text-dark-blue mb-10">Sales Campaign</h3>

            <button type="button" class="btn-close-advertising-modal close-swl btn-transparent d-flex">
                <i data-feather="x" width="25" height="25" class=""></i>
            </button>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            <img src="/store/1/default_images/ads_modal.png" class="img-fluid rounded-lg" alt="Sales Campaign">
        </div>

        <p class="font-14 text-gray mt-20">We have a sales campaign on our promoted courses and products. You can purchase 150 products at a discounted price up to 50% discount.</p>

        <div class="row align-items-center mt-20">
            <div class="col-6">
                <a href="classes.html" class="btn btn-primary btn-sm btn-block">View Courses</a>
            </div>

            <div class="col-6">
                <a href="products.html" class="btn btn-outline-primary btn-sm btn-block">View Products</a>
            </div>
        </div>
    </div> -->
    </div>
    <!-- Template JS File -->
    <script src="/assets/default/js/app.js"></script>
    <script src="/assets/default/vendors/toast/jquery.toast.min.js"></script>
    <script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
    <script src="/assets/default/vendors/moment.min.js"></script>
    <script type="text/javascript" src="/assets/default/vendors/simplebar/simplebar.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $(window).on('load', function() {
            $('#preloader_status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
            $('body').delay(350);
            $(window).scrollTop(0);
        });
        $(window).scroll(function() {
            if ($(this).scrollTop()) {
                $('.BackToTop').fadeIn();
            } else {
                $('.BackToTop').fadeOut();
            }
        });

        $(".BackToTop").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 1000);
        });
        var clipboard = new ClipboardJS('.fa-clone');
        clipboard.on('success', function(e) {
            Toastify({
                text: "Đã sao chép!",
                duration: 1500,
                newWindow: true,
                close: false,
                gravity: "top",
                position: "center",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function() {}
            }).showToast();
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            alert('Không thể sao chép nội dung!');
        });
        $('.carousel').carousel();

        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

            if ("IntersectionObserver" in window) {
                var lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            var lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            }
        });

        function changeLanguage() {
            alert('Website chỉ hỗ trợ ngôn ngữ: tiếng Việt')
        }

        $(document).ready(function() {
            $('select').select2({
                placeholder: '-- Vui lòng chọn --'
            });
        });
        // validation messages
        jQuery.extend(jQuery.validator.messages, {
            required: "Vui lòng điền trường này.",
            remote: "Vui lòng sửa phạm vi này.",
            email: "Vui lòng nhập địa chỉ email hợp lệ.",
            url: "Vui lòng nhập một URL hợp lệ.",
            date: "Vui lòng nhập thời gian hợp lệ.",
            dateISO: "Vui lòng nhập ngày hợp lệ (ISO).",
            number: "Vui lòng nhập một số hợp lệ.",
            digits: "Vui lòng chỉ nhập chữ số.",
            creditcard: "Vui lòng nhập số thẻ tín dụng hợp lệ.",
            equalTo: "Vui lòng nhập lại cùng một giá trị.",
            accept: "Vui lòng nhập một giá trị có phần mở rộng hợp lệ.",
            maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
            minlength: jQuery.validator.format("Please enter at least {0} characters."),
            rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
            range: jQuery.validator.format("Please enter a value between {0} and {1}."),
            max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
            min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
        });
    </script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/default/vendors/owl-carousel2/owl.carousel.min.js"></script>
    <script src="/assets/default/js/parts/home.min.js"></script>
    <script src="/assets/default/js/parts/navbar.min.js"></script>
    <script src="/assets/default/js/parts/main.min.js"></script>
    </body>

    </html>