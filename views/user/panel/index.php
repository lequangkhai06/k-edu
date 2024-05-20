<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/views/user/panel/right_menu.php');
if (!isset($users)) {
    die('<script>location.href="/login"</script>');
}
$action = isset($_GET["action"]) ? $_GET["action"] : '';
$filePath = '/views/user/panel/' . $action . '.php';
$default = '/views/user/panel/dashboard.php';
if (file_exists($filePath)) {
    require $root . $filePath;
} else {
    require $root . $default;
}
?>
</div>
</div>
<!-- Template JS File -->
<script src="/assets/default/js/app.js"></script>
<script src="/assets/default/vendors/moment.min.js"></script>
<script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/assets/default/vendors/toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="/assets/default/vendors/simplebar/simplebar.min.js"></script>
<script src="/assets/default/vendors/apexcharts/apexcharts.min.js"></script>
<script src="/assets/default/vendors/chartjs/chart.min.js"></script>
<!-- datatables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap4.js"></script>

<script>
    $('#datatable').DataTable();
    $('#datatable2').DataTable();
    $(document).ready(function() {
        $('#footer').addClass("hide-element");
        $('#top-navbar').addClass("hide-element");
    });
    var offlineSuccess = 'Your status changed successfully!';
    var $chartDataMonths = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var $chartData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
</script>

<script src="/assets/default/js/panel/dashboard.min.js"></script>
<script src="/assets/default/js/parts/navbar.min.js"></script>

<script src="/assets/default/js//parts/main.min.js"></script>
<script src="/assets/default/js/panel/public.min.js"></script>
<!-- <script src="/assets/default/js/parts/content_delete.min.js"></script> -->
<!-- <script src="/assets/default/js/panel/ai-content-generator.min.js"></script> -->