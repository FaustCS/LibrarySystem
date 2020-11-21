<?php


class Catalog
{

    public function menu(){
        require_once('components\header.php');
    }

    private function connectDB($query)
    {
        $pdo = new PDO("mysql:host=librarysystem.cb82keujv05g.us-east-2.rds.amazonaws.com;port=3306;dbname=LibrarySystem", 'admin', '123va321si21_');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("set names utf8");

        $stmt = $pdo->query("$query");
        $data = $stmt->fetchAll();
        return $data;
    }
    public function datatable($query){

        try{

         $data =  $this->connectDB($query);

            for ($i=0;$i<count($data);$i++){
                echo 'Id '.($i+1).' Назва : <b>'.$data[$i][1].'</b> Видавництво:'.$data[$i][2].' Жанр: '.$data[$i][3].' Кількість сторінок: '.$data[$i][4].' В наявності: '.$data[$i][5];
                if( $_SESSION['Username']=='admin') {
                    ?>

                    <html>
                    <a href="edit.php?book_id=<?php echo($data[$i][0]) ?>">Edit</a>/<a
                        href="delete.php?book_id=<?php echo($data[$i][0]) ?>">Delete</a>
                    <br><br></html>
                    <?php
                }
            }
        }catch (Exception $a){
            echo 'Table is empty';
        }

}

}

$catalog = new Catalog();
