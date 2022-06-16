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
							<th>Nom article</th>
							<th>Marque</th>
							<th>Type</th>
							<th>Catégorie</th>
							<th>Quantite</th>
							<th>Quantité commander</th>
							<th>Action</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["Ref_article"].'</td>
				<td><input type="hidden" name="hidden_name" id="name'.$row["Ref_article"].'" value="'.$row["Nom_article"].'" />'.$row["Nom_article"].'</td>
				
				<td>'.$row["Marque_article"].'</td>
				<td>'.$row["Type_article"].'</td>
				<td>'.$row["categorie"].'</td>
				<td ><input type="hidden" name="hidden_name" id="Qte'.$row["Ref_article"].'" value="'.$row["Quantite"].'" />' . $row['Quantite']. '</td>
				<td><input type="text" name="quantity" id="quantity'.$row["Ref_article"].'" class="form-control"  /></td>
				<td><input type="button" name="add_to_cart" id="'.$row["Ref_article"].'" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Ajouter" /></td>
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