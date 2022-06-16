<?php
$cn=mysqli_connect("127.0.0.1","root","","gestion_de_stock");


$Reponse=$_POST['Reponse'];
   

$req = "SELECT * FROM authentification where Reponse='$Reponse'";
 
$result=mysqli_query($cn,$req);

 if (isset($_POST['Confirmer']))
   
           
              if ($result->num_rows > 0)
               {
                 
                  echo '<meta http-equiv="refresh" content="0;URL=ModInfoAdmi.php">';

                } 
                else
                 {
                       
                        echo '<body onLoad="alert(\'la réponse incorrecte\')">';
                        echo '<meta http-equiv="refresh" content="0;URL=passwordOublier.php">';
                 } 


                   mysqli_close($cn);

  
  

 ?>