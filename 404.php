<?php
include 'core/auth.php';
if (checkLogin() && !checkAdmin()) {
    include 'include/header.php';
} else {
    include 'include/header_notlogin.php';
}
?>
<link rel="stylesheet" href="./assets/css/common.css">
<div class="container padding-top">
    <h2 class="title">404 Not Found</h2>
</div>
<p style="height: 457px;"></p>
<?php
include 'include/footer.php';
?>