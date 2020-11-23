<?php
require '../sharedElements/Header.php';

if (isset($_POST['admin-sing-in'])) {

    include '../dataAccess/dtb_access.php';

    $username = $_POST['user-id'];
    $userpasswd = $_POST['user-passwd'];

    if (empty($username) || empty($userpasswd)) {
        header("Location: ../admin?error=emptyfields" . $username);
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../admin?error=invalidusername");
    } else {

        $object = new dtb_access();
        $object->connect();


        /** @var adminUser $foundUser */
        $foundUser = $object->findAminUser($username);
        if($foundUser != false) {
            if ($userpasswd == $foundUser->getPasswd())
            {
                /*Uzivatel zadal spravne meno aj heslo*/

                session_start();
                $_SESSION['userId'] = $foundUser->getUsername();
                $_SESSION['userName'] = $foundUser->getUsername();
                header("Location: ../admin");

            } else {
                /*Uzivatel zadal nespravne heslo*/
                header("Location: ../admin?error=invalidLogin&username=$username");
            }

        } else {
            /*Uzivatel zadal nespravne meno  */
            header("Location: ../admin?error=invalidLogin&username=$username");

        }

    }
} ?>




