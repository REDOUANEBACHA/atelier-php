		 <?php
$cn=mysqli_connect("127.0.0.1","root","","gestion_de_stock");


$login=$_POST['login'];
$Password=$_POST['Password'];
   

$req = "SELECT * FROM authentification where login='$login' and Password='$Password'";
 
$result=mysqli_query($cn,$req);

 if (isset($_POST['Connecter']))
   
           
              if ($result->num_rows > 0)
               {
                 
                  echo '<meta http-equiv="refresh" content="0;URL=index.php">';

                } 
                else
                 {
                       
                        echo '<body onLoad="alert(\'le nom d utilisteur ou le mot de passe est incorrecte\')">';
                        echo '<meta http-equiv="refresh" content="0;URL=login.php">';
                 } 


                   mysqli_close($cn);

  
  

 ?>