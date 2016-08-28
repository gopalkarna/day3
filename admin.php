<?php

$validLogin = login($_POST['username'], $_POST['password']);

if ($validLogin){
    echo $_SESSION['userid'] . ' is logged in';
} else {
    header("Location: login.php");
    exit();
}


?>