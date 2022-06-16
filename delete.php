<?php
require 'db.php';
$Ref_article = $_GET['Ref_article'];
$sql = 'DELETE FROM article WHERE Ref_article=:Ref_article';
$statement = $connection->prepare($sql);
if ($statement->execute([':Ref_article' => $Ref_article])) {
 
   echo '<meta http-equiv="refresh" content="0;URL=index.php">';
}