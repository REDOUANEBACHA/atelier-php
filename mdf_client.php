<?php
require 'db.php';
$Num_client = $_GET['Num_client'];
$sql = 'SELECT * FROM client WHERE Num_client=:Num_client';
$statement = $connection->prepare($sql);
$statement->execute([':Num_client' => $Num_client ]);
$prs = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['Nom_client'])  && isset($_POST['Prenom_client']) && isset($_POST['telephone']) && isset($_POST['Departement']) ) {
  

  $Nom_client = $_POST['Nom_client'];
  $Prenom_client = $_POST['Prenom_client'];
  $telephone = $_POST['telephone'];
  $Departement = $_POST['Departement'];
  $sql = "update client set Nom_client='$Nom_client',Prenom_client='$Prenom_client',telephone='$telephone',Departement='$Departement' where Num_client='$Num_client'";
  $statement = $connection->prepare($sql);
  if ($statement->execute([':Nom_client' => $Nom_client, ':Prenom_client' => $Prenom_client, ':telephone' => $telephone , ':Departement' => $Departement , ':Num_client' => $Num_client])) {
 
     echo '<meta http-equiv="refresh" content="0;URL=ajt_client.php">'; 
}
}
 ?>
 <?php require 'nav.php';?>
<div class="container" style="width: 50%">
   
  <div class="card mt-5">
    <div class="card-header">
      <h2 style="text-align: center;">Modifier le client <strong style="color: blue "><?= $prs->Num_client; ?></strong></h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>                                   
        </div>
      <?php endif; ?>
      <form method="POST"  ><center>
        <div class="form-group">
          <label for="Nom_client">Nom client
          <input value="<?= $prs->Nom_client; ?>" type="text" name="Nom_client" id="Nom_client" class="form-control"></label>
        </div>
        <div class="form-group">
          <label for="Prenom_client">Prenom client
          <input type="text" value="<?= $prs->Prenom_client; ?>" name="Prenom_client" id="Prenom_client" class="form-control"></label>
        </div>
        <div class="form-group">
          <label for="telephone">telephone
          <input type="text" value="<?= $prs->telephone; ?>" name="telephone" id="telephone" class="form-control"></label>
        </div>
        <div class="form-group">
          <label for="Departement">Departement
          <input type="text" value="<?= $prs->Departement; ?>" name="Departement" id="Departement" class="form-control"></label>
        </div></center>
        <div class="form-group">
         <button type="submit" class="btn btn-info" style="margin-left: 2%">Modifier</button><br><br>
         <a  type="submit" class="col-md-2 btn-info" href='ajt_client.php'style="border-radius: 4px;width: 10%;margin-left: 2%;height:30px;padding: 5px;text-align: center;">Annuler</a><br><br><br><br>
        </div>        
      </form>

    </div>

  </div>
</div>
<?php require 'foter.php';?>
