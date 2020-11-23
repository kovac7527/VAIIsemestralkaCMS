
<!DOCTYPE html>
<html lang="en">

<?php
    set_include_path('');
    include '../admin/sharedElements/Header.php';
    include '../admin/sharedElements/NavBar.php';
    require '../admin/loginSys/validateLogin.php';
    include '../admin/dataAccess/dtb_access.php';
?>

<?php
    if (isset($_GET['deleteBrand'])) {
        $db = new dtb_access();
        $db->connect();
        $deleteMsg = $db->deleteBrand($_GET['deleteBrand']);
    }

?>

<?php
if (isset($_GET['brandName']) && isset($_GET['brandLogo'])) {
    $db = new dtb_access();
    $db->connect();
    $insertStatus = $db->insertBrand($_GET['brandName'],$_GET['brandLogo']);

} else {
    $insertStatus = false;
}

?>

<body>
<main>
    <div class="container">
        <?php
        if ($insertStatus != false) {
            echo '<p>'.$insertStatus.'</p>';
        }
        ?>
        <a class="btn btn-success mt-2 " href="forms/addBrand_form.php">Pridat znacku</a>
        <div class="row justify-content-center">
            <table class="table mt-3">
                <tr>
                    <th class="">Značka</th>
                    <th class="">Počet zariadení</th>
                    <th class="">Akcia</th>
                </tr>
                <?php
                    $object = new dtb_access();
                    $object->connect();
                /** @var deviceBrand $brand */
                    $fetchedBrands = $object->getAllBrands();

                    foreach ($fetchedBrands as $brand){
                        echo '<tr>';
                        echo '<td>';
                        echo $brand->getName();
                        echo '</td>';
                        echo '<td>';
                        echo '<div class="row">';
                        echo $object->getAllBrandDevicesCount($brand->getId());
                        echo '<form action="../admin/devices.php"  method="get">';
                        echo '<button name="brandofDevice"  class="btn btn-outline-primary ml-3" type="submit" value="'.$brand->getId().'">Zobraziť</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</td>';
                        echo '<td>';
                        echo '<div class="row">';
                        echo '<form action="../admin/servis.php"  method="get">';
                        echo '<button name="deleteBrand"  class="btn btn-danger ml-2" type="submit" value="'.$brand->getId().'">Odstrániť</button>';
                        echo '</form>';
                        echo '<form action="forms/editBrand_form.php"  method="get">';
                        echo '<button name="updateBrand"  class="btn btn-warning ml-2" type="submit" value="'.$brand->getId().'">Upraviť</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';

                    }

                ?>
            </table>
        </div>
    </div>


</main>

</body>

</html>