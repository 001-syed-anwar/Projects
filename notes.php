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
    <!--  <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/decoupled-document/ckeditor.js"></script> 
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
     -->
    <!-- <script src="ckeditor/ckeditor5-build-classic/ckeditor.js"></script> -->
</head>

<body>
    <div class="container cont my-5 ">
        <div class="row">
            <!-- <h1>Document editor</h1>
            <div id="toolbar-container"></div>
            <div id="editor">
                <p><strong>Add Your Content here!!!</strong></p>
            </div> -->
            <h1>Classic editor</h1>
            <div id="editor">

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary">next</button>
            </div>
        </div>
    </div>
    <script>
        // DecoupledEditor
        //     .create(document.querySelector('#editor'))
        //     .then(editor => {
        //         const toolbarContainer = document.querySelector('#toolbar-container');

        //         toolbarContainer.appendChild(editor.ui.view.toolbar.element);
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });
        // ClassicEditor
        // .create( document.querySelector( '#editor' ) )
        // .catch( error => {
        //     console.error( error );
        // } );
        CKEDITOR.replace('editor');

    </script>
</body>

</html>