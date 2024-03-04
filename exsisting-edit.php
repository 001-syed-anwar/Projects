<?php  	
require __DIR__ . '/vendor/autoload.php';   
use setasign\Fpdi\Fpdi;                                                                                                                                                                                                                                                                                                                                                                                           
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
global $masterid;


function getid() {
  include("db.php");
  $sql = "SELECT posterDetail_ID FROM posterdetails ORDER BY posterDetail_ID DESC LIMIT 1";
  // Execute the query and fetch the result
  $result = mysqli_query($conn, $sql);

  if ($result) {
      $row = mysqli_fetch_assoc($result);
      $lastId = $row['posterDetail_ID'];
      return $lastId;
  } else {
      
      echo "Query failed: " . mysqli_error($conn);
      return false;
  }
}

$Refdtpos='';
$Refnumpos='';
$CompanyNamepos='';
$Contactpersonpos='';
$Execnamepos='';
$Execnumpos='';
$descpos='';
$amt='';
$totalpos='';
$existingImagePath='';
$data=array();
$path='';
$file_name='';
$downloadname='';

if(isset($_GET['id'])){

  
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $sql="SELECT * FROM postermaster WHERE posterID='$id'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
            $_SESSION['data']=$data;
        }
    }
    else{
        echo "No data found";
        exit();
    }
  
}
function getColorCode($colorName) {
    $colors = [
        'black' => '000000',
        'white' => 'FFFFFF',
        'red' => 'FF0000',
        'green' => '00FF00',
        'blue' => '0000FF',
       
    ];

    return isset($colors[$colorName]) ? $colors[$colorName] : '000000'; 
}



