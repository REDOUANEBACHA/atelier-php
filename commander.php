
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
	   <div class="container">
			<br />
			<br />
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Menu</span>
						<span class="glyphicon glyphicon-menu-hamburger"></span>
						</button>
						<a class="navbar-brand" href="/">Panier</a>
					</div>
					
					<div id="navbar-cart" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li>
								<a id="cart-popover" class="btn" data-placement="bottom" title="Liste de commande">
									<span class="glyphicon glyphicon-shopping-cart"></span>
									<span class="badge"></span>
								</a>
							</li>
						</ul>
					</div>
					
				</div>
			</nav>
			<div id="popover_content_wrapper" style="display: none">
				<span id="cart_details"></span>
				<div align="right">
					<a href="ajt_client.php" class="btn btn-primary" id="check_out_cart">
					<span class="glyphicon glyphicon-shopping-cart"></span> Commander
					</a>
					<a href="#" class="btn btn-default" id="clear_cart">
					<span class="glyphicon glyphicon-trash"></span> Supprimer
					</a>
				</div>
			</div>

			<div id="display_item">


			</div>
			
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
		  <th>Nom article</th>
		  <th>Marque</th>
		  <th>Type</th>
		  <th>Catégorie</th>
		  <th>Quantite</th>
		  <th>Quantité commander</th>
          <th>Action</th>
        </tr></thead>';
while($row = mysqli_fetch_array($result)) {
  


  echo '<tbody><tr>
            <td>'.$row['Ref_article'] .'</td>
           
            <td ><input type="hidden" name="hidden_name" id="name'.$row["Ref_article"].'" value="'.$row["Nom_article"].'" />' . $row['Nom_article']. '</td>
            
            
            <td>' . $row['Marque_article']. '</td>
            <td>' . $row['Type_article']. '</td>
            <td>' . $row['categorie']. '</td>
            <td ><input type="hidden" name="hidden_name" id="Qte'.$row["Ref_article"].'" value="'.$row["Quantite"].'" />' . $row['Quantite']. '</td>
            <td><input type="text" name="quantity" id="quantity'.$row["Ref_article"].'" class="form-control"  /></td>
            <td>
              
              <input type="button" name="add_to_cart" id="'.$row["Ref_article"].'" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Ajouter" />
            </td>
          </tr></tbody>';
}

echo '<a href="commander.php?page='.$Previous.'" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>';
				      
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="commander.php?page=' . $page . '">' . $page . '</a>';
  echo " . ";
}

echo' <a href="commander.php?page='.$Next.'"  aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a> </div></table>';
				      
?>





		</div>
		<div style="clear:both"></div>
		<br />
		
		<br />
		<br />
		<br />


<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch_cmd.php",
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

  <br>
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



<script>  
$(document).ready(function(){

	load_product();

	load_cart_data();
    
	function load_product()
	{
		$.ajax({
			url:"fetch_item.php",
			method:"POST",
			success:function(data)
			{
				$('#display_item').html(data);
			}
		});
	}

	function load_cart_data()
	{
		$.ajax({
			url:"fetch_cart.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
				$('#cart_details').html(data.cart_details);
			}
		});
	}

	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});

	$(document).on('click', '.add_to_cart', function(){
		var product_id = $(this).attr("id");
		var product_name = $('#name'+product_id+'').val();
		var product_quantity = $('#quantity'+product_id).val();
		var action = "add";
		if(product_quantity > 0)
		{
			
         
                  
		    	
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{product_id:product_id, product_name:product_name, product_quantity:product_quantity, action:action},
				success:function(data)
				{
					load_cart_data();
					alert("l'article est ajouter au panier");						
				}
			});
		   
		   
		}
		else
		{
			alert("Entrer la quantité");
		}
	});

	$(document).on('click', '.delete', function(){
		var product_id = $(this).attr("id");
		var action = 'remove';
		if(confirm("Voulez vous supprimer cette article?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{product_id:product_id, action:action},
				success:function()
				{
					load_cart_data();
					$('#cart-popover').popover('hide');
					alert("Article est supprimer");
				}
			})
		}
		else
		{
			return false;
		}
	});

	$(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				alert("Panier est vide");
			}
		});
	});
    
});

</script>

	</body>
</html>


<?php require 'foter.php';?>


