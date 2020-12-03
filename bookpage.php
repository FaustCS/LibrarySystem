<?php
session_start();
$err=[];

require_once 'components\header.php';
require_once 'classes\Catalog.php';

$data=$editAndDelete->getInfo($_GET['book_id']);

if($_POST["addReview"]){
	if(strlen($_POST['textReview'])<1){
		$err[]='Заповніть рев\'ю';
	}
	if(count($err)==0) {
		$review->createReview($_POST['textReview'], $_SESSION['Username'], $data[0][0]);
		$_SESSION['message']='Рев\'ю успішно додано!';
		exit("<meta http-equiv='refresh' content='0; url=bookpage.php?book_id=" . $_GET['book_id'] . "'>");
	}else foreach($err AS $error){print  $error."<br>";}       
}
$dataReview = $review->getReview($_GET['book_id']);
?>
	<script>
		document.title = <?php echo "'" . $data[0][1] . "'" ?>;
	</script>
	<h1 style="text-align:center;font-size:2em;"><?php echo $data[0][1]?></h1>
	<div class="container">
		<div style="
			width:60%;
			box-sizing:border-box;
			float:left;
		">
			<img style = "
			padding-right:1em;
			box-sizing:border-box;
			float:right;
			" src = "img/cover/<?php echo $data[0][0]?>.png" height="420" width="300" alt="<?php echo "Обкладинка " . $data[0][1]?>">
		</div>		
		<div style="
			width:40%;
			box-sizing:border-box;
			float:right;
			font-size:1.3em;
		">
			<p>Назва: <?php echo $data[0][1] ?></p>
			<p>Видавництво: <?php echo $data[0][2] ?></p>
			<p>Жанр: <?php echo $data[0][3]?></p>
			<p>Кількість сторінок: <?php echo $data[0][4] ?></p>
			<p>В наявності: <?php echo $data[0][5] ?></p>
		</div>		
		<form style="
			width:40%;
			box-sizing:border-box;
			float:right;
			font-size:1.3em;
			" method="post">			
				<input style="					
					width:100px;
					border-radius:10px;
					border:2px black solid;
					padding:10px;
				" type="image" name="LikeThis" src="img/like.png" alt="Олюблена">
				<input  style="					
					width:100px;
					border-radius:10px;
					border:2px black solid;
					padding:10px;
				" type="image" name="WannaRead" src="img/add.png" alt="Хочу прочитати">
		</form>
		<div style = "
			width:100%;
			float:left;
			padding-top:1em;
		">
		<?php if($dataReview!=0){ for($i = 0; $i<count($dataReview);$i = $i + 1){?>
			<div style = "
			width:70%;
			margin:0 auto;
			">
				<p style="
					background:#006b5d;
					font-size:1.3em;
					padding:0.5em;
					color:white;
					margin:0;
				">Рецензія користувача: <?php echo $review->getUserName($dataReview[$i][2])?></p>
				<p style="
					background:#006b5d;
					font-size:1em;
					padding:0.5em;
					color:white;
					margin:0;
				">Дата рецензії: <?php echo $dataReview[$i][4]?></p>
				<p style="
					padding:0 0.5em;
					text-align:justify;
					text-indent:10%;
				">
				<?php echo $dataReview[$i][1]?>
				</p>
			</div>
		<?php }}?>
		</div>
		<?php if(strlen($_SESSION['Username'])>0){?>
		<div style = "
			width:100%;
			float:left;
			padding-top:1em;
		">
			<div style = "
				width:70%;
				margin:0 auto;
			">
				<p style="
					background:#006b5d;
					font-size:1.3em;
					padding:0.5em;
					color:white;
					margin:0;
				">Рецензія користувача: <?php echo $_SESSION['Username'] . " до книги " . $data[0][1]?></p>
				<form method="post">
					<textarea style="
						width:99.4%;
						margin:0 auto;
						height:200px;
						margin:0.2em 0;
						font-size:1.2em;
						border-style:1px solid #006b5d;
						border-radius:0;
						resize:none;
						text-align:justify;
					" name="textReview" maxlength="300" placeholder="Напишіть щось обмірковане..."></textarea>
					<input style="
						font-size:1.2em;
						float:right;
						color:white;
						background:#006b5d;
						font-family:'Playfair Display', serif;
						border-style:none;
						padding:0.4em;
						width:100%;
					" type="submit" name="addReview" value="Надіслати рецензію">
				</form>
			</div>
		</div><?php }?>
	</div>
<?php
require_once 'components\footer.php';
?>
