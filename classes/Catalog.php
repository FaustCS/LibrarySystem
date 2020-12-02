<?php

require_once 'Database.php';

class Catalog extends Database
{
    
    public function datatable($query){

        try{

         $data =  $this->doQuery($query);


            for ($i=0;$i<count($data);$i++){
                $AutorData =  $this->doQuery('Select FirstName,LastName from Author Where Id='.$data[$i][6]);
                echo 'Id '.($i+1)." Назва : <b>"?><html><a href="bookpage.php?book_id=<?php echo($data[$i][0]) ?>"></html><?php echo $data[$i][1].'</b></a> Автор: <b>'.$AutorData[0][0].' '.$AutorData[0][1].'</b> Видавництво: '.$data[$i][2].' Жанр: '.$data[$i][3].' Кількість сторінок: '.$data[$i][4].' В наявності: '.$data[$i][5];
                if( $_SESSION['Username']=='admin') {
                    ?>
                    <html>
                    <a href="edit.php?book_id=<?php echo($data[$i][0]) ?>">Edit</a>/<a
                        href="delete.php?book_id=<?php echo($data[$i][0]) ?>">Delete</a>
                    <br><br></html>
                    <?php
                }else{
                    echo '<br> <br>';
                }
            }
        }catch (Exception $a){
            echo 'Table is empty';
        }

}

}

class CreateCatalog extends Catalog {

   public function findAuthor($FirstName,$LastName){
$data=$this->doQuery("Select * from Author where FirstName ='".$FirstName."' And LastName='".$LastName."'");
if(empty($data)){
    return false;
}else{
    return true;
}
   }
   public function createBook($BookName,$FirstName,$LastName,$Publishing,$Genre,$PageNumber,$InStock){

       $data=$this->doQuery("Select Id from Author where FirstName ='".$FirstName."' And LastName='".$LastName."'");
       $AuthorId=$data[0][0];
   $pdo=$this->connect();
       $stmt = $pdo->prepare('INSERT INTO Book
        (BookName,publishing,Genre,AmountOfPages,InStock,AuthorId) VALUES ( :bn,:pb,:gn,:pn,:st,:ai)');
       $stmt->execute(array(
               ':bn' => $BookName,
               ':pb' => $Publishing,
               ':gn' => $Genre,
                ':pn' => $PageNumber,
                ':st' => $InStock,
                'ai' =>$AuthorId
       ));
   }
   public function isAuthor($FirstName,$LastName){
       $pdo=$this->connect();
       $data=$this->doQuery("Select FirstName,LastName from Author where FirstName ='".$FirstName."' And LastName='".$LastName."'");
       if(!empty($data)){
           return true;
       }else{
           return false;
       }
   }
    public function createAuthor($FirstName,$LastName,$About){
        $pdo=$this->connect();

        $stmt = $pdo->prepare('INSERT INTO Author
        (FirstName,LastName,Description) VALUES ( :fn,:ln,:ab)');
        $stmt->execute(array(
            ':fn' => $FirstName,
            ':ln' => $LastName,
            ':ab' => $About
        ));
    }

}

class EditAndDelete extends Catalog {
    public function findBookName($id){
        $pdo=$this->connect();
        $data=$this->doQuery('Select BookName from Book where Id='.$id);
            return $data;
    }
public function delete ($id){
    $pdo=$this->connect();
    $stmt = $pdo->prepare("DELETE FROM Book WHERE Id=".$id);
    $stmt->execute();
}
public function getInfo($id){
       return $this->doQuery("Select * from Book where Id=".$id);
}
    public function getAuthor($id){
        return $this->doQuery("Select * from Author where Id=".$id);
    }
public function edit($BookName,$Publishing,$Genre,$PageNum,$inStock,$id){
    $pdo=$this->connect();
    $stmt = $pdo->prepare("UPDATE Book SET BookName='".$BookName."', publishing='".$Publishing."', Genre='".$Genre."', AmountOfPages=".$PageNum.",InStock=".$inStock." WHERE Id=".$id);
    $stmt->execute();
}
}
$editAndDelete = new EditAndDelete();
$createCatalog = new CreateCatalog();
$catalog = new Catalog();
