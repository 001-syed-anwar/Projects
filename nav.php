<?php 
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
<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./"  style="color:blue;">Home</a>
          </li>
          
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:blue !important">
           Docker
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./doc.php">New Poster</a></li>
            <li><a class="dropdown-item" href="./master.php">New Design</a></li>
            <li><a class="dropdown-item" href="./findposter.php">Position Finding</a></li>
            <?php 
            if($_SESSION['role']=="admin"){
                echo  '<li><a class="dropdown-item" href="./admin.php">Poster Master</a></li>';
            }
            ?>
           
          </ul>
        </li>

          
       

          <li class="nav-item">
            <a class="nav-link" href="../sms/" style="color:blue;">SMSTemplate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php" style="color:blue;">logout</a>
          </li>
          
        </ul>