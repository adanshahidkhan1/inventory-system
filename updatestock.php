<?php

session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.html");
}

$conn = mysqli_connect("localhost","root","","inventory_system");

if(!$conn){
    die("Connection Failed");
}

/* Update Stock */

if(isset($_POST['update_stock'])){

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
 $price = $_POST['price'];
    $query = "UPDATE products
              SET quantity='$quantity' , 
              price='$price'
              WHERE product_id='$product_id'";

    $result = mysqli_query($conn,$query);

    if($result){
        echo "<script>alert('Stock Updated Successfully')</script>";
    }
    else{
        echo "<script>alert('Failed To Update Stock')</script>";
    }

}

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>
    <title>Update Stock</title>

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

        .back-btn{
            display:block;
            text-align:center;
            margin-top:15px;
            text-decoration:none;
        }

    </style>

</head>
<body>

    <div class="container">

        <h2>Update Product Stock</h2>

        <form method="POST">

            <input type="number"
                   name="product_id"
                   placeholder="Enter Product ID"
                   required>

                     <input type="number"
                   name="price"
                   placeholder="Enter New price"
                   >

            <input type="number"
                   name="quantity"
                   placeholder="Enter New Quantity"
                   >

            <button type="submit" name="update_stock">
                Update Stock
            </button>

        </form>

        <a class="back-btn" href="dashboard.php">
            Back To Dashboard
        </a>

    </div>

</body>
</html>