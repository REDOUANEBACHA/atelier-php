<?php require 'nav.php';?>


<?php
require 'db.php';
$sql = 'SELECT Ref_article,Nom_article,Quantite,Qte_alert,Nom_fournisseur,Telephone,Email FROM article join fournisseur on article.Num_fournisseur=fournisseur.Num_fournisseur where Quantite<=Qte_alert';
$statement = $connection->prepare($sql);
$statement->execute();
$Article = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<div class="container">
      
      
      <h2 style="font-family: algerien"><u>Liste des article ayant une quantité moins que la quantité alert: </u></h2><br>
      
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Référence article </th>
          <th>Nom article</th>
          <th>Quantité</th>
          <th>Quantité alert</th>
          <th>Fournisseur</th>
          <th>Téléphone</th>
          <th>Email</th>
        </tr>
        <?php foreach($Article as $prs): ?>
          <tr>
            <td><?= $prs->Ref_article; ?></td>
            <td><?= $prs->Nom_article; ?></td>
            <td><?= $prs->Quantite; ?></td>
            <td><?= $prs->Qte_alert; ?></td>
            <td><?= $prs->Nom_fournisseur; ?></td>
            <td><?= $prs->Telephone; ?></td>
            <td><?= $prs->Email; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  
</div>


<?php require 'foter.php';?>
