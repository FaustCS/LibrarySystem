
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>Бібліотека Не_Рви</title>
    <link rel="stylesheet" href="style.css">
	<link rel="icon" href="img/storytelling.png">
  </head>
	<style>
	@import url('https://fonts.googleapis.com/css2?family=EB+Garamond:wght@500&display=swap');
	</style>
  <body>
    <header class="site-header">
      <nav class="site-navigation">
        <a class="logo-link" href="index.php">
          <img src="img/logo-full.png" alt="Логотип бібліотеки Не_Рви">
        </a>
        <ul class="navigation-list">
          <li><a href="catalog.php">Каталог</a></li>
          <li><a href="delivery.html">Доставка</a></li>
          <li><a href="contacts.html">Контакти</a></li>
            <?php
            if(!isset($_SESSION['Username'])){ ?>
            <li><a href="login.php">Вхід</a></li>
            <?php } else{  ?>
                <li><a href="logout.php">Вихід</a></li>
            <?php }?>
            <li><a href="register.php">Реєстрація</a></li>
            <li><a href="account.php">Особистий кабінет</a></li>
            <li class = "USERNAME"><?php

                if(isset($_SESSION['Username'])){
                echo $_SESSION['Username'];
                }?></li>
        </ul>
      </nav>
    </header>
