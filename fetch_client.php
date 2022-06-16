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
	SELECT * FROM client 
	WHERE Num_client LIKE '%".$search."%'
	OR Nom_client LIKE '%".$search."%' 
	OR Prenom_client LIKE '%".$search."%'
	OR telephone LIKE '%".$search."%' 
	OR Departement LIKE '%".$search."%' ";

$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
          <th>Numéro client </th>
          <th>Nom client</th>
          <th>Prénom client</th>
          <th>téléphone</th>
          <th>Département</th>
          <th>Action</th>
        </tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row['Num_client'] .'</td>
            <td>' . $row['Nom_client']. '</td>
            <td>' . $row['Prenom_client']. '</td>

            <td>' . $row['telephone']. '</td>
            <td>' . $row['Departement']. '</td>
				<td><a href="mdf_client.php?Num_client='.$row["Num_client"].'" class="btn btn-info">Modifier</a>
             
              <a href="Band_livraison.php?Num_client='.$row["Num_client"].'" class="btn btn-info">Confirmer</a>
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