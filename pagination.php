<?php 
  include 'conne.php';
  
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($page - 1) * 3;
  $result = $conn->query("SELECT * FROM article LIMIT $start, 3");
  $customers = $result->fetch_all(MYSQLI_ASSOC);

  $result1 = $conn->query("SELECT count(Ref_article) AS Ref_article FROM article");
  $custCount = $result1->fetch_all(MYSQLI_ASSOC);
  $total = $custCount[0]['Ref_article'];
  $pages = ceil( $total / 3 );

  $Previous = $page - 1;
  $Next = $page + 1;

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Learn Web Coding > Pagination in PHP and MySQL </title>
  <link rel="stylesheet" type="text/css" href="../library/css/bootstrap.min.css"/>
  
</head>
<body>
  <div class="container well">
    <h1 class="text-center">Bootstrap Pagination in PHP and MySQL</h1>
    <div class="row">
      <div class="col-md-10">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li>
              <a href="pag.php?page=<?= $Previous; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo; Previous</span>
              </a>
            </li>
            <?php for($i = 1; $i<= $pages; $i++) : ?>
              <li><a href="pag.php?page=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endfor; ?>
            <li>
              <a href="pag.php?page=<?= $Next; ?>" aria-label="Next">
                <span aria-hidden="true">Next &raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
   
    </div>
    <div style="height: 600px; overflow-y: auto;">
      <table id="" class="table table-striped table-bordered">
            <thead>
                  <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Date</th>
                  </tr>
              </thead>
            <tbody>
              <?php foreach($customers as $customer) :  ?>
                <tr>
                  <td><?= $customer['Ref_article']; ?></td>
                  <td><?= $customer['Num_fournisseur']; ?></td>
                  <td><?= $customer['Nom_article']; ?></td>
                  <td><?= $customer['Marque_article']; ?></td>
                  <td><?= $customer['Type_article']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          
    </div>

<div style="position: fixed; bottom: 10px; right: 10px; color: green;">
        <strong>
            Learn Web Coding
        </strong>
</div>

</body>
</html>