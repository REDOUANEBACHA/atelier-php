<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "gestion_de_stock";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


	$upload_dir = 'uploads/';

	/*if(isset($_GET['Ref_article'])){
		$Ref_article = $_GET['Ref_article'];
		$sql = "select * from article where Ref_article=".$Ref_article;
		/*$result = $conn->prepare($sql);
		$result->execute([':Ref_article' => $id ]);
        $row = $result->fetch(PDO::FETCH_OBJ);*/
		/*$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
		}else{
			$errorMsg = 'Could not select a record';
		}
	}*/
	$Ref_article = $_GET['Ref_article'];
$sql = 'SELECT * FROM article WHERE Ref_article=:Ref_article';
$statement = $conn->prepare($sql);
$statement->execute([':Ref_article' => $Ref_article ]);
$rows = $statement->fetch(PDO::FETCH_OBJ);

  

	if(isset($_POST['btnUpdate'])){
		$Ref_article = $_POST['Ref_article'];
        $Num_fournisseur = $_POST['Num_fournisseur'];
        $Nom_article = $_POST['Nom_article'];
        $Marque_article = $_POST['Marque_article'];
        $Type_article = $_POST['Type_article'];
        $categorie = $_POST['categorie'];
        $Quantite = $_POST['Quantite'];
        $Qte_alert = $_POST['Qte_alert'];
        $Description = $_POST['Description'];

		$imgName = $_FILES['myfile']['name'];
		$imgTmp = $_FILES['myfile']['tmp_name'];
		$imgSize = $_FILES['myfile']['size'];

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
  }

		//udate image if user select new image
		if($imgName){
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
					//delete old image
					unlink($upload_dir.$row['image']);
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}else{
			//if not select new image - use old image name
			$userPic = $row['image'];
		}

		//check upload file not error than insert data to database
		if(!isset($errorMsg)){
			$sql = "update  article
                  set Num_fournisseur = '".$Num_fournisseur."',
                    Nom_article = '".$Nom_article."',
                    Marque_article = '".$Marque_article."',
                    Type_article = '".$Type_article."',
                    categorie = '".$categorie."',
                    Quantite = '".$Quantite."',
                    Qte_alert = '".$Qte_alert."',
                    Description = '".$Description."',
                    image = '".$userPic."'
          where Ref_article=".$id;
				
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record updated successfully';
				header('refresh:5;index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}

	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Uploadimage</title>
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap-theme.min.css">
</head>
<body>

<div class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<h3 class="navbar-brand">PHP upload image</h3>
		</div>
	</div>
</div>
<div class="container">
	<div class="page-header">
		<h3>Add New
			<a class="btn btn-default" href="index.php">
				<span class="glyphicon glyphicon-arrow-left"></span> &nbsp;Back
			</a>
		</h3>
	</div>

	<?php
		if(isset($errorMsg)){		
	?>
		<div class="alert alert-danger">
			<span class="glyphicon glyphicon-info">
				<strong><?php echo $errorMsg; ?></strong>
			</span>
		</div>
	<?php
		}
	?>

	<?php
		if(isset($successMsg)){		
	?>
		<div class="alert alert-success">
			<span class="glyphicon glyphicon-info">
				<strong><?php echo $successMsg; ?> - redirecting</strong>
			</span>
		</div>
	<?php
		}
	?>

	<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
		<div class="form-group">
			<label for="Ref_article" class="col-md-2">Ref_article</label>
			<div class="col-md-10">
				<input type="text" name="name" class="form-control" value="<?php echo $row['Ref_article']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="Nom_article" class="col-md-2">Nom_article</label>
			<div class="col-md-10">
				<input type="text" name="name" class="form-control" value="<?php echo $row['Nom_article']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="Marque_article" class="col-md-2">Marque_article</label>
			<div class="col-md-10">
				<input type="text" name="name" class="form-control" value="<?php echo $row['Marque_article']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="Type_article" class="col-md-2">Type_article</label>
			<div class="col-md-10">
				<input type="text" name="position" class="form-control" value="<?php echo $row['Type_article'] ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="categorie" class="col-md-2">categorie</label>
			<div class="col-md-10">
				<input type="text" name="categorie" class="form-control" value="<?php echo $row['categorie']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="Quantite" class="col-md-2">Quantite</label>
			<div class="col-md-10">
				<input type="text" name="name" class="form-control" value="<?php echo $row['Nom_article']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="Qte_alert" class="col-md-2">Qte_alert</label>
			<div class="col-md-10">
				<input type="text" name="name" class="form-control" value="<?php echo $row['Qte_alert']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="Description" class="col-md-2">Description</label>
			<div class="col-md-10">
				<input type="text" name="name" class="form-control" value="<?php echo $row['Description']; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="image" class="col-md-2">Image</label>
			<div class="col-md-10">
				<img src="<?php echo $upload_dir.$row['image'] ?>" width="200">
				<input type="file" name="myfile">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2"></label>
			<div class="col-md-10">
				<button type="submit" class="btn btn-success" name="btnUpdate">
					<span class="glyphicon glyphicon-save"></span>Modifier
				</button>
			</div>
		</div>
	</form>
</div>

</body>
</html>