<?php
include("db.php");
if ($_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
} else {
  $role = $_SESSION['role'];
  $username = $_SESSION['username'];
}
?>
<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-primary" href="#" role="button" data-bs-toggle="dropdown"
      aria-expanded="false" style="color:blue !important">
      Notes
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="./notes.php">Add New</a></li>
    </ul>
  </li>
</ul>