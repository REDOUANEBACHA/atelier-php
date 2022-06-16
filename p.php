<?php
require 'db.php';

$sql = 'SELECT * FROM authentification';
$statement = $connection->prepare($sql);
$statement->execute();
$article = $statement->fetchAll(PDO::FETCH_OBJ);

$c=0;

 foreach($article as $person): 
	$c++;
  endforeach; 

    if($c==0)
    {
     
      echo '<meta http-equiv="refresh" content="0;URL=Inscription.php">';

    }
    else
    {
        echo '<meta http-equiv="refresh" content="0;URL=login.php">';
    }

 ?>