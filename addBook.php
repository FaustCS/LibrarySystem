<?php
session_start();
$err=[];
$_SESSION['message']='';
require_once 'classes\Catalog.php';
require_once 'components\header.php';

if(!$_SESSION['Username']=='admin'){
    die('Access denied');
}

if($_POST['submit']){
if(strlen($_POST['BookName'])<1){
    $err[]='Заповніть назву книги';
}
if(strlen($_POST['AuthorFirstName'])<1){
    $err[]="Заповніть ім'я автора";
}
if(strlen($_POST['AuthorSecondName'])<1){
    $err[]="Заповніть прізвище автора";
}
if(strlen($_POST['Publishing'])<1){
    $err[]="Заповніть назву видавництва";
}
if(strlen($_POST['Genre'])<1){
        $err[]="Вкажіть жанр";
}
if(!is_numeric($_POST['PageNumber'])){
    $err[]="Кількість сторінок має бути числом";
}
if(!is_numeric($_POST['InStock'])){
    $err[]="Поле 'В наявності' має бути числом";
}

if(count($err)==0) {
    if ($createCatalog->findAuthor($_POST['AuthorFirstName'], $_POST['AuthorSecondName'])) {
    $createCatalog->createBook($_POST['BookName'],$_POST['AuthorFirstName'],
        $_POST['AuthorSecondName'],$_POST['Publishing'],$_POST['Genre'],$_POST['PageNumber'],$_POST['InStock']);
$_SESSION['message']='Книгу успішно додано!<br>';
        exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");

    } else {
        $err[] = "Автора не має в базі даних!";
    }
}

}
if($_POST['cancel']){
    exit("<meta http-equiv='refresh' content='0; url=catalog.php'>");
}
?>

<html><head>

    <title>Додати книгу</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<body>
<div >
    <h2>Додати книгу</h2>
    <a style="color:green"><?php
        echo $_SESSION['message'];
        ?>
    </a>
    <a style="color:red"><?php
        foreach($err AS $error)
        {
            print  $error."<br>";
        }
        echo '<br>';
        ?>
    </a>

    <form method="post">
        <p>Назва:
            <input type="text" name="BookName" size="40"></p>
        <p>Ім'я письменника:
            <input type="text" name="AuthorFirstName" size="40"></p>
        <p>Прізвище письменника:
            <input type="text" name="AuthorSecondName" size="40"></p>
        <p>Видавництво:
            <input type="text" name="Publishing" size="40"></p>
        <p>Жанр:
            <input type="text" name="Genre" size="40"></p>
        <p>Кількість сторінок:
            <input type="text" name="PageNumber"></p>
        <p>В наявності:
            <input type="text" name="InStock"></p>

        <p><input type="submit" name="submit" value="Add">
            <input type="button" name="cancel" value="Cancel">

    </form>
</div>
</body></html>

<?php
require_once 'components\footer.php';
?>