<?php
DEFINE('DB_USER','root');
DEFINE('DB_PASS','');
DEFINE('DB_HOST','localhost');
DEFINE('DB_DB','library');
DEFINE('EMAIL',1);
DEFINE('PHONE',2);
DEFINE('ROLL',3);
DEFINE('CODE',4);
DEFINE('NAME',5);
DEFINE('NUMBER',6);
DEFINE('ISBN',7);
DEFINE('BCODE',8);


function connectTo() {
/*
 Does -> Connects to data base
 Returns -> Connection object
*/
  $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_DB);
  return $con;   
}
function sqlReady($input) {
/*
 Takes -> Any string
 Returns -> Escapes the string
*/
  $con = connectTo();
  $input	= trim($input);
  $input	= stripslashes($input);
  $input	= htmlspecialchars($input);
  $string	= mysqli_real_escape_string($con,$input);
  $con->close();
  return $string; 
}

function hashPass($pass) {
/*
 Takes -> Password
 Returns -> Hashed password
*/
  return password_hash($pass,PASSWORD_BCRYPT);
}
function verifyPass($input,$pass) {
/*
 Takes -> 2 Password strings
 Returns -> true if matches false if doesn't
*/
  return password_verify($input,$pass) == $pass? true : false ;
}
function respond($as,$what) {
/*
 Takes -> key and value
 Does -> Dies by printing json_encoded array having the key and value
*/
  die(json_encode(array($as=>$what)));
}
function updateSession($email) {
/*
 Takes -> email
 Does -> Updates the SESSION variable as per the email
*/
  $con = connectTo();
  $exists = $con->query("select * from `login` where `email` = '$email'");
  $exists = $exists->fetch_assoc();
  $_SESSION['name'] = $exists['name'];
  $_SESSION['email'] = $exists['email'];
  $_SESSION['phone'] = $exists['phone'];
  $con->close();
  session_write_close();
}
function updateUserSession($user) {
/*
 Takes -> username
 Does -> Updates the SESSION variable based on username
*/
  $con = connectTo();
  $exists = $con->query("select uid,name from `user` where `username` = '$user'");
  $exists = $exists->fetch_assoc();
  $_SESSION['name'] = $exists['name'];
  $_SESSION['uid'] = $exists['uid'];
  $con->close();
  session_write_close();
}
function verify($type,$input) {
/*
 Takes -> Type of regex checker and the input
 Does -> Computes the regex 
 Returns -> Returns true and false
*/
  $reEmail = '/^([\S]+)@([\S]+)\.([\S]+)$/';
  $rePhone = '/^[0-9]{10}$/';
  $reCode  = '/^([a-zA-Z]{3})\-([0-9]{3})$/';
  $reRoll  = '/^([0-9]{3})\/([a-zA-z]{2})\/([0-9]{2})$/';
  $reName  = '/^[a-zA-Z \']+$/';
  $reNum  = '/^[0-9]+$/';
  $reIsbn = '/^[0-9]{13}$/';
  $reBcode = '/^[0-9]{15}$/';
  $m;
  switch($type) {
    case EMAIL : 
      preg_match($reEmail,$input,$m);
    break;
    case PHONE : 
      preg_match($rePhone,$input,$m);
    break;
    case CODE : 
      preg_match($reCode,$input,$m);
    break;
    case ROLL : 
      preg_match($reRoll,$input,$m);
    break;
    case NAME : 
      preg_match($reName,$input,$m);
    break;
    case NUMBER : 
      preg_match($reNum,$input,$m);
    break;
    case ISBN : 
      preg_match($reIsbn,$input,$m);
    break;
    case BCODE : 
      preg_match($reBcode,$input,$m);
    break;
  }
 return count($m) == 0? false : true;
}
?>
