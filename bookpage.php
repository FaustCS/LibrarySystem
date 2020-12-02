<?php
session_start();
require_once 'components\header.php';
require_once 'classes\Catalog.php';

$data=$editAndDelete->getInfo($_GET['book_id']);
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
	</div>
<?php
require_once 'components\footer.php';
?>