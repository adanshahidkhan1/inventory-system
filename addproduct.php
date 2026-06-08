<?php

session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.html");
}

$conn = mysqli_connect("localhost","root","","inventory_system");

if(!$conn){
    die("Connection Failed");
}

/* Insert Product */

if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $query = "INSERT INTO products(product_name,price,quantity)
              VALUES('$product_name','$price','$quantity')";

    $result = mysqli_query($conn,$query);

    if($result){
        echo "<script>alert('Product Added Successfully')</script>";
    }
    else{
        echo "<script>alert('Failed To Add Product')</script>";
    }

}

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
           font-family:'Poppins', sans-serif;
        }

        body{
            background:#ecf0f1;
        }

        .container{
            width:400px;
            background:white;
            margin:50px auto;
            padding:30px;
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
            background:#c3e24e;
            color:black;
            border:none;
            cursor:pointer;
        }

        button:hover{
            background:#34495e;
        }

        a{
            text-decoration:none;
        }

        .back-btn{
            display:block;
            text-align:center;
            margin-top:15px;
        }

    </style>

</head>
<body>

    <div class="container">

        <h2>Add Product</h2>

        <form method="POST">

            <input type="text"
                   name="product_name"
                   placeholder="Enter Product Name"
                   required>

            <input type="number"
                   name="price"
                   placeholder="Enter Product Price"
                   required>

            <input type="number"
                   name="quantity"
                   placeholder="Enter Product Quantity"
                   required>

            <button type="submit" name="add_product">
                Add Product
            </button>

        </form>

        <a class="back-btn" href="dashboard.php">
            Back To Dashboard
        </a>

    </div>

</body>
</html>