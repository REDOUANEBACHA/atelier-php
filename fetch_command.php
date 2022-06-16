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
	SELECT commande.Id_commande,client.Nom_client,Date FROM commande join client  on commande.Num_client=client.Num_client 
	WHERE commande.Id_commande LIKE '%".$search."%'
	OR client.Nom_client LIKE '%".$search."%' 
	OR Date LIKE '%".$search."%'";

$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							 <th>Numéro commande</th>
                             <th>Nom client</th>
                             <th>Date</th>
                             <th>Action</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				   <td>'.$row['Id_commande'] .'</td>
            <td>' . $row['Nom_client']. '</td>
            <td>' . $row['Date']. '</td>
            <td><a href="voir_cmd.php?Id_commande='.$row['Id_commande'] .'" class="btn btn-info">Voir</a></td>
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