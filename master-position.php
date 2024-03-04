<?php 
error_reporting(1);
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
<html>
	<head>
		
		<meta charset="UTF-8">
		<title>Master Position Finding</title>
		
		<!-- CSS (load bootstrap from a CDN) -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
	    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
html,body{
    width: 100%;
    height: auto;
  color: blue ;

    
}
embed{
    height: 100vh;
}
.image-div{
   
    width:942px;
    height:auto;    
    overflow:scroll;

}
.image-div img {
min-width:100%;
}
.image{

    display: block;
}
	</style>
		<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
		
	</head>
	<body>
		<header>
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
		</header>
		<div class="container" style="margin-top:6rem !important;">
			<div class="row ">
				<div class="col-lg-3 col-sm-3 col-md-3 ">
					<form>
						<div class="mb-3 border p-3">
							<label for="field1" class="form-label">Reference</label>
							<input type="text" class="form-control" id="field1" aria-describedby="field1">
							<div class="mb-3 mt-3 d-flex">

								<label for="field1-x" class="form-label mx-2"> x</label>
								<input type="number" class="form-control" id="field1-x" aria-describedby="field1x" required onchange=generatePDF(event)>
								<label for="field1-y" class="form-label mx-2"> y</label>
								<input type="number" class="form-control" id="field1-y" aria-describedby="field1y" required onchange=generatePDF(event)>
							
							</div>
              <label for="field1-y" class="form-label mx-2">Font Size</label>
								<input type="number" class="form-control" id="font-size" aria-describedby="font-size" required onchange=generatePDF(event)>
						</div>
						
						
						<div class="mb-3">

<a href="findposter.php" class="btn btn-primary">Go back</a>

</div>
					
					</form>
				</div>
				<div class="mx-4 col-lg-9 col-sm-9 col-md-9 border image-div overflow-scroll">
					
					<?php 
					 if(isset($_GET['id'])){
					     
					
					     
					
					       $id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT DocType, file_name FROM postermaster WHERE posterID = '$id'";

					        $res=mysqli_query($conn,$sql);
					        if($res){
					            $row=mysqli_fetch_assoc($res);
					            $filename=$row['file_name'];
					           if($row['DocType']=="poster"){
					               $path="./poster/$filename";
					           }
					           else{
					               $path="./quotation/$filename";
					           }
					         
					        }
					        else{
					            echo "something went wrong  ".mysqli_error($conn);
					        }
					 }
					 
					
					 else{
					     echo "Id cannot be found <a href='../'>Go back</a>";
					 }
					?>
									<img id="selected" width="100%" height="auto" class="image" src="<?php echo $path;?>">
					<embed id="pdfViewer" src="" width="100%" height="auto" type="application/pdf">
				</div>
			</div>
		</div>
		
	
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
   	<script>
			
let doc;


function generatePDF(event) {
      var rmimg = document.getElementById('selected');
      rmimg.style.display = 'none';
    event.preventDefault();
    doc = new jsPDF("p", "mm", "a4");
    const companyName = document.getElementById('field1').value;
   

    // Declaring x,y positions
    var field1x = document.getElementById('field1-x').value;
    var field1y = document.getElementById('field1-y').value;
    var fontsize = document.getElementById('font-size').value;
    

    const selectedImage = document.getElementById('selected');
    const image = new Image();
    image.src = selectedImage.src;
    // Process and add the image to PDF
    let width = 220.28;
    let height = 300;
 
    
    doc.addImage(image, 'JPEG', -5, 1, width, height);
    doc.setFont('helvetica');
    doc.setFontStyle('bold');
    doc.setFontSize(fontsize);
    doc.text(companyName, field1x, field1y);

  const dataUrl = doc.output('dataurlstring');
      const pdfViewer = document.getElementById('pdfViewer');
      
      pdfViewer.src = dataUrl+'#toolbar=0&navpanes=0&scrollbar=0';
    // Save the PDF
    let btn=document.getElementById('save');
btn.addEventListener('click',function(){
  doc.save('test_report.pdf');
})
// 
}



		</script>
</body>
</html>


 


 