<?php
require 'db.php';
$libelle = $_GET['libelle'];
$sql = "DELETE FROM categorie WHERE libelle='$libelle'";
$statement = $connection->prepare($sql);
if ($statement->execute([':libelle' => $libelle])) {

   echo '<meta http-equiv="refresh" content="0;URL=ajt_categorie.php">';
}
else{
	echo'<body onLoad="alert(\'Cette catégorie a des article...\')">';
	 echo '<meta http-equiv="refresh" content="0;URL=ajt_categorie.php">';

}