if (isset($_POST['submit'])) {
  $data=$_SESSION['data'];

  $companyname = isset($_POST['companyname']) ? mysqli_real_escape_string($conn, $_POST['companyname']) : "";
$date = isset($_POST['refdate']) ? mysqli_real_escape_string($conn, $_POST['refdate']) : "";
$refno = isset($_POST['refno']) ? mysqli_real_escape_string($conn, $_POST['refno']) : "";
$amount = isset($_POST['total']) ? mysqli_real_escape_string($conn, $_POST['total']) : "";
$executive_name = isset($_POST['executivename']) ? mysqli_real_escape_string($conn, $_POST['executivename']) : "";
$executive_num = isset($_POST['executivemobile']) ? mysqli_real_escape_string($conn, $_POST['executivemobile']) : "";
$desc = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : "";
$salevalue = isset($_POST['salevalue']) ? mysqli_real_escape_string($conn, $_POST['salevalue']) : "";
$ContactPerson = isset($_POST['contactperson']) ? mysqli_real_escape_string($conn, $_POST['contactperson']) : "";
$ContactMobile = isset($_POST['contactmobile']) ? mysqli_real_escape_string($conn, $_POST['contactmobile']) : "";
$Tax = isset($_POST['tax']) ? mysqli_real_escape_string($conn, $_POST['tax']) : "";
$type = isset($_POST['type']) ? mysqli_real_escape_string($conn, $_POST['type']) : "";

  
    foreach ($data as $post) {
       
      $Refdtpos=$post['RefDatepos'];
      $posterid=$post['posterID'];
      $postercode=$post['posterCode'];
      $product=$post['Product'];
      $postername=$post['posterName'];
      $Refnumpos=$post['RefNopos'];
      $CompanyNamepos=$post['CompanyNamepos'];
      $Contactpersonpos=$post['ContactMobilepos'];
      $Execnamepos=$post['ExecutiveNamePos'];
      $Execnumpos=$post['ExecutiveMobilePos'];
      $Taxpos=$post['TaxPos'];
      $descpos=$post['Descriptionpos'];
      $amt=$post['SaleValuepos'];
      $totalpos=$post['TotalPos'];
      $file_name = $post['file_name'];
      $filetype=$post['DocType'];
      $downloadname=$post['downloadFilename'];
      if($filetype=="poster"){
          $path="./poster";

      }
      else{
          $path="./quotation";
      }
     
  }
  $existingFilePath = "$path"."/"."$file_name"; 
  $textPos = [
    'CompanyName' => isset($companyname)? $CompanyNamepos:"0/0/0/black",
    'RefDate' => isset($date)? $Refdtpos:"0/0/0/black",
    'Amount' => isset($amount)? $amt:"0/0/0/black",
    'RefNo' =>isset($refno)? $Refnumpos:"0/0/0/black",
    'Tax' => isset($Tax)? $Taxpos:"0/0/0/black",
    'ExecName' =>isset($executive_name)? $Execnamepos:"0/0/0/black",
    'ExecNum' => isset($executive_num)? $Execnumpos:"0/0/0/black",
    'Description' => isset($desc)? $descpos:"0/0/0/black",
];

$textData = [
    'CompanyName' => $companyname,
    'RefDate' => $date,
    'Amount' => $amount,
    'RefNo' => $refno,
    'Tax' => $Tax,
    'ExecName' => $executive_name,
    'ExecNum' => $executive_num,
    'Description' => $desc,
];
  if($filetype =="quotation"){

 
    $pdf = new Fpdi();
    $existingPdfPath = "$path"."/"."$file_name";


    $pageCount = $pdf->setSourceFile($existingPdfPath);
    $tplId = $pdf->importPage(1); 

    $pdf->AddPage();
    $pdf->useTemplate($tplId, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());

    $pdf->SetMargins(10, 10, 10);
   
    $posterDetail_ID=getid();
    $posterDetail_ID+=1;
    $insert="INSERT INTO posterdetails (posterDetail_ID,companyID,posterID,posterCode,posterName,RefDate,RefNo,CompanyName,ContactPerson,ContactMobile,SaleValue,Description,Tax,Total,ExecutiveName,ExecutiveMobile,Product,Remark,CreatedDate,CreatedBy) VALUES('$posterDetail_ID',NULL,'$posterid','$postercode','$postername','$date','$refno','$companyname',NULL,NULL,'$amount','$desc','$Tax','$amt','$executive_name','$executive_num','$product',NULL,CURRENT_TIMESTAMP,'$username')";
    $res=mysqli_query($conn,$insert);
    if($res){
      echo "<script>alert('Success')</script>";

    }
    else{
      echo mysqli_error($conn);
     
    }
   
    foreach ($textPos as $variableName => $textInfo) {
        list($x, $y, $fontSize, $color) = explode('/', $textInfo);

 
        $colorCode = getColorCode($color);
        list($r, $g, $b) = sscanf($colorCode, "%02x%02x%02x");
        $pdf->SetFont('Arial', '', $fontSize);
        $pdf->SetTextColor($r, $g, $b);

        
        $text = $textData[$variableName] ?? ''; 
      
        $pdf->SetXY($x, $y);
        $pdf->Cell(3000, 50, $text,0,1);
      }
      $outputFilePath = "./uploads/" . $file_name;
      $pdf->Output($outputFilePath, 'F');
   
     

      // Download the PDF
      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . basename($downloadname) . '"');
    
      readfile($outputFilePath);
      
  
  }
  else{
      $imagePath = "./poster/".$file_name;
      $imageInfo = getimagesize($imagePath);
      $imageType = $imageInfo[2];
      
      switch ($imageType) {
          case IMAGETYPE_JPEG:
              $image = imagecreatefromjpeg($imagePath);
              break;
          case IMAGETYPE_PNG:
              $image = imagecreatefrompng($imagePath);
              break;
          default:
              die("Unsupported image type");
      }
        
      
      foreach ($textPos as $variableName => $textInfo) {
      //  list($x, $y, $fontSize, $color) = explode('/', $textInfo);
        $textInfoParts = explode('/', $textInfo);
        $x = isset($textInfoParts[0]) ? intval($textInfoParts[0]) : 0; // Convert to integer or use default
        $y = isset($textInfoParts[1]) ? intval($textInfoParts[1]) : 0; // Convert to integer or use default
        $fontSize = isset($textInfoParts[2]) ? intval($textInfoParts[2]) : 12; // Convert to integer or use default
        $color = isset($textInfoParts[3]) ? $textInfoParts[3] : 'black'; // 
        $colorCode = getColorCode($color);
        list($r, $g, $b) = sscanf($colorCode, "%02x%02x%02x");
  

       
        $text = $textData[$variableName] ?? ''; 
        
        $fontFile = './fonts/Poppins-SemiBold.ttf'; 
          $fontColor = imagecolorallocate($image, $r, $g, $b);
        
       
         imagettftext($image, $fontSize, 0, $x+125, $y+405, $fontColor, $fontFile, $text);

       
      }
        $modifiedImagePath = "./uploads/".$file_name;
      imagejpeg($image,$modifiedImagePath);
       
       
        if($type=='PDF'){
          require('./vendor/fpdf.php');
          
          $pdf = new FPDF('P', 'mm', 'A4');
          $pdf->AddPage();
       

          
          list($imgWidth, $imgHeight) = getimagesize($modifiedImagePath);

          
          $aspectRatio = $imgWidth / $imgHeight;

         
          $pdfWidth = $pdf->GetPageWidth();
          $pdfHeight = $pdfWidth / $aspectRatio;

        
          $pdf->Image($modifiedImagePath, 0, 0, $pdfWidth, $pdfHeight);

    
          $pdf->Output($file_name, 'D');
          header('Content-Type: application/pdf');
          header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        
          readfile($outputFilePath);
          $posterDetail_ID=getid();
          $posterDetail_ID+=1;
          $insert="INSERT INTO posterdetails (posterDetail_ID,companyID,posterID,posterCode,posterName,RefDate,RefNo,CompanyName,ContactPerson,ContactMobile,SaleValue,Description,Tax,Total,ExecutiveName,ExecutiveMobile,Product,Remark,CreatedDate,CreatedBy) VALUES('$posterDetail_ID','$masterid','$posterid','$postercode','$postername','$date','$refno','$companyname',NULL,NULL,'$salevalue','$desc','$Tax','$amt','$executive_name','$executive_num','$product',NULL,CURRENT_TIMESTAMP,'$username')";
          $res=mysqli_query($conn,$insert);
          if($res){
            echo "<script>alert('Success')</script>";
            unset($_SESSION['masterid']);
            unset($_SESSION['companyname']);
            
      
          }
          else{
            echo mysqli_error($conn);
           
          }
        }
        else{
          $posterDetail_ID=getid();
          $posterDetail_ID+=1;
          $insert="INSERT INTO posterdetails (posterDetail_ID,companyID,posterID,posterCode,posterName,RefDate,RefNo,CompanyName,ContactPerson,ContactMobile,SaleValue,Description,Tax,Total,ExecutiveName,ExecutiveMobile,Product,Remark,CreatedDate,CreatedBy) VALUES('$posterDetail_ID','$masterid','$posterid','$postercode','$postername','$date','$refno','$companyname',NULL,NULL,'$salevalue','$desc','$Tax','$amt','$executive_name','$executive_num','$product',NULL,CURRENT_TIMESTAMP,'$username')";
          $res=mysqli_query($conn,$insert);
          if($res){
            echo "<script>alert('Success')</script>";
            unset($_SESSION['masterid']);
            unset($_SESSION['companyname']);
        

            header("location:".$modifiedImagePath);
            
// readfile($modifiedImagePath);
     
          }
          else{
            echo mysqli_error($conn);
           
          }

        }


      }
    

    
  
   
}
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobilo</title>
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
    <div class="text-center h3">Document Editor</div>
   
