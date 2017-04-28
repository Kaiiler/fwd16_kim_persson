<!DOCTYPE html>
<?php
// including the database connection file
include_once("config.php");
// start session
session_start();

// if signup is pressed create new user with INSERT
if(isset($_POST['signup'])){
 $name = $_POST['cname'];
 $email = $_POST['cemail'];
 $pass = md5($_POST['cpass']);

 $insert = $pdo->prepare("INSERT INTO Users (name,email,pass) values(:name,:email,:pass) ");
$insert->bindParam(':name',$name);
$insert->bindParam(':email',$email);
$insert->bindParam(':pass',$pass);
$insert->execute();
}
// if signin is pressed check if login credentials are correct
// if successful log in and redirect to aeroplane.php
elseif(isset($_POST['signin'])){
 $email = $_POST['email'];
 $pass = md5($_POST['pass']);
 
 $select = $pdo->prepare("SELECT * FROM Users WHERE email='$email' and pass='$pass'");
 $select->setFetchMode();
 $select->execute();
 $data=$select->fetch();

 if($data['email']!=$email and $data['pass']!=$pass)
 {
  echo "invalid email or pass";
 }

 elseif($data['email']==$email and $data['pass']==$pass)
 {
 $_SESSION['email']=$data['email'];
    $_SESSION['name']=$data['name'];
header("location:aeroplane.php"); 
 }
 }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            .wrapper {
                height:97vh;
                display:flex;
                flex-direction:row;
                justify-content: space-between;
                align-items: center;
            }
            </style>
    </head>
    <body>
      <div class="wrapper">
          <div class="createbox" style = "width:300px; border: solid 1px #333333; ">
                  <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create Account</b></div>		
                  <div style = "margin:30px">
                     <form method="post">
                         <input type = "text" name = "cname" Placeholder="Username"/>
                         <input type = "text" name = "cemail" Placeholder="Email"/>
                         <input type = "password" name = "cpass" placeholder="Password"/><br />
                        <input type = "submit" name="signup" value = " Create "/><br />
                     </form>			
                  </div>		
               </div>
         <div class="loginbox" style = "width:300px; border: solid 1px #333333; ">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>		
            <div style = "margin:30px">
               <form method="post">
                   <input type = "text" name = "email" placeholder="Email"/>
                   <input type = "password" name = "pass" placeholder="Password"/><br />
                  <input type = "submit" name="signin" value = " Log in "/><br />
               </form>
               			
            </div>		
         </div>		
      </div>
   </body>
</html>