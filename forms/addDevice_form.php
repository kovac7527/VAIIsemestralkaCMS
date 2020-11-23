<?php
    set_include_path('');
    include '../sharedElements/Header.php';
    include '../sharedElements/NavBar.php';
    require '../loginSys/validateLogin.php';
    include '../dataAccess/dtb_access.php';
?>

<?php
if(isset($_GET['deviceBrand'])) {
    $object = new dtb_access();
    $object->connect();
    $checkBrand = $object->getBrandById($_GET['deviceBrand']);

    if ($checkBrand == false) {
        echo '<p class="text-center mt-5 text-danger">Značka neexistuje !!!</p>';
        exit();
    } else {
        $fetchedDevices = $object->getAllBrandDevices($_GET['deviceBrand']);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<main>
    <div class="container">
        <h2 class="mt-5">Pridanie zariadenia </h2>
        <hr>
        <form action="../devices.php" class="needs-validation col-md-4" method="post" novalidate>
            <div class="form-group">
                <label for="deviceBrand">Značka:</label>
                <input type="text" class="form-control" id="deviceBrand"  name="deviceBrand"  value="<?php echo $checkBrand->getName() ?>" required disabled>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="deviceSeries">Séria:</label>
                <input type="text" class="form-control" id="deviceSeries" placeholder="Zadaj sériu modelu" name="deviceSeries" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="deviceModel">Model:</label>
                <input type="text" class="form-control" id="deviceModel" placeholder="Zadaj model zariadenia" name="deviceModel" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="deviceDescription">Popis modelu:</label>
                <textarea class="form-control" id="deviceDescription"  name="deviceDescription" rows="5"></textarea>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">Logo:</label>
                <input type="file"  class="d-block" id="deviceLogo" name="deviceLogo">
                <!--                <div class="valid-feedback">Valid.</div>-->
                <!--                <div class="invalid-feedback">Please fill out this field.</div>-->
            </div>
            <button type="submit" class="btn btn-primary" id="deviceBrandID"  name="brandofDevice" value="<?php echo $checkBrand->getId() ?>" >Pridať</button>

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