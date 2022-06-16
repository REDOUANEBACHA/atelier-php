

<?php require 'nav.php';?>
<body>
  
    <div class="container">
      <br />
      <br />
      <br />
      <h1 align="center" style="font-family: algerien"><u>Liste Commande</u></h1><br />
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">Rechercher</span>
          <input type="text" name="search_text" id="search_text" placeholder="Rechercher avec les detailles de commande" class="form-control" />
        </div>
      </div>
      <br />
      <div id="result"></div>

 
<br><br><br><br>





            <?php
// connect to database
$con = mysqli_connect('127.0.0.1','root','');
mysqli_select_db($con, 'gestion_de_stock');
// define how many results you want per page

$results_per_page = 20;
// find out the number of results stored in database
$sql='SELECT commande.Id_commande,client.Nom_client,Date FROM commande join client  on commande.Num_client=client.Num_client';
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
$sql='SELECT commande.Id_commande,client.Nom_client,Date FROM commande join client  on commande.Num_client=client.Num_client  LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($con, $sql);
echo ' <div class="container" id="tab" >
      <table class="table">
       <thead>
        <tr>
		   <th>Numéro commande</th>
           <th>Nom client</th>
           <th>Date</th>
           <th>Action</th>
		</tr></thead>';
while($row = mysqli_fetch_array($result)) {
  


  echo '<tbody><tr>
			<td>'.$row['Id_commande'] .'</td>
            <td>' . $row['Nom_client']. '</td>
            <td>' . $row['Date']. '</td>
            <td><a href="voir_cmd.php?Id_commande='.$row['Id_commande'] .'" class="btn btn-info">Voir</a></td>
          </tr></tbody>';
}


echo '<a href="recherche_cmd.php?page='.$Previous.'" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>';
				      
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="recherche_cmd.php?page=' . $page . '">' . $page . '</a> ';
  echo " . ";
}

echo' <a href="recherche_cmd.php?page='.$Next.'"  aria-label="Next">
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
			url:"fetch_command.php",
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