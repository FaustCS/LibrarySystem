<?php
session_start();
if ( ! isset($_SESSION['Username']) ) {
    die('Not logged in');
}
