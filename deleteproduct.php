<?php

session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.html");
}

$conn = mysqli_connect("localhost","root","","inventory_system");

if(!$conn){
    die("Connection Failed");
}

/* DELETE PRODUCT */

if(isset($_POST['delete_product'])){

    $product_id = $_POST['product_id'];

    $query = "DELETE FROM products WHERE product_id='$product_id'";

    $result = mysqli_query($conn,$query);

    if($result){
        echo "<script>alert('Product Deleted Successfully')</script>";
    }
    else{
        echo "<script>alert('Failed To Delete Product')</script>";
    }
}

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>

    <style>

        body{
           font-family:'Poppins', sans-serif;
            background:#ecf0f1;
        }

        .container{
            width:350px;
            background:white;
            margin:60px auto;
            padding:25px;
            border-radius:10px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        input{
            width:100%;
            padding:10px;
            margin-bottom:15px;
        }

        button{
            width:100%;
            padding:10px;
            background:red;
            color:white;
            border:none;
            cursor:pointer;
        }

        button:hover{
            background:darkred;
        }

        a{
            display:block;
            text-align:center;
            margin-top:15px;
            text-decoration:none;
        }

    </style>

</head>
<body>

<div class="container">

    <h2>Delete Product</h2>

    <form method="POST">

        <input type="number"
               name="product_id"
               placeholder="Enter Product ID"
               required>

        <button type="submit" name="delete_product">
            Delete Product
        </button>

    </form>

    <a href="dashboard.php">Back To Dashboard</a>

</div>

</body>
</html>