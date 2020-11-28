<?php
session_start();
require_once 'classes\Catalog.php';
require_once 'components\header.php';
?>

<html>
<meta  content="text/html; charset=utf-8">
<title>Каталог</title>
<body>
<div >
    <?php
        if($_SESSION['Username']=='admin'){ ?>
    <p>
        <a href="addBook.php">Add New Entry</a><br>
        <a href="addAutor.php">Add New Author</a><br>
        <a style="color:green"><?php echo $_SESSION['message'];} ?>
</p>
<a style="color:green"><?php require_once 'components\GenresList.php';
$_SESSION['message']='';
if(!isset($_POST['GenresList'])){
    $_POST['GenresList']='Усі книги';
}
echo $_POST['GenresList'];
    if(empty($_POST['SearchBookForm'])){
switch ($_POST['GenresList']){
    case 'Усі книги':
      $query='Select * from Book';
        break;
    case 'Детектив':
        $query="Select * from Book where Genre ='Детектив'";
        break;
    case 'Трилер':
        $query="Select * from Book where Genre ='Трилер'";
        break;
    case 'Фантастика':
        $query="Select * from Book where Genre ='Фантастика'";
        break;
    case 'Жахи':
        $query="Select * from Book where Genre ='Жахи'";
        break;
    case 'Фентезі':
        $query="Select * from Book where Genre ='Фентезі'";
        break;
    case 'Драма':
        $query="Select * from Book where Genre ='Драма'";
        break;
    case 'Наука':
        $query="Select * from Book where Genre ='Наука'";
        break;
    case 'Інше':
        $query="Select * from Book where Genre !='Наука' AND Genre !='Детектив' AND Genre !='Трилер' 
                AND Genre !='Фантастика' AND Genre !='Жахи' AND
                Genre !='Фентезі' AND Genre !='Драма'";
        break;
}}else{
    $query="Select * from Book where BookName Like '%".$_POST['SearchBookForm']."%'";
}
    ?></a>
<h2>Каталог</h2>
<p>
    <?php
    $catalog->datatable($query);
    $_POST['SearchBookForm']=NULL;
    ?>
</p>
</div>
</body>
<?php require_once 'components\footer.php'; ?>
</html>
