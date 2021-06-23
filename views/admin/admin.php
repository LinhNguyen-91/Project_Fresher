<?php

if (!$_SESSION['username']) {
    header("Location: index.php?controller=admin&action=login");
}
include_once('path.php');
include('header.php');
include('sidebar.php');
include('content.php');
include('footer.php');
