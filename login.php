<?php

if (isset($_POST['submit'])){
    $validLogin = login($_POST['username'], $_POST['password']);

    if ($validLogin){
        header("Location: admin.php");
        exit();
     } else {
        echo 'oops can not do it';
     }

}

?>