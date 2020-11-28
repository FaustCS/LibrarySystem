<?php
session_start();
require('components/header.php');
require('components/footer.php');
if (!isset($_SESSION['Username'])) {
    die('Not logged in');
}
