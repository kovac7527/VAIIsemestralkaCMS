<!DOCTYPE html>
<html lang="en">

<?php
    include '../admin/sharedElements/Header.php';
?>

<body>
<?php

    if(isset($_GET['logout'])){
        session_unset();
        header("Location: ../admin");;
    }

    if (isset($_SESSION['userId'])) {
        require '../admin/indexCMS.php';
    } else{
        require '../admin/forms/login_form.php';
    }
    ?>
</body>

</html>











