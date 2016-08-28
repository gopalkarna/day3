<?php

function login($username, $password)
{

    require_once '../../dbpw.php';

    $mysqli = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    $query = 'SELECT username FROM members WHERE username=? AND password=?';

    if($stmt = $mysqli->prepare($query)){
      $stmt->bind_param('ss', $username, $password)
      $stmt->execute();
      $stmt->store_result();
      $num_row = $stmt->num_rows;
      $stmt->bind_result($username);
      $stmt->fetch();
      $stmt->close();
    }else die("Failed to prepare query");


    if( $num_row === 1 ) {
      $_SESSION['userid'] = $username;
      return true;
    }

    return false;

}

?>