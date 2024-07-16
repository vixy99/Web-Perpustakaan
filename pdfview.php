<?php

    $pdf = $_GET['id'];

?>
<!DOCTYPE html>
<html>

<head>

<script src="assets/js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="assets/css/flipbook.style.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

<script src="assets/js/flipbook.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $("#container").flipBook({
            pdfUrl:"<?php echo $pdf ?>",
        });

    })
</script>

</head>

<body>
<div id="container">
    <p>Real 3D Flipbook has lightbox feature - book can be displayed in the same page with lightbox effect.</p>
    <p>Click on a book cover to start reading.</p>
    <img src="uploads/cover/cover3.jpg" />
</div>

</body>

</html>
