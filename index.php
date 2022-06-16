<?php
   $con=mysqli_connect('127.0.0.1', 'root', '','gestion_de_stock');


$sql = "SELECT Count(*) FROM article where Quantite<=Qte_alert";
$result = mysqli_query($con,$sql);

$id_cmd=$result->fetch_row()[0];
if($id_cmd!=0){

  echo '<body onload="alert(\'Attention vous avez des articles ayant une quantité moins que la quantité alert !\')">';
}

?>









<?php
	require_once('db.php');
	$upload_dir = 'uploads/';

	if(isset($_POST['btnSave'])){
		$Ref_article = $_POST['Ref_article'];
        $Num_fournisseur = $_POST['Num_fournisseur'];
        $Nom_article = $_POST['Nom_article'];
        $Marque_article = $_POST['Marque_article'];
        $Type_article = $_POST['Type_article'];
        $categorie = $_POST['categorie'];
        $Quantite = $_POST['Quantite'];
        $Qte_alert = $_POST['Qte_alert'];
        $Description = $_POST['Description'];
		

		$imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

		if(empty($Ref_article)){
			$errorMsg = 'Please input ref';
		}elseif(empty($Num_fournisseur)){
			$errorMsg = 'Please select fournisseur';
		}elseif(empty($Nom_article)){
			$errorMsg = 'Please input nom';
		}elseif(empty($Marque_article)){
			$errorMsg = 'Please input marque';
		}elseif(empty($Type_article)){
			$errorMsg = 'Please input type';
		}elseif(empty($categorie)){
			$errorMsg = 'Please select categorie';
		}elseif(empty($Quantite)){
			$errorMsg = 'Please select quantite';
		}elseif(empty($Qte_alert)){
			$errorMsg = 'Please input quantite alert';
		}elseif(empty($Description)){
			$errorMsg = 'Please input description';
		}elseif(empty($imgName)){
			$errorMsg = 'Please select image';
		}else{
			//get image extension
			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
			//allow extenstion
			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
			//random new name for photo
			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
			//check a valid image
			if(in_array($imgExt, $allowExt)){
				//check image size less than 5MB
				if($imgSize < 5000000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}

		//check upload file not error than insert data to database
		if(!isset($errorMsg)){
			$sql = "insert into article(Ref_article,Num_fournisseur,Nom_article,Marque_article,Type_article,categorie,Quantite,Qte_alert,Description,image)
					values('".$Ref_article."', '".$Num_fournisseur."','".$Nom_article."', '".$Marque_article."','".$Type_article."', '".$categorie."','".$Quantite."', '".$Qte_alert."','".$Description."','".$userPic."')";
			 $statement = $connection->prepare($sql);

			if($statement->execute([':Ref_article'=> $Ref_article,':Num_fournisseur' => $Num_fournisseur, ':Nom_article' => $Nom_article, ':Marque_article' => $Marque_article, ':Type_article' => $Type_article, ':categorie' => $categorie, ':Quantite' => $Quantite, ':Qte_alert' => $Qte_alert,':Description' => $Description, ':image' => $userPic])){
				
				header('refresh:5;index.php');
				echo '<body onLoad="alert(\'Article est inserer avec succee\')">';
			}else{
				
				echo '<body onLoad="alert(\'Erreur\')">';
			}
		}
		else{
  	echo '<body onLoad="alert(\'image invalide\')">';
  }


	}
?>






<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Liste article</title>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link href="js/bootstrap.min.css" rel="stylesheet" />
		
	</head>

<?php require 'nav.php';?>
<body>
 <div id="form" style="display: none;">  
<div class="container" id="ajt"  style="width:50%" >

  <div class="card mt-5" >
    <div class="card-header">
      <h2 style="text-align: center">Créer un article</h2>
    </div>

    <div class="card-body" >
      
       
      <form method="post" enctype="multipart/form-data">
        <div class="form-group col"><center>
        <label for="Ref_article">Reference<input name="Ref_article" type="text" id="Ref_article"class="form-control " required="obligatoires"/></label><br>
        
        <label for="Num_fournisseur">Fournisseur
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
        <label for="Nom_article">Nom article<input name="Nom_article" type="text" id="Nom_article"class="form-control" required="obligatoires"/></label><br>
        <label for="Marque_article">Marque<input name="Marque_article" type="text" id="Marque_article"class="form-control" required="obligatoires"/></label><br>
        <label for="Type_article">Type<input name="Type_article" type="text" id="Type_article"class="form-control" required="obligatoires"/></label><br>
        <label for="Quantite">Quantité<input name="Quantite" type="text" id="Quantite"class="form-control" required="obligatoires"/></label><br>
        <label for="Qte_alert">Quantité alert<input name="Qte_alert" type="text" id="Qte_alert"class="form-control" required="obligatoires"/></label><br>
        <label for="image">image<input name="image" type="file" id="image"class="form-control" required="obligatoires"/></label><br>
        <label for="Description">Déscription<textarea type="text"  name="Description" id="Description" class="form-control" required="obligatoires"></textarea></label>
        </div></center>

        
        <div class="form-group">
          <button name="btnSave" type="submit" class="col-md-5 btn-info" onclick="return confirm('<?= $message; ?>')" style="border-radius: 4px;margin-left: 2%" > Ajouter Article</button><br><br>
          <a type="submit" class="col-md-5 btn-info" href="ajt_fournisseur.php" style="border-radius: 4px;margin-left: 2%;text-align: center;" > Ajouter Fournisseur</a><br><br>
          <a type="submit" class="col-md-5 btn-info" href="ajt_categorie.php" style="border-radius: 4px;margin-left: 2%;text-align: center;" > Ajouter Catégorie</a><br><br>

        </div>
       
      </form>
    </div>
  </div>
</div>
</div> 
<div align="center" id="visible" style="visibility: visible;">
 <label>Cliquer pour ajouter un article :
 <input type="submit" value="Article" onclick="visible()"  /></label>
</div>	
		<div class="container">
			<br />
			<br />
			<br />
			<h1 align="center" style="font-family: algerien"><u>Liste Article</u></h1><br />
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Rechercher</span>
					<input type="text" name="search_text" id="search_text" placeholder="Rechercher avec les detailles de l'article" class="form-control" />
				</div>
			</div>
			<br />
			<div id="result"></div>


            <?php
// connect to database
$con = mysqli_connect('127.0.0.1','root','');
mysqli_select_db($con, 'gestion_de_stock');
// define how many results you want per page

$results_per_page = 20;
// find out the number of results stored in database
$sql='SELECT * FROM article';
$result = mysqli_query($con, $sql);
$number_of_results = mysqli_num_rows($result);
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}
if($page==1){
	$Previous =1;
}else{
	$Previous = $page - 1;
}

if($page==$number_of_pages){
	$Next=$number_of_pages;
   
}else{
	 $Next = $page + 1;
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page
$sql='SELECT * FROM article ORDER BY Quantite<=Qte_alert LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($con, $sql);
echo ' <div class="container" id="tab" >
      <table class="table">
       <thead>
        <tr>
          <th>Réference</th>
           <th>Fournisseur</th>
		  <th>Nom article</th>
		  <th>Marque</th>
		  <th>Type</th>
		  <th>Catégorie</th>
		  <th>Quantite</th>
          <th>Action</th>
        </tr></thead>';
while($row = mysqli_fetch_array($result)) {
  


  echo '<tbody><tr>
            <td>'.$row['Ref_article'] .'</td>
            <td>' . $row['Num_fournisseur']. '</td>
            <td>' . $row['Nom_article']. '</td>

            <td>' . $row['Marque_article']. '</td>
            <td>' . $row['Type_article']. '</td>
            <td>' . $row['categorie']. '</td>
            <td>' . $row['Quantite']. '</td>
            <td>
              <a href="edit.php?Ref_article='.$row['Ref_article'] .'" class="btn btn-info">Modifier</a>
              <a onclick="return confirm("\'Voullez vous supprimer cette article?\'"")" href="delete.php?Ref_article='.$row['Ref_article'] .'" class="btn btn-danger">Supprimer</a>
              <a href="article.php?Ref_article='.$row['Ref_article'] .'" class="btn btn-info">Voir</a>
            </td>
          </tr></tbody>';
}


echo '<a href="index.php?page='.$Previous.'" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>';
				      
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';
  echo " . ";
}

echo' <a href="index.php?page='.$Next.'"  aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a> </div> </table>';
				      
?>
<br><br><br><br>




		</div>
		<div style="clear:both"></div>
		


<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
			document.getElementById("tab").style.visibility="hidden";
		}
		else
		{
			load_data();
			document.getElementById("tab").style.visibility="visible";			
		}
	});
});
</script>

  
</div>
<script type="text/javascript">
	function visible(){
		x=document.getElementById("form");
		if(x.style.display==="none")
		{

			x.style.display="block";
			document.getElementById("visible").style.visibility="hidden";
		} else{

         x.style.display="none";
		}

	}

</script>

	</body>

<?php require 'foter.php';?>
</html>





