<?php


?>

<div class="container h-100 d-flex justify-content-center ">
    <div class=" my-auto justify-content-center">

        <form action="/admin/loginSys/admin_login.php" method="post">
            <h3 class="text-center mb-3"> Prihlásenie </h3>
            <div class="form-group mx-auto">
                <?php
                if (isset($_GET['error'])){
                    if($_GET['error'] == "invalidLogin")
                    {
                        echo '<p class="errormessage"> Meno alebo heslo nieje správne !</p>';

                    }

                    if($_GET['error'] == "invalidusername")
                    {
                        echo '<p class="errormessage"> Meno obsahuje nepovolené znaky ! </p>';

                    }
                    if (isset($_GET['username'])){
                        echo  '<input type="text" class="mx-auto form-control admin_login_input" name="user-id" placeholder="Meno" required="required" value="'.$_GET['username'].'">';
                    } else {
                        echo '<input type="text" class=" mx-auto form-control admin_login_input" name="user-id" placeholder="Meno" required="required" >';
                    }

                } else {
                    echo '<input type="text" class="mx-auto form-control admin_login_input" name="user-id" placeholder="Meno" required="required" >';
                }

                ?>
            </div>
            <div class="form-group">

                    <input type="password" class=" mx-auto form-control admin_login_input" name="user-passwd"placeholder="Heslo" required="required">


            </div>
            <div class="row justify-content-center">
                <div class="form-group col-9">
                    <button type="submit" class="btn btn-primary btn-block admin_login_btn mx-auto" name="admin-sing-in">Prihlásiť</button>
                </div>
            </div>

        </form>
        <p class="text-center"><a href="mailto:kovacj.jan@gmail.com?subject=AdminSupport">Kontaktuj admina</a></p>
    </div>

</div>