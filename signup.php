<?php

$conn = mysqli_connect("localhost","root","","inventory_system");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $check = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){

        echo "<script>alert('Email already exists!');</script>";

    }else{

        $query = "INSERT INTO users(name,email,password)
                  VALUES('$name','$email','$password')";

        if(mysqli_query($conn,$query)){

            echo "<script>
                alert('Registration Successful');
                window.location='login.php';
            </script>";

        }else{

            echo mysqli_error($conn);
        }
    }
}

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sign Up</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', Arial, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#2c3e50,#3498db);
    padding:20px;
}

.signup-container{
    width:100%;
    max-width:420px;
    background:#fff;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.signup-header{
    background:#2c3e50;
    color:#fff;
    text-align:center;
    padding:25px;
}

.signup-header h2{
    font-size:28px;
    margin-bottom:5px;
}

.signup-header p{
    font-size:14px;
}

.signup-form{
    padding:30px;
}

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    margin-bottom:6px;
    font-weight:600;
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
    border-color:#3498db;
}

button{
      font-family: "Poppins", sans-serif;
    width:100%;
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

.login-link{
    text-align:center;
    margin-top:15px;
}

.login-link a{
    color:#3498db;
    text-decoration:none;
    font-weight:600;
}

/* Tablet */
@media(max-width:768px){

    .signup-container{
        max-width:500px;
    }

    .signup-header h2{
        font-size:24px;
    }

}

/* Mobile */
@media(max-width:480px){

    body{
        padding:15px;
    }

    .signup-form{
        padding:20px;
    }

    .signup-header{
        padding:20px;
    }

    .signup-header h2{
        font-size:22px;
    }

    input{
        padding:10px;
        font-size:14px;
    }

    button{
        padding:12px;
        font-size:15px;
    }

}

</style>

</head>
<body>

<div class="signup-container">

    <div class="signup-header">
        <h2>Create Account</h2>
        <p>Inventory Management System</p>
    </div>

    <div class="signup-form">

        <form action="signup.php" method="POST">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text"
                       name="name"
                       placeholder="Enter your name"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       placeholder="Enter your email"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password"
                       name="password"
                       placeholder="Enter your password"
                       required>
            </div>

            <button type="submit" name="signup">
                Sign Up
            </button>

        </form>

        <div class="login-link">
            Already have an account?
            <a href="login.php">Login</a>
        </div>

    </div>

</div>

</body>
</html>