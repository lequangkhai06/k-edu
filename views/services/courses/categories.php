<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
$slug = $_GET['slug'];
$categories = $conn->query("SELECT * FROM categories WHERE slug = '{$slug}'", 1)->fetch_array();
if (!$categories) {
    die('<script>location.href="/home"</script>');
}
$get = $conn->query("SELECT * FROM webinars WHERE type = 'text_lesson' AND category_id = '{$categories['id']}' ORDER BY id DESC");
$count = $get->num_rows;
?>
<form class="container mt-30">
    <section class="mt-lg-50 pt-lg-20 mt-md-40 pt-md-40">
        <div>
            <div id="topFilters" class="shadow-lg border border-gray300 rounded-sm p-10 p-md-20">
                <div class="row align-items-center">
                    <div class="col-lg-6 d-flex align-items-center">
                        <select id="sort" class="form-control font-14" onchange="fitler_course()"<?php if ($count ==0) {echo 'disabled';} ?>>
                            <option disabled selected>Sắp xếp theo</option>
                            <option value="">Mặc định</option>
                            <option value="newest">Mới nhất</option>
                            <option value="expensive">Giá cao tới thấp</option>
                            <option value="inexpensive">Giá thấp tới cao</option>
                            <option value="bestsellers">Bán chạy nhất</option>
                        </select>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <select id="price" class="form-control font-14" onchange="fitler_course()"<?php if ($count ==0) {echo 'disabled';} ?>>
                            <option disabled selected>Tìm theo giá</option>
                            <option value="0">Mặc định</option>
                            <option value="1">Từ 100,000đ trở xuống</option>
                            <option value="2">100,000đ - 400,000đ</option>
                            <option value="3">400,000đ - 800,000đ</option>
                            <option value="4">800,000đ - 1,000,000đ</option>
                            <option value="5">Từ 1,000,000đ trở lên</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-20"> 
                <div class="col-12 col-lg-8">
                    <div id="loading" class="mt-20"> 
                        <div class="loading-icon"></div> 
                    </div>
                    <div class="list_course">
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">
                        <div class="input-group">
                            <input type="search" id="char" onchange="fitler_course()" autocomplete="off" class="form-control rounded" placeholder="Tìm kiếm từ khóa..." <?php if ($count == 0) {echo 'disabled';} ?>/>
                        </div>

                        <button type="reset" onclick="clear_fitler()" class="btn btn-sm btn-primary btn-block mt-30" <?php if ($count == 0) {echo 'disabled';} ?>>Xóa lọc</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<script>
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    page = 1;
    char = "";
    price = "";
    sort = "";
    slug = "<?php echo $slug; ?>";
    // tai khoa hoc
    function load_course() {
        $("#loading").show();
        $(".list_course").hide();
        $.post("<?= $domain; ?>model/categories/data.php", {
                page: page,
                char: char,
                price: price,
                sort: sort,
                slug: slug
            })
            .done(function(data) {
                Toastify({
                    text: "Tải dữ liệu thành công!",
                    duration: 1000,
                    newWindow: true,
                    close: false,
                    gravity: "bottom", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function(){
                    } // Callback after click
                }).showToast();
                $("#loading").hide();
                $(".list_course").html('');
                $('.list_course').empty().append(data);
                $(".list_course").show();
            });
    }
    // xoa loc
    function clear_fitler() {
        page = 1;
        char = price = sort = "";
        $("#char, #price", "#sort").val('0');
        load_course();
    }
    // loc khoa hoc
    function fitler_course() {
        char = $("#char").val();
        price = $("#price").val();
        sort = $("#sort").val();
        load_course();
    }
    load_course();
</script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');
?>