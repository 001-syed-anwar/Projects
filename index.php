<?php
session_start();
include("db.php");
if ($_SESSION['loggedin'] != true) {
  header("location: login.php");
  exit;
} else {
  $role = $_SESSION['role'];
  $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mobilo</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&family=Montserrat:ital,wght@0,500;0,700;1,300&family=Open+Sans:ital,wght@0,400;1,600&family=Orbitron&family=Poppins:ital,wght@0,400;0,500;0,900;1,200;1,400;1,600&display=swap"
    rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- Or for RTL support -->


  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <style>
    @media screen and (max-width:756px) {
      .custom-nav {
        width: 100%;
        display: flex;
        justify-content: space-between;
      }
    }
  </style>
</head>

<body>
  <?php include "header.php"; ?>
  <div class="text-center">
    <h1 class="" style="color:black;margin-top:10rem;">Dashboard</h1>
  </div>
</body>

</html>