<?php
require 'db.php';
$Ref_article = $_GET['Ref_article'];
$sql = 'SELECT * FROM article WHERE Ref_article=:Ref_article';
$statement = $connection->prepare($sql);
$statement->execute([':Ref_article' => $Ref_article ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['Num_fournisseur'])  && isset($_POST['Nom_article']) && isset($_POST['Marque_article']) && isset($_POST['Type_article']) && isset($_POST['Quantite']) && isset($_POST['Qte_alert']) && isset($_POST['Description']) && isset($_POST['categorie'])  ) {
  $Num_fournisseur = $_POST['Num_fournisseur'];
  $Nom_article = $_POST['Nom_article'];
  $Marque_article = $_POST['Marque_article'];
  $Type_article = $_POST['Type_article'];
  $Quantite = $_POST['Quantite'];
  $Qte_alert = $_POST['Qte_alert'];
  $Description = $_POST['Description'];
  $categorie = $_POST['categorie'];
  $image = $_POST['image'];
  $sql = 'UPDATE article SET Num_fournisseur=:Num_fournisseur, Nom_article=:Nom_article, Marque_article=:Marque_article, Type_article=:Type_article, categorie=:categorie, Quantite=:Quantite, Qte_alert=:Qte_alert, Description=:Description WHERE Ref_article=:Ref_article';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':Num_fournisseur' => $Num_fournisseur, ':Nom_article' => $Nom_article, ':Marque_article' => $Marque_article,':Type_article' => $Type_article,':categorie' => $categorie,':Quantite' => $Quantite,':Qte_alert' => $Qte_alert,':Description' => $Description, ':Ref_article' => $Ref_article])) {
    
    echo '<meta http-equiv="refresh" content="0;URL=index.php">';
  }



}


 ?>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
<?php require 'nav.php';?>
<div  >
<div class="container" style="width: 50%" >
  <div class="card mt-5">
    <div class="card-header" >
       <h2 style="text-align: center">Modifier l'article <strong style="color: blue "><?= $person->Ref_article; ?></strong> </h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post" ><center>
        <div class="form-group col">
          <label for="Num_fournisseur">Numéro fournisseur
         <?php
$con=mysqli_connect('127.0.0.1', 'root', '','gestion_de_stock');


$sql = "SELECT Num_fournisseur FROM fournisseur";
$result = mysqli_query($con,$sql);

echo "<div style='width:100%'><select name='Num_fournisseur'  class='form-control '  id='Num_fournisseur' required='obligatoires'  >";
while ($row = mysqli_fetch_array($result)) {
    echo "<option  value='" . $row['Num_fournisseur'] ."'>" . $row['Num_fournisseur'] ."</option>";
}
echo "</select></div>";
?></label><br>
        </div>
        <div class="form-group col">
           <label for="categorie">Catégorie
          <?php
$con=mysqli_connect('127.0.0.1', 'root', '','gestion_de_stock');


$sql = "SELECT libelle FROM categorie";
$result = mysqli_query($con,$sql);

echo "<div style='width:100%'><select name='categorie'  class='form-control '  id='categorie' required='obligatoires'  >";
while ($row = mysqli_fetch_array($result)) {
    echo "<option  value='" . $row['libelle'] ."'>" . $row['libelle'] ."</option>";
}
echo "</select></div>";
?></label><br>
        </div>
        <div class="form-group col">
          <label for="Nom_article">Nom article
          <input type="text" value="<?= $person->Nom_article; ?>" name="Nom_article" id="Nom_article" class="form-control" required="obligatoires"/></label>
        </div>
        <div class="form-group col">
          <label for="Marque_article">Marque
          <input type="text" value="<?= $person->Marque_article; ?>" name="Marque_article" id="Marque_article" class="form-control" required="obligatoires"/></label>
        </div>
        <div class="form-group col">
          <label for="Type_article">Type

          <input type="text" value="<?= $person->Type_article; ?>" name="Type_article" id="Type_article" class="form-control"required="obligatoires"/ ></label>
        </div>
        <div class="form-group col">
          <label for="Quantite">Quantité
          <input type="text" value="<?= $person->Quantite; ?>" name="Quantite" id="Quantite" class="form-control" required="obligatoires"/></label>
        </div>
        <div class="form-group col">
          <label for="Qte_alert">Quantité alert
          <input type="text" value="<?= $person->Qte_alert; ?>" name="Qte_alert" id="Qte_alert" class="form-control" required="obligatoires"/></label>
        </div>
        <div class="form-group col">
          <label for="Description">Déscription
          <input type="text" value="<?= $person->Description; ?>" name="Description" id="Description" class="form-control" required="obligatoires"/></label>
        </div>
      
        </center>
        <div class="form-group col">
          <button type="submit" class="btn btn-info" style="margin-left: 2%">Modifier</button><br><br>
          <a  type="submit" class="col-md-2 btn-info" href='index.php' style="border-radius: 4px;width: 10%;margin-left: 2%;height:30px;padding: 5px;text-align: center;" >Annuler</a><br><br>
        </div>
      </form>
    </div>
  </div>
</div>
</div><br><br><br>
<?php require 'foter.php';?>