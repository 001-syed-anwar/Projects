<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CKEditor 5 – Document editor</title>
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include "header.php"; ?>

    <div class="container d-flex cont flex-column my-5">
        <div class="row text-center align-items-center justify-content-center  my-5">
            <h1>write your thoughts...</h1>
            <div id="editor">

            </div>
        </div>
        <div class="row text-center my-5">
            <div class="col">
                <button type="button" class="btn btn-primary" onclick="proceed()">next</button>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('editor');
        function proceed() {
            console.log(CKEDITOR.instances.editor.getData());
            content = CKEDITOR.instances.editor.getData();
            window.location.href = "permission.php?content=" + encodeURIComponent(content);
        }
    </script>
</body>

</html>