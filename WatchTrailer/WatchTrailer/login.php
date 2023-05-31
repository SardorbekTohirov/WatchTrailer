<?php 
session_start(); 
$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "foydalanuvchilar";

$conn = mysqli_connect($sname, $unmae, $password, $db_name)

if (isset($_POST['uname']) && isset($_POST['password'])) {

 function validate($data){
       $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

 $uname = validate($_POST['name']);
 $pass = validate($_POST['password'])

 if (empty($uname)) {
  header("Location: index.php?error=User Name is required");
     exit();
 }else if(empty($pass)){
        header("Location: index.php?error=Password is required");
     exit();
 }else{
        
  $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) === 1) {
   if ($uname==$adminname && $pass==$adminpass) 
   {
    header("Location: index.html");
    die();
   }else{
   $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
             $_SESSION['user_name'] = $row['user_name'];
             $_SESSION['name'] = $row['name'];
             $_SESSION['id'] = $row['id'];
             header("Location: index.html");
          exit();
            }else{
    header("Location: index.php?error=Incorect User name or password");
          exit();
   }
  }
  }else{
   header("Location: index.php?error=Incorect User name or password");
         exit();
  }
 }
 
}else{
 header("Location: index.php");
 exit();
}