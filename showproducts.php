<?php

session_start();

if(!isset($_SESSION['email'])){
    header("Location: login.html");
}

$conn = mysqli_connect("localhost","root","","inventory_system");

if(!$conn){
    die("Connection Failed");
}

/* Fetch Products */

$query = "SELECT * FROM products";

$result = mysqli_query($conn,$query);

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>
    <title>Show Products</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            background:#ecf0f1;
            padding:30px;
        }

        .container{
            width:90%;
            margin:auto;
            background:white;
            padding:20px;
            border-radius:10px;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#c3e24e;
            color:BLACK;
            padding:12px;
        }

        table td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #ccc;
        }

        tr:hover{
            background:#f5f5f5;
        }

        .back-btn{
            display:inline-block;
            margin-top:20px;
            padding:10px 15px;
            background:#c3e24e;
            color:black;
            text-decoration:none;
            border-radius:5px;
        }

    </style>

</head>
<body>

    <div class="container">

        <h2>All Products</h2>

        <table border="1">

            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php

            while($row = mysqli_fetch_assoc($result)){

            ?>

            <tr>

                <td>
                    <?php echo $row['product_id']; ?>
                </td>

                <td>
                    <?php echo $row['product_name']; ?>
                </td>

                <td>
                    <?php echo $row['price']; ?>
                </td>

                <td>
                    <?php echo $row['quantity']; ?>
                </td>

            </tr>

            <?php

            }

            ?>

        </table>

        <a class="back-btn" href="dashboard.php">
            Back To Dashboard
        </a>

    </div>

</body>
</html>