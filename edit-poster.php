<?php
session_start();
include("db.php");
if($_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}
else{
  $role=$_SESSION['role'];
  $username=$_SESSION['username'];
}
           ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobilo-Find Poster</title>
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&family=Montserrat:ital,wght@0,500;0,700;1,300&family=Open+Sans:ital,wght@0,400;1,600&family=Orbitron&family=Poppins:ital,wght@0,400;0,500;0,900;1,200;1,400;1,600&display=swap" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->


<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script
			  src="https://code.jquery.com/jquery-3.7.1.min.js"
			  ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
  @media screen and (max-width:756px) {
  .custom-nav{
    width: 100%;
    display: flex;
    justify-content: space-between;
  }
}
</style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Mobilo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Mobilo</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body ">
      <?php include "nav.php"; ?>
        
      </div>
    </div>
  </div>
</nav>

 

<div class="container my-5 p-5">
    <div class="text-center h3">Find Poster</div>
   
<div class="row my-5 justify-content-center" >
  <div class="col-md-3 mb-5" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="">
  
  <label>Search</label>
    <input  type="search" class="form-control rounded" name="item" id="live_search" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
    

  </div>
 
  
<div class="col-md-3">
<label class="" >&nbsp;</label>
  <button type="submit" name="search" class="form-control btn btn-primary">Search</button>
</div>
</div>




<?php 
if (isset($_POST['search'])) {
  $item = mysqli_real_escape_string($conn, $_POST['item']);

  $query = "SELECT * FROM postermaster WHERE posterName LIKE '%$item%' LIMIT 20";
  $result = mysqli_query($conn, $query);
  


  if ($result) {
      if (mysqli_num_rows($result) > 0) {
          echo '<div class="card my-2 col-md-12 mb-3 " id="search-container" style="width:97%;">';
          $i=1;
          while ($row = mysqli_fetch_assoc($result)) {
              echo '  <a  class="col-xs-12 col-md-6 col-lg-3 mb-3"
              href="modify.php?id='.$row['posterID'].'">
              <div class="card" style="width:97%;"> 
              <h3 class="card__title">'.$i.'.'.$row['posterName'].'</h3>
              </div>
              </a>';
              $i++;
          }
          echo '</div>';
      } else {
          echo "No data found";
      }
  } else {
      echo "Something Went Wrong";
  }
}

  


 

// </div>`;
?>
</form>
</div>





</body>
</html>
