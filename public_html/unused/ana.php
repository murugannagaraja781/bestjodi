<?php
function redirect_to($new_location){
echo "<script>window.location='".$new_location."'</script>";
//header("Location :" . $new_location);
}

if(isset($_POST['submit'])) {

$username=$_POST["username"];
$password=$_POST["password"];


if($username == "jay" && $password == "pass"){
redirect_to("basic.html");
$message="login success";
}else{
$message="there are some errors";
}
}
$message='login'
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>login</title>
</head>

<body>
<?php
echo $message;
?>
<form action="" method="post">
<label>
    Username:
   </label>
   <input type="text" name="username" value="">
   <label>
    Password:
   </label>
   <input type="text" name="password" value="">
   <input type="submit" name="submit" value="submit">
</form>
</body>
</html>                                                                                                                              <?php include'thumbnailjs.php';?>                  