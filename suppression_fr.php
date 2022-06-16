<?php
require 'db.php';
$Num_fournisseur = $_GET['Num_fournisseur'];
$sql = "DELETE FROM fournisseur WHERE Num_fournisseur='$Num_fournisseur'";
$statement = $connection->prepare($sql);
if ($statement->execute([':Num_fournisseur' => $Num_fournisseur])) {

   echo '<meta http-equiv="refresh" content="0;URL=ajt_fournisseur.php">';
}
else{
	echo'<body onLoad="alert(\'Ce fournisseur a des articles...\')">';
	 echo '<meta http-equiv="refresh" content="0;URL=ajt_fournisseur.php">';

}