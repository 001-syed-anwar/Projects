<?php
include("db.php");
session_start();
if ($_SESSION['loggedin']!=true) {
    header("location: index.php");
    session_regenerate_id(true);
    exit;
} else {
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
}


if (isset($_POST['search'])) {
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $flags = isset($_POST['flags']) ? mysqli_real_escape_string($conn, $_POST['flags']) : null;
    $types = isset($_POST['types']) ? mysqli_real_escape_string($conn, $_POST['types']) : null;

    $query = "SELECT * FROM postermaster WHERE keywords LIKE '%$item%'";

    if ($flags) {
        $flagsArray = explode(',', $flags);
        $flagsConditions = array();

        foreach ($flagsArray as $flag) {
            $flagsConditions[] = "FIND_IN_SET('$flag', Flags)";
        }

        $flagsCondition = implode(" OR ", $flagsConditions);
        $query .= " AND ($flagsCondition)";
    }

    if ($types && $types !== 'all') {
        $query .= " AND DocType = '$types'";
    }

    $result = mysqli_query($conn, $query);
    $data = array();

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(array("data" => "No data found"));
        }
    } else {
        echo json_encode(array("error" => "Query failed: " . mysqli_error($conn)));
    }
}




?>