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

<?php
require('components/header.php');
?>
<h2 style="text-align:center">Registration</h2>
<div class="center1">
	<div>
		<p>FirstName:</p>
        <p>SecondName:</p>
        <p>UserName:</p>
        <p>Your age:</p>
        <p>Phone number:</p>
        <p>Password:</p>
        <p>Enter your password again:</p>
	</div>	
    <form method="post" class="input_data">
        <p><input type="text" name="FirstName" size="40"></p>
        <p><input type="text" name="SecondName" size="40"></p>
        <p><input type="text" name="UserName" size="40"></p>
        <p><input type="number" min="1" max="99" name="Age"></p>
        <p><input type="text" name="Number"></p>
        <p><input type="text" name="Password1"></p>
        <p><input type="text" name="Password2"></p>

	<form class="input_button">
		<p>
			<input class="input_button_button" type="submit" name="Add" value="Add">
            <input class="input_button_button" type="submit" name="Cancel" value="Cancel">
		</p>
	</form method="post">
</div>

<style>
    .center1 {
        margin: auto;
        width: 66%;		
    }
	.center1 div{        
        width: 45%;
		text-align:right;
		float:left;
    }
    h2 {
        margin: auto;
        margin-top: 30px;
        width: 66%;
    }
	input{
		width:100%;
		margin:0;
	}
	form.input_data{
		width: 54%;
		display:block;
		float:right;		
	}
	form p{
		margin-block-start: 0.65em;   
		margin-block-end: 0.2em;   
	}
	.input_button{
		width:55%;
		text-align:center;
		float:right;
	}
	.input_button_button{
		width:33%;		
	}
</style>

<?php
require('components/footer.php');
?>
