<?php 
session_start(); 
session_start(); 
$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "foydalanuvchilar";

$conn = mysqli_connect($sname, $unmae, $password, $db_name)

if(isset($_POST['parol']) && isset($_POST['name']) && isset($_POST['re_parol'])){

 function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

 $pass = validate($_POST['parol']);

 $re_pass = validate($_POST['re_password']);
 $name = validate($_POST['name']);




 if(empty($pass)){
        header("Location: registration.php?error=Password is required&$user_data");
     exit();
 }
 else if(empty($re_pass)){
        header("Location: registration.php?error=Re Password is required&$user_data");
     exit();
 }

 else if(empty($name)){
        header("Location: registration.php?error=Name is required&$user_data");
     exit();
 }

 else if($pass !== $re_pass){
        header("Location: registration.php?error=The confirmation password  does not match&$user_data");
     exit();
 }

 else{
     $sql = "SELECT * FROM users WHERE  names ='$name' ";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
   header("Location: registration.php?error=The username is taken try another&$user_data");
         exit();
  }else {
           $sql2 = "INSERT INTO users( password, names) VALUES( '$pass', '$name')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
             //header("Location: signup.php?success=Your account has been created successfully");
          header("Lacation: index.html");
    exit();
           }else {
             header("Location: registration.php?error=unknown error occurred&$user_data");
          exit();
           }
  }
 }
 
}else{
 header("Location: registration.php");
 exit();
}