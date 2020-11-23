<?php
include $_SERVER['DOCUMENT_ROOT'].'/admin/models/adminUser.php';
include $_SERVER['DOCUMENT_ROOT'].'/admin/models/deviceBrand.php';
include $_SERVER['DOCUMENT_ROOT'].'/admin/models/device.php';

class dtb_access {
    private $servername;
    private $username;
    private $password;
    private $dbname;

    private $db;

   public function connect() {

        $this->servername = "localhost";
       $this->dbname = "smartmedic";
       $this->username = "root";
        $this->password = "dtb456";


        try {
            $this->db = new PDO('mysql:dbname=' .$this->dbname. ';host='.$this->servername, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDo::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
            print_r(PDO::getAvailableDrivers());
        }



   }

    function getAllBrands() {

        $stmt = $this->db->prepare('SELECT * FROM device_brands');
        $stmt->execute();
        $foundBrands = [];
        $brands = $stmt->fetchAll();
        if (!empty($brands)) {
            foreach ($brands as $brand){
                $foundBrands[] = new deviceBrand($brand['brand_id'],$brand['brand_name'],$brand['brand_logo']);
            }
            return $foundBrands;
        } else
        {
            return false;
        }

    }

    function getBrandById($brandId) {

        $stmt = $this->db->prepare('SELECT * FROM device_brands WHERE brand_id = :brandId');
        $stmt->execute(array(
            ':brandId'  => $brandId
        ));
        $foundBrand = false;
        $brands = $stmt->fetchAll();
        if (!empty($brands)) {
            foreach ($brands as $brand){
                $foundBrand = new deviceBrand($brand['brand_id'],$brand['brand_name'],$brand['brand_logo']);
            }
            return $foundBrand;
        } else
        {
            return false;
        }

    }

    function updateBrand($brandId, $brandName, $brandLogo) {

       if (empty($brandLogo)) {
           $stmt = $this->db->prepare('UPDATE device_brands SET brand_name=:brandName where brand_id =:brandId ');
           $result = $stmt->execute(array(
               ':brandId'  => $brandId,
               ':brandName'  => $brandName,
           ));
       } else {
           $stmt = $this->db->prepare('UPDATE device_brands SET brand_name=:brandName, brand_logo=:brandLogo where brand_id =:brandId ');
           $result = $stmt->execute(array(
               ':brandId'  => $brandId,
               ':brandName'  => $brandName,
               ':brandLogo'  => $brandLogo
           ));

       }

        if ($result){
            return 'Zaznam úspešne zmenený';
        } else {
            return 'Nastala chyba pokuse o zmenu !';
        }


    }


    function updateDevice($deviceId, $modelName, $series, $image, $description) {

        if (empty($image)) {
            $stmt = $this->db->prepare('UPDATE devices SET device_series=:series, device_model=:modelName , device_description=:description   where deviceId =:deviceId ');
            $result = $stmt->execute(array(
                ':series'  => $series,
                ':modelName'  => $modelName,
                ':description'  => $description,
                ':deviceId'  => $deviceId,
            ));
        } else {
            $stmt = $this->db->prepare('UPDATE devices SET device_series=:series, device_model=:modelName , device_description=:description  , image=:image where deviceId =:deviceId ');
            $result = $stmt->execute(array(
                ':series'  => $series,
                ':modelName'  => $modelName,
                ':description'  => $description,
                ':image'  => $image,
                ':deviceId'  => $deviceId

            ));

        }

        if ($result){
            return 'Zaznam úspešne zmenený';
        } else {
            return 'Nastala chyba pokuse o zmenu !';
        }


    }


    function getBrandByName($brandName) {

        $stmt = $this->db->prepare('SELECT * FROM device_brands WHERE brand_name = :brandName');
        $stmt->execute(array(
            ':brandName'  => $brandName
        ));
        $foundBrands = [];
        $brands = $stmt->fetchAll();
        if (!empty($brands)) {
            foreach ($brands as $brand){
                $foundBrands[] = new deviceBrand($brand['brand_id'],$brand['brand_name'],$brand['brand_logo']);
            }
            return $foundBrands;
        } else
        {
            return false;
        }

    }

    function getAllBrandDevices($brandId) {

        $stmt = $this->db->prepare('SELECT * FROM devices WHERE device_brand_id = :brandId');
        $stmt->execute(array(
            ':brandId'  => $brandId
        ));

        $foundDevices = [];
        $devices = $stmt->fetchAll();
        if (!empty($devices)) {
            foreach ($devices as $device){
                $foundDevices[] = new device($device['deviceId'],$device['device_model'],$device['device_brand_id'],$device['device_series'],$device['image'],$device['device_description']);
            }
            return $foundDevices;
        } else
        {
            return false;
        }

    }

    function getAllBrandDevicesCount($brandId) {

        $stmt = $this->db->prepare('SELECT count(*) FROM devices WHERE device_brand_id = :brandId');
        $stmt->execute(array(
            ':brandId'  => $brandId
        ));
        $devices = $stmt->fetchAll();
        return $devices[0][0];

    }

   function findAminUser($username) {

       $stmt = $this->db->prepare('SELECT * FROM users_admin WHERE user_id = :username');
       $stmt->execute(array(
           ':username'  => $username
       ));

        $foundUser = $stmt->fetchAll();
        if (!empty($foundUser)) {
            return new adminUser($foundUser[0]['user_id'], $foundUser[0]['user_passwd'], $foundUser[0]['id']);
        } else
        {
            return false;
        }

   }

    function insertDevice($deviceBrand, $deviceSeries, $deviceModel, $deviceDesc, $deviceImage) {

        if ($this->getBrandById($deviceBrand) != false) {
            $stmt = $this->db->prepare('INSERT into devices (device_brand_id, device_series, device_model, device_description, image) values (:deviceBrand, :deviceSeries, :deviceModel, :deviceDesc, :deviceImage)');
            $inserted = $stmt->execute(array(
                ':deviceBrand'  => $deviceBrand,
                ':deviceSeries'  => $deviceSeries,
                ':deviceModel'  => $deviceModel,
                ':deviceDesc'  => $deviceDesc,
                ':deviceImage'  => $deviceImage,
            ));
            if ($inserted){
                return 'Zaznam úspešne uložený';
            } else {
                return 'Nastala chyba pri ukladaní !';
            }
        } else return 'Chyba pri ukladaní zariadenia, požadovaná značka neexistuje !!!';


    }


    function insertBrand($brandName, $brandLogo) {

       if ($this->getBrandByName($brandName) == false) {
           $stmt = $this->db->prepare('INSERT into device_brands (brand_name, brand_logo) values (:brandName, :brandLogo)');
           $inserted = $stmt->execute(array(
               ':brandName'  => $brandName,
               ':brandLogo'  => $brandLogo
           ));
           if ($inserted){
               return 'Zaznam úspešne uložený';
           } else {
               return 'Nastala chyba pri ukladaní !';
           }
       } else return 'Značka už existuje';


    }

    function deleteBrand($brandId) {

            $stmt = $this->db->prepare('DELETE from device_brands where brand_id = :brandId');
            $inserted = $stmt->execute(array(
                ':brandId'  => $brandId
            ));
            if ($inserted){
                return 'Záznam úspešne vymazaný';
            } else {
                return 'Záznam nebol nájdený';
            }



    }

    function deleteDevice($deviceId) {

        $stmt = $this->db->prepare('DELETE from devices where deviceId = :deviceId');
        $inserted = $stmt->execute(array(
            ':deviceId'  => $deviceId
        ));
        if ($inserted){
            return 'Zariadenie úspešne vymazané';
        } else {
            return 'Zariadenie nebolo nájdené';
        }



    }

    function getDevice($deviceId) {

        $stmt = $this->db->prepare('select * from devices where deviceId = :deviceId');
         $stmt->execute(array(
            ':deviceId'  => $deviceId
        ));
        $device = $stmt->fetchAll();
        if (!empty($device)){
            return new device($device[0]['deviceId'],$device[0]['device_model'],$device[0]['device_brand_id'], $device[0]['device_series'],  $device[0]['image'] , $device[0]['device_description']);
        } else {
            return 'Zariadenie nebolo nájdené';
        }



    }



}





