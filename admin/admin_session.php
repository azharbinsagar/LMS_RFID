<?php
session_start();
  $isIndex = 0;
  if(!(array_key_exists('type',$_SESSION)) || !isset($_SESSION['user']) || $_SESSION['type'] != '0') {
    session_destroy();
    if(!$isIndex) header('Location: ../login.php');
  }
?>