<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../admin/styles/css/bootstrap.min.css"> <!--Bootstrap CSS-->



    <?php
    session_start();
    set_include_path('../admin/asdasdfdsf');
    if (isset($_SESSION['userId'])) {


        echo '<link rel="stylesheet" href="../../admin/styles/CMS.css"> ';
        echo '<title>SM CMS SYSTEM</title>';


    } else{

        echo '<link rel="stylesheet" href="../../admin/styles/admin.css">';
        echo '<title>Log In</title>';


    }
    ?>
       <!-- Moje vlastne CSS-->


    <script src="../../admin/jQuery/jQuery.js"></script>
    <script src="../../admin/styles/js/bootstrap.bundle.min.js"></script>




    <meta charset="UTF-8">
</head>




