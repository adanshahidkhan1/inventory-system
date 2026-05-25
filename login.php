<?php

session_start();

/* Prevent cache */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/* If already logged in */

if(isset($_SESSION['email'])){
    header("Location: dashboard.php");
    exit();
}

/* DATABASE CONNECTION */

$conn = mysqli_connect("localhost","root","","inventory_system");

if(!$conn){
    die("Connection Failed");
}

/* LOGIN CHECK */

if(isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users
              WHERE email='$email'
              AND password='$password'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['email'] = $email;

        header("Location: dashboard.php");
        exit();

    }else{

        echo "<script>alert('Invalid Email or Password')</script>";
    }
}

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

body{
    font-family: "Poppins", sans-serif;
    margin:0;
    padding:0;
    font-family:Arial;
    background: linear-gradient(135deg, #2c3e50, #3498db);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.heading h2{
      font-family: "Poppins", sans-serif;
    color:#000;
    background:white;
    padding:15px 0;
    border-radius:10px 10px 0 0;
    margin:0;
    text-align:center;
}
.heading p{
    font-family: "Poppins", sans-serif;
    color:#000;
    background:white;
    margin:0;
    text-align:center;
}
form{
    background:white;
    padding:30px;
    width:300px;
    border-radius:0 0 10px 10px;
}

label{
      font-family: "Poppins", sans-serif;
    font-weight:bold;
    color:#333;
}

input{
      font-family: "Poppins", sans-serif;
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:15px;
    outline:none;
}

input:focus{
    border-color:#c3e24e;
}

button{
    font-family: "Poppins", sans-serif;
    width:100%;
    padding:10px;
    background:#c3e24e;
    color:black;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
    border-radius:20px;
    padding:15px;
}

button:hover{
    background:#2980b9;
}

/* Mobile */

@media (max-width:480px){

    form{
        width:90%;
        padding:20px;
    }

}

</style>

</head>

<body>

<div class="heading">

    <h2>Welcome Back</h2>
    <p>Login to access your account</p>
    <form action="" method="POST">

        <label>Email:</label><br>

        <input type="email"
               name="email"
               required>

        <br><br>

        <label>Password:</label><br>

        <input type="password"
               name="password"
               required>

        <br><br>

        <button type="submit">
            Login
        </button>

    </form>

</div>

</body>
</html>