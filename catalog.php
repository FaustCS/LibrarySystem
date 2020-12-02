<?php
session_start();
require_once 'classes\Catalog.php';
require_once 'components\header.php';
?>

<script>document.title = 'Каталог'</script>
<div style="
	width:90%;
	margin:0 auto;
	">
	<div style="
		width:20%;
		float:left;
		padding-top:2em;
		">
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
	</div>
	<div style="
	width:80%;
	padding:0.5em;
	float:right;
	">
		<h2>Каталог</h2>
		<p>
			<?php
			$catalog->datatable($query);
			$_POST['SearchBookForm']=NULL;
			?>
		</p>
	</div>
</div>
<?php require_once 'components\footer.php'; ?>
