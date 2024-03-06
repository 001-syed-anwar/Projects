<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include "header.php"; ?>
    <div id="test" class="container d-flex cont flex-column my-5">
        <div class="row text-center align-items-center justify-content-center  my-5">
            <?php echo ($_GET['content']) ?>
        </div>
        <div class="row text-center align-items-center justify-content-center  my-5">
            <div class="col-md-6">
                <select class="form-control" id="selectBox" size="5" onchange="updateSelectBox()">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "notes");
                    if (!$conn) {
                        die("connection error" . mysqli_connect_error());
                    } else {
                        $sql = "SELECT * FROM team_master";
                        if ($result = mysqli_query($conn, $sql)) {
                            while($row=mysqli_fetch_assoc($result)){
                                echo "<option id='".$row['ID']."' content='".$row['remark']."'>".$row['teamname']."</option>";
                            }
                          }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text" id="descriptionBox">Description will appear here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateSelectBox(){
            var selectBox=document.getElementById("selectBox");
            var content=selectBox.options[selectBox.selectedIndex].getAttribute("content");
            document.getElementById("descriptionBox").innerText=content;
        }
    </script>
</body>

</html>