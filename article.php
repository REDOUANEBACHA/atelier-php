<?php
require 'db.php';
$upload_dir = 'uploads/';
$Ref_article = $_GET['Ref_article'];
$sql = 'SELECT * FROM article WHERE Ref_article=:Ref_article';
$statement = $connection->prepare($sql);
$statement->execute([':Ref_article' => $Ref_article ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['Num_fournisseur'])  && isset($_POST['Nom_article']) && isset($_POST['Marque_article']) && isset($_POST['Type_article']) && isset($_POST['Quantite']) && isset($_POST['Qte_alert']) && isset($_POST['Description']) && isset($_POST['image']) ) {
 
}


 ?>
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
 <?php require 'nav.php';?>
 <div class="row text-center padding">

<div class="container"  style="width: 45%;margin-left: 5%" >
 <div class="card mt-5" >
    <div class="card-header">
       <h2 style="text-align: center">L'article <strong style="color: blue "><?= $person->Ref_article; ?></strong> </h2>
    </div>
    <div class="card-body"style="border-style: solid;>
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post"  align="left" >
        
        <div class="form-group col" style="margin-left: 3%">
          <label for="Nom_article"><strong>Nom article :</strong> <?php echo $person->Nom_article; ?></label>
        </div>
        <div class="form-group col" style="margin-left: 3%">
          <label for="Marque_article"><strong>Marque :</strong> <?php echo $person->Marque_article; ?></label>
        </div>
        <div class="form-group col"  style="margin-left: 3%">
          <label for="Type_article"><strong>Type :</strong> <?php echo $person->Type_article; ?></label>
        </div>
        <div class="form-group col"  style="margin-left: 3%">
          <label for="Quantite"><strong>Quantité :</strong> <?php echo $person->Quantite; ?>
          </label>
        </div>
        
        <div class="form-group col"  style="margin-left: 3%">
          <label for="Decription"><strong>Déscription :</strong> <div style="width:40% ; margin-left: 30px; "><?php echo $person->Description; ?></div></label>
        </div><br>  
        <div class="form-group col" >
          <a  type="submit" class="col-md-2 btn-info" href='index.php'  style="margin-left: 3%;border-radius: 4px;width: 12%" >Retour</a><br><br>
        </div>
      </form>
    </div>
  </div>

</div>
<div class="container" style="width: 45%;margin-right: 5%;margin-top: -15%"  >
  <div class="card mt-5" >
    <div class="card-body">
      <img src="<?php echo $upload_dir.$person->image; ?>" >
    </div>
  </div>
</div>
</div>
<?php require 'foter.php';?>

