<!DOCTYPE html>
<html lang="en">

<?php
include '../admin/sharedElements/Header.php';
include '../admin/sharedElements/NavBar.php';
require '../admin/loginSys/validateLogin.php';
include '../admin/dataAccess/dtb_access.php';
?>


<?php


if (isset($_POST['deleteDevice'])) {
    $db = new dtb_access();
    $db->connect();
    /** @var device $foundDevice */
    $foundDevice = $db->getDevice($_POST['deleteDevice']);
    $_POST['brandofDevice'] = $foundDevice->getBrandId();
    $deleteStatus = $db->deleteDevice($_POST['deleteDevice']);

}


if(isset($_GET['brandofDevice']) || isset($_POST['brandofDevice'])) {
    $object = new dtb_access();
    $object->connect();
    $brand = isset($_GET['brandofDevice']) ? $_GET['brandofDevice'] : $_POST['brandofDevice'];
    $checkBrand = $object->getBrandById($brand);

    if ($checkBrand == false) {
        echo '<p class="text-center mt-5 text-danger text">Značka neexistuje !!!</p>';
        exit();
    } else {

        if( isset($_POST['brandofDevice']) && isset($_POST['deviceSeries']) && isset($_POST['deviceModel']) && isset($_POST['deviceDescription']) && isset($_POST['deviceLogo'])) {
            $insertStatus = $object->insertDevice($_POST['brandofDevice'],$_POST['deviceSeries'],$_POST['deviceModel'],$_POST['deviceDescription'],$_POST['deviceLogo']);
        } else {
            $insertStatus = false;
        }
        $fetchedDevices = $object->getAllBrandDevices($brand);
    }
} else {
    header("Location: ../admin/servis.php");
    exit();
}



?>


<body>

    <main>

        <div class="container">
            <div class="row justify-content-center"><h3 class="text-center mt-5">
                    <?php
                    /** @var deviceBrand $checkBrand */
                        echo $checkBrand->getName();
                    ?>
                </h3></div>
            <?php
            if (!empty($deleteStatus)) {
                echo '<p class="text-center mt-2 text-danger text">';
                echo $deleteStatus;
                echo '</p>';
            }
            ?>
            <?php
            if ($insertStatus != false) {
                echo '<p class="text-center mt-2 text-success text">';
                echo $insertStatus;
                echo '</p>';
            }
            ?>
            <form action="../admin/forms/addDevice_form.php" method="get">
            <button name="deviceBrand"  class="btn btn-success mt-3 mb-3" type="submit" value="<?php echo $brand ?>">Pridať zariadenie</button>
            </form>

            <div class="row justify-content-center">
                <table class="table mt-2">
                    <tr>
                        <th class="">Séria</th>
                        <th class="">Model</th>
                        <th class="">Akcia</th>
                    </tr>
                    <?php

                    if ($fetchedDevices != false) {
                    /** @var device $device */
                    foreach ($fetchedDevices as $device){
                        echo '<tr>';
                        echo '<td>';
                        echo $device->getSeries();
                        echo '</td>';
                        echo '<td>';
                        echo $device->getModelName();
                        echo '</td>';
                        echo '<td>';
                        echo '<div class="row">';
                        echo '<form action="#"  method="post">';
                        echo '<button name="deleteDevice"  class="btn btn-danger ml-2" type="submit" value="'.$device->getDeviceID().'">Odstrániť</button>';
                        echo '</form>';
                        echo '<form action="../admin/forms/editDevice_form.php"  method="get">';
                        echo '<button name="updateDevice"  class="btn btn-warning ml-2" type="submit" value="'.$device->getDeviceID().'">Upraviť</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';

                    }
                    } else {
                        echo '<tr><td colspan="3" class="text-center">Žiadne pridané zariadenia </td> </tr>';
                    }

                    ?>
                </table>
            </div>
        </div>


    </main>

</body>

</html>
