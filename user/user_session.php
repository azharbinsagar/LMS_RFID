<?php
session_start();
	  require_once('../assets/include/config.php');
	  $user = $_SESSION['user'];
	  updateUserSession($user);
  $isIndex = 0;
  if(!(array_key_exists('type',$_SESSION)) || !isset($_SESSION['user']) || $_SESSION['type'] != '1') {
    session_destroy();
    if(!$isIndex) header('Location: ../login.php');
  }
?>