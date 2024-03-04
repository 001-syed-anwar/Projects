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

if(isset($_GET['id'])){
    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $masterid=mysqli_real_escape_string($conn,$_GET['masterid']);
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

    $companyname=mysqli_real_escape_string($conn,$_POST['companyname']);
    $date=mysqli_real_escape_string($conn,$_POST['refdate']);
    $refno=mysqli_real_escape_string($conn,$_POST['refno']);
    $amount=mysqli_real_escape_string($conn,$_POST['total']);
    $executive_name=mysqli_real_escape_string($conn,$_POST['executivename']);
    $executive_num=mysqli_real_escape_string($conn,$_POST['executivemobile']);
    $desc=mysqli_real_escape_string($conn,$_POST['description']);
    $salevalue=mysqli_real_escape_string($conn,$_POST['salevalue']);
    $ContactPerson=mysqli_real_escape_string($conn,$_POST['contactperson']);
    $ContactMobile=mysqli_real_escape_string($conn,$_POST['contactmobile']);
    $Tax=mysqli_real_escape_string($conn,$_POST['tax']);
    $type=mysqli_real_escape_string($conn,$_POST['type']);
  
    foreach ($data as $post) {
       
        $Refdtpos=$post['RefDatepos'];
        $Refnumpos=$post['RefNopos'];
        $CompanyNamepos=$post['CompanyNamepos'];
        $Contactpersonpos=$post['ContactMobilepos'];
        $SaleValuepos=$post['SaleValuepos'];
        $Execnamepos=$post['ExecutiveNamePos'];
        $Execnumpos=$post['ExecutiveMobilePos'];
        $Taxpos=$post['Taxpos'];
        $descpos=$post['Descriptionpos'];
        $amt=$post['SaleValuepos'];
        $totalpos=$post['TotalPos'];
        $file_name = $post['file_name'];
        $filetype=$post['DocType'];
        if($filetype=="poster"){
            $path="./poster";

        }
        else{
            $path="./quotation";
        }
       
    }
    $existingFilePath = "$path"."/"."$file_name"; 
    $textPos = [
      'CompanyName' => $CompanyNamepos,
      'RefDate' => $Refdtpos,
      'Amount' => $amt,
      'RefNo' => $Refnumpos,
      'Tax' => $Taxpos,
      'SaleValue' => $SaleValuepos,
      'ExecName' => $Execnamepos,
      'ExecNum' => $Execnumpos,
      'Description' => $descpos,
  ];
  
  $textData = [
      'CompanyName' => $companyname,
      'RefDate' => $date,
      'Amount' => $amount,
      'RefNo' => $refno,
      'Tax' => $Tax,
      'SaleValue' => $salevalue,
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

    
    $pdf->Output($file_name, 'D');
  }
  else{

  
    
      $imagePath = $existingFilePath;
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
        list($x, $y, $fontSize, $color) = explode('/', $textInfo);
      
        
        $colorCode = getColorCode($color);
        list($r, $g, $b) = sscanf($colorCode, "%02x%02x%02x");
  

       
        $text = $textData[$variableName] ?? ''; 
        
        $fontFile = './fonts/Poppins-SemiBold.ttf'; 
          $fontColor = imagecolorallocate($image, $r, $g, $b);
        
       
          imagettftext($image, $fontSize, 0, $x, $y, $fontColor, $fontFile, $text);
        }
      
        $modifiedImagePath = "./uploads/{$file_name}"; // 

        
        imagejpeg($image, $modifiedImagePath);
        if($type=='PDF'){
          require('./vendor/fpdf.php');
          
          $pdf = new FPDF();
          $pdf->AddPage();
       

          
          list($imgWidth, $imgHeight) = getimagesize($modifiedImagePath);

          
          $aspectRatio = $imgWidth / $imgHeight;

         
          $pdfWidth = $pdf->GetPageWidth();
          $pdfHeight = $pdfWidth / $aspectRatio;

        
          $pdf->Image($modifiedImagePath, 0, 0, $pdfWidth, $pdfHeight);

     
          $pdf->Output($modifiedImagePath, 'D');
        }
        else{
          header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($modifiedImagePath) . '"');
    header('Content-Length: ' . filesize($modifiedImagePath));

    readfile($modifiedImagePath);
          
          imagedestroy($image);

        }


      }
    

    
  
   
}
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
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./"  style="color:blue;">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="doc.php" style="color:blue;">Docker</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" style="color:blue;">SMSTemplate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color:blue;">logout</a>
          </li>
        </ul>
        
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
                  if (!empty($value)) {
                      echo '<div class="mb-3">
                              <label for="' . $columnName . '" class="form-label">' . $label . '</label>
                              <input name="' . strtolower($label) . '" type="text" class="form-control" id="' . $columnName . '" aria-describedby="' . $columnName . '" placeholder="' . $label . '">
                            </div>';
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