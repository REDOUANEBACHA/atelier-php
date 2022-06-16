<?php
require 'db.php';
// define how many results you want per page
if( isset($_GET['Num_client'])){
	 $Num_client = $_GET['Num_client'];
$sql="INSERT INTO commande(Num_client) VALUES(:Num_client)";
 $statement = $connection->prepare($sql);

 if ($statement->execute([':Num_client' => $Num_client])) {
    

$con=mysqli_connect('127.0.0.1', 'root', '','gestion_de_stock');


$sql = "SELECT Max(Id_commande) FROM commande";
$result = mysqli_query($con,$sql);

$id_cmd=$result->fetch_row()[0];

  echo '<meta http-equiv="refresh" content="0;URL=Band_livraison.php?Id_commande='.$id_cmd.'">';
  }
}


      
        
       // echo '<meta http-equiv="refresh" content="0;URL=ajt_cmd.php">';
      

?>