<div class="row my-5 justify-content-center" >
  <?php 
  
  if (!empty($data)) {
    foreach ($data as $poster) {
        // Extract necessary information
        $posterID = $poster['posterID'];
        $posterName = $poster['posterName'];
        $file_name = $poster['file_name'];
        $filetype=$poster['DocType'];
        if($filetype=="poster"){
            $path="./poster";
        }
        else{
            $path="./quotation";
        }
        // Display card structure
        echo '<div class="card" style="width: 18rem;">';
        echo '<img src=" '.$path.'/' . $file_name .'" class="card-img-top" alt="image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $posterName . '</h5>';
        echo '<p class="card-text">ID: ' . $posterID . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No data found";
}
  
  ?>

    <div class="card my-4">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 
  <?php 
  $id=$_GET['id'];
  $companyname=$_SESSION['companyname'];
  $sql = "SHOW COLUMNS FROM postermaster";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $selectedColumns = array();

    // Fetch all column names
    $allColumns = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $i = 0; // Initialize the counter

    foreach ($allColumns as $column) {
      $columnName = $column['Field'];
  
      
      if (preg_match('/[Pp][Oo][Ss]$/', $columnName)) {
    
          $checkSql = "SELECT COUNT(*) FROM postermaster WHERE $columnName IS NOT NULL";
          $checkResult = mysqli_query($conn, $checkSql);
  
          if ($checkResult) {
             
  
              $selectedColumns[$i] = $columnName;
              $i++;
             
              
              // if ($count > 0) {
              // }
          } else {
              // Handle the case where the check query failed
              echo "Check query failed: " . mysqli_error($conn);
          }
      }
  } 

  $selectedFinal = array();
  $j = 0;
  
  // Construct the conditions for each column
  $conditions = array();
  foreach ($selectedColumns as $col) {
      $conditions[] = "$col IS NOT NULL";
  }
  
  // Combine conditions with AND
  $conditionsString = implode(' AND ', $conditions);
  
  // Construct the final SQL query
  $checkSql1 = "SELECT * FROM postermaster WHERE $conditionsString";
  
  $checkResult1 = mysqli_query($conn, $checkSql1);
  
  if ($checkResult1) {
      while ($row = mysqli_fetch_assoc($checkResult1)) {
          // Collect the rows where all selected columns are not NULL
          $selectedFinal[] = $row;
      }
  } else {
      echo "Check query failed: " . mysqli_error($conn);
  }
    // Build the SELECT part of the query
    $selectPart = implode(', ', $selectedColumns);


    // Full SQL query with the dynamically selected columns
    $fullSql = "SELECT $selectPart FROM postermaster WHERE posterID=$id";
   
    // Execute the query and get the result
    $result = mysqli_query($conn, $fullSql);
    if ($result) {
  
        // Fetch the row from the result set
        while ($row = mysqli_fetch_assoc($result)) {
          foreach ($row as $columnName => $value) {
              // Check if the column name ends with 'Pos' or 'pos'
              if (preg_match('/[Pp][Oo][Ss]$/', $columnName)) {
                  // Remove 'Pos' or 'pos' from the end of the column name
                  $label = ucfirst(preg_replace('/[0-9]*[Pp][Oo][Ss]$/', '', $columnName));
                  if (!empty($value) && $value!="NULL") {
                    if($label=="CompanyName"){
                      echo '<div class="mb-3">
                      <label for="' . $columnName . '" class="form-label">' . $label . '</label>
                      <input name="' . strtolower($label) . '" type="text" class="form-control" id="' . $columnName . '" aria-describedby="' . $columnName . '" placeholder="' . $label . '" value="' . $companyname. '">
                    </div>';
                    }
                    else{

                      echo '<div class="mb-3">
                              <label for="' . $columnName . '" class="form-label">' . $label . '</label>
                              <input name="' . strtolower($label) . '" type="text" class="form-control" id="' . $columnName . '" aria-describedby="' . $columnName . '" placeholder="' . $label . '">
                            </div>';
                    }
                  }
              }
          }
          
      }
       
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
} else {
    echo "Fetching column names failed: " . mysqli_error($conn);
}


  ?>
     <input name="id" type="hidden" class="form-control" value="<?php echo $_GET['id']; ?>">
  <div class="mb-3">
    <label for="executive" class="form-label">Type</label>
   <select name="type" id="type" class="form-select">
    <option selected>
    Select
    </option>
    <option name="PDF">
    PDF
    </option>
    <option name="img">
    Image
    </option>
   </select>
  </div>
 
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
    </div>

</div>




</body>
</html>