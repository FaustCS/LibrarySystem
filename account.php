<?php
session_start();
require('components/header.php');
require('components/footer.php');
require_once 'classes\User.php';
if (!isset($_SESSION['Username'])) {
    die('Not logged in');
}

?>
<html>
<h2 class="H2centre"><?php  print $user->getFirstName().' '.$user->getLastName()?></h2>
<body>

<a href="formular.php">Список книжок</a><br>
<a href="favorite.php">Улюблені книги</a><br>
<a href="should_read.php">Хочу прочитати</a><br>
<a href="archive.php">Архів</a><br>
<a href="option.php">Налаштування</a><br>


<div class="giveEmail">
    <p>Хочете отримувати новини щодо поповнення і рейтингу книг?<br> Залиште нам свою пошту</p>
    <form method="post">
        <input type="text" name="email" value="Ваш емейл">
        <input type="submit">
    </form>
</div>
<div class="poster">
    Змінити пароль
    <div class="descr">
<form method="post" class="p">
        <p>Старий пароль:
            <input  type="password" value="<?php echo $data[0][7]?>" name="email" size="40"></p>
        <p>Новий пароль:
            <input type="password" value="<?php echo $data[0][4] ?>" name="phoneNum" size="40"></p>
        <p>Новий пароль:
            <input type="password" value="<?php echo $data[0][5] ?>" name="userName" size="40"></p>

        <p><input type="submit" name="Save" value="Зберегти">
</form>
    </div>
</div>

<style>
    .p{
        text-align: right;
    }
    .poster{
        position:relative;
        margin:100px auto;
        margin-left: 70%;
        margin-top: -400px;
    }
    .descr{

        display:none;
        margin-left:-350px;
        padding:10px;
        margin-top:17px;
        background:rgb(235,228,228); /*229,255,204 */
        height:200px;
        -moz-box-shadow:0 5px 5px rgba(0,0,0,0.3);
        -webkit-box-shadow:0 5px 5px rgba(0,0,0,0.3);
        box-shadow:0 5px 5px rgba(0,0,0,0.3);
    }
    .poster:hover .descr{
        display:block;
        position:absolute;
        top:1px;
        z-index:9999;
        float: right;

        width:490px;
    }
</style>

</body>
<style>
    .giveEmail{
      margin-top: 22%;
        margin-left: 35%;
    }
    h2{
        margin-top: 3%;
        font-size: 35px;
        margin-left: 40%;
    }
</style>

</html>
