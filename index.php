<?php
session_start();
include ('db.php');

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Include header
// include('header.php'); 

if ($page == 'home') {
    include ('home.php');
}

// Include footer
// include('footer.php'); 