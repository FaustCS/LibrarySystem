<?php
session_start();
require('components/header.php');
require('components/footer.php');
?>
<html>
<h2 >Admin Panel</h2>
<body>
<div class="menu">
    <a href="FindUser.php.php">Знайти користувача</a><br>
    <a href="ConfirmBook.php">Підтвердити книгу</a><br>
    <a href="should_read.php">Хочу прочитати</a><br>
    <a href="archive.php">Архів</a><br>
    <a href="option.php">Налаштування</a><br> </div>
</body>
<style>
    .menu{
        font-family: "Sitka Display";
        line-height: 1.5;
        margin-top: 5%;
        margin-left: 5%;
        font-size: 20px;
    }
    h2 {
        margin-top: 3%;
        font-size: 35px;
        margin-left: 40%;
    }
</style>
</html>
