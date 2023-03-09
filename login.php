<?php
session_start();
if(isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
  if (password_verify($password, $user["password"])) {
    session_start();
    $_SESSION["user"] = "yes";
    header("Location: index.php");
    die();
  }else{
    echo "<div class='alert alert-danger'>Password does not match </div>";
  }
            }else{
                echo "<div class='alert alert-danger'>Email does not match </div>";
            }
        }
        
        ?>
        <form action="login.php" method="post">
        <p class="h3 text-center" style=" color:blue;">Login Form</p>
       <div class="form-group">
        <input type="email" placeholder="Enter Email" name="email" class="form-control">
</div>
<div class="form-group">
        <input type="password" placeholder="Enter Password" name="password" class="form-control">
</div>
<div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
</div>
</form>
<div><p> Not register yet <a href="registration.php">Register here </a> </p></div>
</div>


    </body>
</html>