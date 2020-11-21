<?php
session_start();
require('components/header.php');
require('components/bib_info.php');
require('components/content_active.php');

echo $_SESSION['Username'] ;
require('components/footer.php');
?>