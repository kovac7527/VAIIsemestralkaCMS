<?php
set_include_path('');
include '../sharedElements/Header.php';
include '../sharedElements/NavBar.php';
require '../loginSys/validateLogin.php';
include '../dataAccess/dtb_access.php';

?>

<?php
if (!isset($_GET['updateDevice'])) {
    header("Location: ../admin/devices.php");
    exit();
} elseif (isset($_GET['modelName']) && isset($_GET['series']) && isset($_GET['image']) && isset($_GET['description']) ) {
    $db = new dtb_access();
    $db->connect();
    $updateMsg = $db->updateDevice($_GET['updateDevice'], $_GET['modelName'], $_GET['series'], $_GET['image'], $_GET['description']);
    $device = $db->getDevice($_GET['updateDevice']);
}  else {
    $db = new dtb_access();
    $db->connect();
    $device = $db->getDevice($_GET['updateDevice']);
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
<main>
    <div class="container">
        <h2 class="mt-5">Úprava zariadenia</h2>
        <?php if (!empty($updateMsg)) {
            echo '<p class="text-center font-weight-bold mt-2 text-success text">';
            echo $updateMsg;
            echo '</p>';
        }?>

        <hr>
        <form action="editDevice_form.php" class="needs-validation col-md-4" method="get" novalidate>
            <div class="form-group">
                <label for="updateDevice">ID zariadenia:</label>
                <input type="text" class="form-control" id="deviceId"  name="deviceId" value="<?php echo $device->getDeviceID() ?>" required disabled>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="brandName">Názov značky:</label>
                <input type="text" class="form-control" id="brandName" name="brandName" value="<?php echo $db->getBrandById($device->getBrandId())->getName() ?>" required disabled>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="modelName">Model:</label>
                <input type="text" class="form-control" id="modelName"  name="modelName" value="<?php echo $device->getModelName() ?>" required >
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="series">Séria:</label>
                <input type="text" class="form-control" id="series"  name="series" value="<?php echo $device->getSeries() ?>" required >
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="description">Popis:</label>
                <textarea type="text" class="form-control" id="description"  name="description" rows="5"  required ><?php echo $device->getDescription() ?></textarea>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="image">Logo:</label>
                <input type="file"  class="d-block" id="image" name="image" ">
                <!--                <div class="valid-feedback">Valid.</div>-->
                <!--                <div class="invalid-feedback">Please fill out this field.</div>-->
            </div>
            <button type="submit" class="btn btn-primary" name="updateDevice" value="<?php echo $device->getDeviceID() ?>">Upraviť</button> <?php if (!empty($updateMsg)) { echo $updateMsg; }?>
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