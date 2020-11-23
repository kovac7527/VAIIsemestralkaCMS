<?php
    set_include_path('');
    include '../sharedElements/Header.php';
    include '../sharedElements/NavBar.php';
    require '../loginSys/validateLogin.php';
    include '../dataAccess/dtb_access.php';
?>



<!DOCTYPE html>
<html lang="en">

<main>
    <div class="container">
        <h2 class="mt-5">Vytvorenie novej značky</h2>
        <hr>
        <form action="../../admin/servis.php" class="needs-validation col-md-4" method="get" novalidate>
            <div class="form-group">
                <label for="brandName">Názov značky:</label>
                <input type="text" class="form-control" id="brandName" placeholder="Zadaj názov značky" name="brandName" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">Logo:</label>
                <input type="file"  class="d-block" id="brandLogo" name="brandLogo">
<!--                <div class="valid-feedback">Valid.</div>-->
<!--                <div class="invalid-feedback">Please fill out this field.</div>-->
            </div>
            <button type="submit" class="btn btn-primary">Pridať</button>

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