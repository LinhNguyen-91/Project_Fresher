<?php

if (!$_SESSION['username']) {
    header("Location: index.php?controller=admin&action=login");
}
include_once('./views/masterpage/admin/header.php');
include_once('./views/masterpage/admin/sidebar.php');
include_once('./views/masterpage/admin/content.php');
include_once('./views/masterpage/admin/footer.php');
