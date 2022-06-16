
<?php require 'nav.php';?>

<div >
  <img src="image/FSSM.png" width="40%">
</div>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h1 style="text-align: center ;font-family: algerien"><u>Bon De Livraison</u></h1><br>
    </div>
 <?php
// connect to database
session_start();

require 'db.php';



$Id_commande = $_GET['Id_commande'];


foreach($_SESSION["shopping_cart"] as $keys => $values):
      
            $Ref_article=$_SESSION["shopping_cart"][$keys]['product_id'];
            $Quantite=$_SESSION["shopping_cart"][$keys]['product_quantity'];

            $sql='insert into ligne_commande(Quantite,Ref_article,Id_commande) values(:Quantite,:Ref_article,:Id_commande)';
            $statement = $connection->prepare($sql);
            if ($statement->execute([':Quantite' => $Quantite,':Ref_article' => $Ref_article,':Id_commande' => $Id_commande])){
              $sql = "update article set Quantite=Quantite-'$Quantite' where Ref_article='$Ref_article'";
              $statement = $connection->prepare($sql);
              $statement->execute();
            }
      endforeach;    





// retrieve selected results from database and display them on page
$sql='SELECT commande.Id_commande,client.Nom_client,Date FROM commande join client  on commande.Num_client=client.Num_client  where  commande.Id_commande='.$Id_commande;
$statement = $connection->prepare($sql);
$statement->execute();
$clt = $statement->fetchAll(PDO::FETCH_OBJ);?>
<div class="container" id="tab" >
      <table class="table">
       <thead>
        <tr>
               <th>Numéro commande</th>
           <th>Nom client</th>
             <th>Date</th>
        </tr></thead>




 


 <?php foreach($clt as $row):?>
  


  <tbody><tr>
    <td><?= $row->Id_commande; ?></td>
    <td><?= $row->Nom_client; ?></td>
    <td><?= $row->Date; ?></td>
            
          </tr></tbody>

 
        <?php endforeach; ?>
              
</table></div>




<div class="container">
  
      <h2 style="font-family: algerien;"><u>les Articles commander:</u></h2><br>
      
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Reference </th>
          <th>description</th>
          <th>Quantite</th>
        </tr>


        <?php foreach($_SESSION["shopping_cart"] as $keys => $values): ?>
          <tr>
            <td><?= $_SESSION["shopping_cart"][$keys]['product_id']; ?></td>
            <td><?= $_SESSION["shopping_cart"][$keys]['product_name']; ?></td>
            <td><?= $_SESSION["shopping_cart"][$keys]['product_quantity']; ?></td>
           
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  
</div>

  <br>
<?php unset($_SESSION["shopping_cart"]); ?>
</div><br><br><br>

</body>
</html>
<?php require 'foter.php';?>   

   