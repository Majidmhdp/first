<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php
// define variables and set to empty values
$UsernameErr = $PasswordErr = "";
$Uname = $Pss = "";
$Status = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$Status = true;
   if (empty($_POST["Uname"])) {
     $UsernameErr = "User Name is required";
     $Status = false;
   } else {
     $Uname = test_input($_POST["Uname"]);

     if (!filter_var($Uname, FILTER_VALIDATE_EMAIL)) {
       $UsernameErr = "Incorect User Name Format"; 
       $Status = false;
     }
   }
   
   if (empty($_POST["Pss"])) {
     $PasswordErr = "Password is required";
     $Status = false;
   } else {
     $Pss = test_input($_POST["Pss"]);

     if (!preg_match("/^[a-zA-Z ]*$/",$Pss)) {
       $PasswordErr = "Invalid Password Format"; 
       $Status = false;
     }
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if($Status)
{
echo "<h2>Your Input:</h2>";
echo $Uname;
echo "<br>";
echo $Pss;
echo "<a href='Ok.php'>Login To Site</a>";
}
else
{
	echo "<h2>Login Form</h2>";
	echo "<p><span class='error'>* required field.</span></p><form method='post' action=";
echo htmlspecialchars($_SERVER["PHP_SELF"]);
echo ">Name: <input type='text' name='Uname' value=";
echo $Uname;
echo "><span class='error'>*";
echo $UsernameErr;
echo "</span><br><br>E-mail: <input type='text' name='Pss' value=";
echo $Pss;
echo "><span class='error'>*" ;
echo $PasswordErr;
echo '; </span><br><br><input type="submit" name="submit" value="Submit"></form>';

}
 ?>
</body>
</html>
