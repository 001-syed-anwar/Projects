<?php 
// Start the session at the beginning

include("db.php");

if (isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = "SELECT * from user_master WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hash=$row['password'];
       
        
        if(password_verify($password, $hash)) {
            $login=true;
            session_start();    
            $_SESSION['loggedin']=$login;
            $_SESSION["role"] = $row["role"];
            $_SESSION["username"] = $row["username"];
            header('location: index.php');
            exit; 
        } else {
            $_SESSION['error'] = 'Username or Password is Invalid';
        }
    } else {
        $_SESSION['error'] = 'Username or Password is Invalid';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Notings</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <style>
        .custom-btn{
            background-color: #6906a2;
            margin-top:20px;
            color:white;
            font-weight: bold;
            font-family: "Arial",sans-serif;
            transition: 0.5ms;
        }
        .custom-btn:hover{
            background: #8d27f3;
            color: #c3c0c0;
            font-weight: bold;
            font-family: "Arial",sans-serif;
            transition: 0.5ms;
        }
        @media only screen and (max-width: 756px){
           .cont{
               width:85% !important;
           } 
        }
      </style>
</head>
<body>
    <div class="container cont my-5 " style="width:40%;">
    <?php 
   
?>
 <h2 class="text-center mb-3">Login</h2>
 <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
 <?php
    if(isset($_SESSION['error'])){
      echo '<div id="emailHelp " class="form-text text-center mb-2 text-danger">'. $_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
  ?>
 <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" name="username" >
  <label for="floatingInput">Email address</label>
  
</div>
<div class="form-floating">
  <input type="password" class="form-control" id="floatingPassword" name="password" >
  <label for="floatingPassword">Password</label>
</div>
<button class="btn custom-btn" type="submit" name="submit" value="submit">submit</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
</body>
</html>