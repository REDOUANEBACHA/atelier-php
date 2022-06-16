<?php
require 'db.php';
$Id_commande = $_GET['Id_commande'];
$sql = 'SELECT commande.Id_commande,client.Nom_client,Date FROM commande join client  on commande.Num_client=client.Num_client where Id_commande='.$Id_commande;
$statement = $connection->prepare($sql);
$statement->execute([':Id_commande' => $Id_commande ]);
$person = $statement->fetch(PDO::FETCH_OBJ);



 ?>
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
 <?php require 'nav.php';?>
 <div class="row text-center padding">

<div class="container"  style="width: 45%;" >
 <div class="card mt-5" >
    <div class="card-header">
       <h2 style="text-align: center;font-family: algerien">Détail Commande </h2>
    </div>
    <div class="card-body"style="border-style: solid;>
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post"  align="left" >
        
        <div class="form-group col" style="margin-left: 3%">
          <label for="Id_commande"><strong>Numéro du commande :</strong> <?php echo $person->Id_commande; ?></label>
        </div>
        <div class="form-group col" style="margin-left: 3%">
          <label for="Nom_client"><strong>Nom client :</strong> <?php echo $person->Nom_client; ?></label>
        </div>
        <div class="form-group col"  style="margin-left: 3%">
          <label for="Date"><strong>Date :</strong> <?php echo $person->Date; ?></label>
        </div>
       
        
        <br>  
        <div class="form-group col" >
          <a  type="submit" class="col-md-2 btn-info" href='recherche_cmd.php'  style="margin-left: 3%;border-radius: 4px;width: 12%" >Retour</a><br><br>
        </div>
      </form>
    </div>
  </div>

</div>
<br><br>
 <?php
// connect to database
$con = mysqli_connect('127.0.0.1','root','');
mysqli_select_db($con, 'gestion_de_stock');
// define how many results you want per page

$results_per_page = 20;
// find out the number of results stored in database
$sql='SELECT ligne_commande.Ref_article,article.Nom_article,ligne_commande.Quantite FROM commande join ligne_commande  on commande.Id_commande=ligne_commande.Id_commande join article  on ligne_commande.Ref_article=article.Ref_article where commande.Id_commande='.$Id_commande.'';
$result = mysqli_query($con, $sql);



    echo ' <div class="container" id="tab" >
      <table class="table">
       <thead>
        <tr>
       <th>Référence</th>
           <th>Nom article</th>
           <th>Quantité</th>
         
    </tr></thead>';
while($row = mysqli_fetch_array($result)) {
  
echo '<tbody><tr>
     <th >'.$row['Ref_article'].'</th>
            <th>'.$row['Nom_article'].'</th>
            <th>'.$row['Quantite'].'</th>
            
          </tr></tbody>';

  
}



// display the links to the pages

              
?>


</div>
<?php require 'foter.php';?>
