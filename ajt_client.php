<?php
  require_once('db.php');
 

  if(isset($_POST['btnSave'])){
    
  $Nom_client = $_POST['Nom_client'];
  $Prenom_client = $_POST['Prenom_client'];
  $telephone = $_POST['telephone'];
  $Departement = $_POST['Departement'];

    if(empty($Nom_client)){
      $errorMsg = 'Please input nom';
    }elseif(empty($Prenom_client)){
      $errorMsg = 'Please input prenom';
    }elseif(empty($telephone)){
      $errorMsg = 'Please input tele';
    }elseif(empty($Departement)){
      $errorMsg = 'Please input Departement';
    }
    //check upload file not error than insert data to database
    if(!isset($errorMsg)){
      $sql = "insert into client(Nom_client,Prenom_client,telephone,Departement)
          values('".$Nom_client."', '".$Prenom_client."','".$telephone."', '".$Departement."')";
       $statement = $connection->prepare($sql);

      if($statement->execute([':Nom_client'=> $Nom_client,':Prenom_client' => $Prenom_client, ':telephone' => $telephone, ':Departement' => $Departement])){
        
        header('refresh:5;ajt_client.php');
        echo '<body onLoad="alert(\'Client est inserer avec succée\')">';
      }else{
        
        echo '<body onLoad="alert(\'Erreur\')">';
      }
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
      <h2 style="text-align: center">Créer un client</h2>
    </div>

    <div class="card-body" >
      
       
      <form method="post" enctype="multipart/form-data">
        <div class="form-group col"><center>
        <label for="Nom_client">Nom client<input name="Nom_client" type="text" id="Nom_client"class="form-control " required="obligatoires"/></label><br>
        <label for="Prenom_client">Prénom client<input name="Prenom_client" type="text" id="Prenom_client"class="form-control" required="obligatoires"/></label><br>
        <label for="telephone">Téléphone<input name="telephone" type="text" id="telephone"class="form-control" required="obligatoires"/></label><br>
        <label for="Departement">Département<input name="Departement" type="text" id="Departement"class="form-control" required="obligatoires"/></label><br>
        </div></center>

        
        <div class="form-group">
          <button name="btnSave" type="submit" class="col-md-5 btn-info" onclick="return confirm('<?= $message; ?>')" style="border-radius: 4px;margin-left: 2%" > Ajouter Client</button><br><br>
          <a type="submit" class="col-md-5 btn-info" href="commander.php" style="border-radius: 4px;margin-left: 2%;text-align: center;" > Reteur</a><br><br>

        </div>
       
      </form>
    </div>
  </div>
</div>
</div> 
<div align="center" id="visible" style="visibility: visible;">
 <label>Cliquer pour ajouter un client :
 <input type="submit" value="client" onclick="visible()"  /></label>
</div>  
    <div class="container">
      <br />
      <br />
      <br />
      <h1 align="center" style="font-family: algerien"><u>Liste client</u></h1><br />
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
$sql='SELECT * FROM client';
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
$sql='SELECT * FROM client  LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($con, $sql);
echo ' <div class="container" id="tab" >
      <table class="table">
       <thead>
        <tr>
          <th>Numéro client </th>
          <th>Nom client</th>
          <th>Prénom client</th>
          <th>téléphone</th>
          <th>Département</th>
          <th>Action</th>
        </tr></thead>';
while($row = mysqli_fetch_array($result)) {
  


  echo '<tbody><tr>
            <td>'.$row['Num_client'] .'</td>
            <td>' . $row['Nom_client']. '</td>
            <td>' . $row['Prenom_client']. '</td>

            <td>' . $row['telephone']. '</td>
            <td>' . $row['Departement']. '</td>
            
            <td>
              <a href="mdf_client.php?Num_client='.$row['Num_client'] .'" class="btn btn-info">Modifier</a>
              
              <a href="ajt_cmd.php?Num_client='.$row['Num_client'] .'" class="btn btn-info" >Confirmer</a>
            </td>
          </tr></tbody>';
}


echo '<a href="ajt_client.php?page='.$Previous.'" aria-label="Previous">
                <span aria-hidden="true">&laquo; Previous</span>
              </a>';
              
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="ajt_client.php?page=' . $page . '">' . $page . '</a> ';
  echo " . ";
}

echo' <a href="ajt_client.php?page='.$Next.'"  aria-label="Next">
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
      url:"fetch_client.php",
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
