<html><head>
    <title>Додати книгу</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<body>
<div >
    <h2>Додати книгу</h2>
    <a style="color:red"><?php echo htmlentities($_POST['error'])?></a>
    <form method="post">
        <p>Назва:
            <input type="text" name="make" size="40"></p>
        <p>Видавництво:
            <input type="text" name="model" size="40"></p>
        <p>Кількість сторінок:
            <input type="text" name="year"></p>
        <p>В наявності:
            <input type="text" name="mileage"></p>

        <p><input type="submit" value="Add">
            <input type="button"  value="Cancel">

    </form>
</div>


</body></html>
