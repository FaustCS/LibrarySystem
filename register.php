<?php
$pdo = new PDO('mysql:host=librarysystem.cb82keujv05g.us-east-2.rds.amazonaws.com;port=3306;dbname=LibrarySystem', 'admin', '123va321si21_');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['Add']))
{
    $err = [];

    // перевіряємо нік
    if(!preg_match("/^[a-zA-Z0-9]/",$_POST['UserName']))
    {
        $err[] = "Нікнейм може складатись тільки з англійського алфавіту та цифр";
    }

    if(strlen($_POST['UserName']) < 3 || strlen($_POST['UserName']) > 30)
    {
        $err[] = "Нікнейм не повинен бути меншим ніж 3 символи і не більше 30";
    }

    if($_POST['Password1']!=$_POST['Password2']){
        $err[] = "Паролі не співпадають";
    }
    $stmt = $pdo->query("SELECT * FROM User Where Username='".$_POST['UserName']."'");
    $query = $stmt->fetchAll();

    if(is_null($query))
    {
        $err[] = "Користувач з таким ніком уже існує";
    }

    // Якщо нема помилок, додаємо в бд нового користувача
    if(count($err) == 0)
    {

        $login = $_POST['UserName'];

        // Забераємо пробіли для хешування
        $password = md5(md5(trim($_POST['Password2'])));


        $stmt = $pdo->prepare('INSERT INTO `User` (FirstName,LastName, Age,MobilePhone,UserName,Password) VALUES ( :fn,:ln,:ag,:mp,:un,:ps)');
        $stmt->execute(array(
                ':fn' => $_POST['FirstName'],
                ':ln' => $_POST['SecondName'],
                ':ag' => $_POST['Age'],
                ':mp' => $_POST['Number'],
                ':un' => $_POST['UserName'],
                ':ps' => $password)
        );
        header("Location: login.php"); exit();
    }
    else
    {
        print "<b>Помилка:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>
<h2>Registration</h2>
<div class="center1">
    <form method="post">
        <p>FirstName:
            <input type="text" name="FirstName" size="40"></p>
        <p>SecondName:
            <input type="text" name="SecondName" size="40"></p>
        <p>UserName:
            <input type="text" name="UserName" size="40"></p>
        <p>Your age:
            <input type="number" min="1" max="99" name="Age"></p>
        <p>Phone number:
            <input type="text" name="Number"></p>
        <p>Password:
            <input type="text" name="Password1"></p>
        <p>Enter your password again:
            <input type="text" name="Password2"></p>

        <p><input type="submit" name="Add" value="Add">
            <input type="submit" name="Cancel" value="Cancel">

    </form>
</div>

<style>
    .center1 {
        margin: auto;
        width: 66%;
    }
    h2 {

        margin: auto;
        margin-top: 30px;
        width: 66%;
    }
</style>