<!DOCTYPE html>
<html>
	<head>
		
		<meta charset="UTF-8">
		<title>Master Position Finding</title>
		
		<!-- CSS (load bootstrap from a CDN) -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
		<script defer src="script.js"></script>
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
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./"  style="color:blue;">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php" style="color:blue;">Docker</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" style="color:blue;">SMSTemplate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./master-position.php" style="color:blue;">Master Position Finding</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color:blue;">logout</a>
          </li>
          
        </ul>
        
      </div>
    </div>
  </div>
</nav>
		</header>
		<div class="container my-5">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-4 ">
					<form>
						<div class="mb-3 border p-3">
							<label for="field1" class="form-label">Company Name</label>
							<input type="text" class="form-control" id="field1" aria-describedby="field1">
							<div class="mb-3 mt-3 d-flex">

								<label for="field1-x" class="form-label mx-2"> x</label>
								<input type="number" class="form-control" id="field1-x" aria-describedby="field1x" required onchange="generatePDF(event)">
								<label for="field1-y" class="form-label mx-2"> y</label>
								<input type="number" class="form-control" id="field1-y" aria-describedby="field1y" required onchange="generatePDF(event)">
							</div>
						</div>
						
						<div class="mb-3 border p-3">
							<label for="modelno" class="form-label">Model No</label>
							<input type="text" class="form-control" id="modelno">
							<div class="mb-3 mt-3 d-flex">

								<label for="modelno-x" class="form-label mx-2"> x</label>
								<input type="number" class="form-control" id="modelno-x" aria-describedby="modelno-x" required onchange="generatePDF(event)">
								<label for="modelno-y" class="form-label mx-2"> y</label>
								<input type="number" class="form-control" id="modelno-y" aria-describedby="modelno-y" required onchange="generatePDF(event)">
							</div>
						</div>
						<div class="mb-3">
							<label for="formFile" class="form-label">Select image</label>
							<input class="form-control formFile" type="file" id="formFile" onchange="previewImage(event);" multiple >
						</div>
						<button onclick="generatePDF(event)" class="btn btn-primary">Preview PDF</button>
						<button  class="btn btn-primary" id="save">Save</button>
					</form>
				</div>
				<div class="mx-4 col-lg-6 border image-div overflow-scroll">
					
					
					<img id="selected" width="100%" height="auto" class="image">
					<embed id="pdfViewer" src="" width="100%" height="auto" type="application/pdf">
				</div>
			</div>
		</div>
		
		<script>
			
		</script>
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
</body>
</html>


 


 