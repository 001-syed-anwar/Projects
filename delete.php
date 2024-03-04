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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if posterID is set
    if (isset($_GET['id'])) {
        $posterID = $_GET['id'];
        $deleteQuery = "DELETE FROM postermaster WHERE posterID = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $posterID);

        if ($stmt->execute()) {
            // Delete successful
            $stmt->close();
            $conn->close();
            $_SESSION['success']="Poster Deleted Successfully";
            header("Location: admin.php");
            exit();
        } else {
            // Delete failed
            $stmt->close();
            $conn->close();
            $_SESSION['error']="Error Deleting a Poster";
            header("Location: admin.php");
            exit();
        }
    } else {
        // posterID is not set
        $_SESSION['error']="Poster ID Not found";
        header("Location: admin.php");
        exit();
    }
}

