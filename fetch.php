<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "gestion_de_stock";

	// Create connection
	$connect = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($connect->connect_error) {
	    die("Connection failed: " . $connect->connect_error);
	}




$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM article 
	WHERE Type_article LIKE '%".$search."%'
	OR Ref_article LIKE '%".$search."%' 
	OR Quantite LIKE '%".$search."%'
	OR categorie LIKE '%".$search."%' 
	OR Num_fournisseur LIKE '%".$search."%' 
	OR Nom_article LIKE '%".$search."%'
	OR Marque_article LIKE '%".$search."%'
	ORDER BY Quantite<=Qte_alert";

$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Réference</th>
							<th>Fournisseur</th>
							<th>Nom article</th>
							<th>Marque</th>
							<th>Type</th>
							<th>Catégorie</th>
							<th>Quantite</th>
							<th>Action</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["Ref_article"].'</td>
				<td>'.$row["Num_fournisseur"].'</td>
				<td>'.$row["Nom_article"].'</td>
				<td>'.$row["Marque_article"].'</td>
				<td>'.$row["Type_article"].'</td>
				<td>'.$row["categorie"].'</td>
				<td>'.$row["Quantite"].'</td>
				<td><a href="edit.php?Ref_article='.$row["Ref_article"].'" class="btn btn-info">Modifier</a>
              <a onclick="return confirm("Voullez vous supprimer cette article?")" href="delete.php?Ref_article='.$row["Ref_article"].'" class="btn btn-danger">Supprimer</a>
              <a href="article.php?Ref_article='.$row["Ref_article"].'" class="btn btn-info">Voir</a>
			</tr>
		';
	}
	$output .='</table></div>';
	echo $output;

 

}
else
{
	echo 'tableau est vide';
}
}
?>