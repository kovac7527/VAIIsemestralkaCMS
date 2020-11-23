<?php
    set_include_path('');
    include '../sharedElements/Header.php';
    include '../sharedElements/NavBar.php';
    require '../loginSys/validateLogin.php';
    include '../dataAccess/dtb_access.php';

?>

<?php
    if (!isset($_GET['updateBrand'])) {
        header("Location: ../admin/servis.php");
    } elseif (isset($_GET['brandName']) && isset($_GET['brandLogo'] )) {
        $db = new dtb_access();
        $db->connect();
        $updateMsg = $db->updateBrand($_GET['updateBrand'], $_GET['brandName'], $_GET['brandLogo']);
        $brand = $db->getBrandById($_GET['updateBrand']);
    }  else {
        $db = new dtb_access();
        $db->connect();
        $brand = $db->getBrandById($_GET['updateBrand']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
<main>
    <div class="container">
        <h2 class="mt-5">Úprava značky</h2>
        <?php if (!empty($updateMsg)) {
            echo '<p class="text-center  font-weight-bold mt-2 text-success text">';
            echo $updateMsg;
            echo '</p>';
        }?>
        <hr>
        <form action="editBrand_form.php" class="needs-validation col-md-4" method="get" novalidate>
            <div class="form-group">
                <label for="brandId">ID značky:</label>
                <input type="text" class="form-control" id="brandId" placeholder="Názov značky" name="brandId" value="<?php echo $brand->getId() ?>" required disabled>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="brandName">Názov značky:</label>
                <input type="text" class="form-control" id="brandName" placeholder="Názov značky" name="brandName" value="<?php echo $brand->getName() ?>" required >
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">Logo:</label>
                <input type="file"  class="d-block" id="brandLogo" name="brandLogo" ">
                <!--                <div class="valid-feedback">Valid.</div>-->
                <!--                <div class="invalid-feedback">Please fill out this field.</div>-->
            </div>
            <button type="submit" class="btn btn-primary" name="updateBrand" value="<?php echo $brand->getId()?>">Upraviť</button>
        </form>

        <script>
            // Disable form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Get the forms we want to add validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </div>


</main>

</body>

</html>