<?php
session_start();

$conn = mysqli_connect("localhost","root","","inventory_system");
if(!$conn){ die("Connection Failed"); }

/* GET PRODUCT */
if(isset($_GET['action']) && $_GET['action']=="get_product"){

    header('Content-Type: application/json');

    $id = $_GET['id'];

    $q = "SELECT * FROM products WHERE product_id='$id'";
    $r = mysqli_query($conn,$q);

    if(mysqli_num_rows($r)>0){
        $row = mysqli_fetch_assoc($r);

        echo json_encode([
            "status"=>"ok",
            "name"=>$row['product_name'],
            "price"=>$row['price'],
            "quantity"=>$row['quantity']
        ]);
    } else {
        echo json_encode(["status"=>"error","msg"=>"Product not found"]);
    }
    exit;
}

/* CREATE INVOICE */
if(isset($_POST['action']) && $_POST['action']=="invoice"){

    header('Content-Type: application/json');

    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $q = "SELECT * FROM products WHERE product_id='$id'";
    $r = mysqli_query($conn,$q);

    if(mysqli_num_rows($r)==0){
        echo json_encode(["status"=>"error","msg"=>"Product not found"]);
        exit;
    }

    $row = mysqli_fetch_assoc($r);

    if($qty > $row['quantity']){
        echo json_encode(["status"=>"error","msg"=>"Not enough stock"]);
        exit;
    }

    $total = $qty * $row['price'];
    $newQty = $row['quantity'] - $qty;

    mysqli_query($conn,"UPDATE products SET quantity='$newQty' WHERE product_id='$id'");

    mysqli_query($conn,"INSERT INTO invoices
    (product_id, product_name, quantity, price, total_amount)
    VALUES
    ('$id','{$row['product_name']}','$qty','{$row['price']}','$total')");

    echo json_encode(["status"=>"ok","total"=>$total]);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice System</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

/* BACKGROUND */
body{
    font-family:'Poppins', sans-serif;
    margin:0;
    padding:0;
    background:linear-gradient(135deg,#2c3e50,#3498db);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* MAIN CONTAINER */
.wrapper{
    width:900px;
    background:white;
    border-radius:15px;
    display:flex;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

/* LEFT FORM */
.left{
    width:40%;
    background:#f7f7f7;
    padding:25px;
}

.left h2{
    text-align:center;
    margin-bottom:20px;
}

/* RIGHT INFO */
.right{
    width:60%;
    padding:25px;
}

.right h2{
    margin-bottom:20px;
}

/* INPUTS */
input{
    width:100%;
    padding:12px;
    margin-bottom:12px;
    border:1px solid #ccc;
    border-radius:20px;
    outline:none;
}

input:focus{
    border-color:#c3e24e;
}

/* BUTTONS */
.btns{
display:flex;
}
button{
    width:50%;
    padding:12px;
    border:none;
    background:#c3e24e;
    color:black;
    border-radius:20px;
    cursor:pointer;
    font-weight:bold;
}

button:hover{
    background:#b6d93e;
}
.invoice-btn{
    display:flex;   
    flex-direction: row;
    justify-content: flex-end;
}
/* PRODUCT BOX */
.box{
    height:100px;
    background:#f5f5f5;
    padding:15px;
    border-radius:10px;
    margin-bottom:10px;
    font-size:14px;
}

/* RESULT */
.result{
    font-size:18px;
    font-weight:bold;
    margin-top:10px;
    color:green;
}

/* ERROR */
.error{
    color:red;
    font-weight:bold;
}

/* RESPONSIVE */
@media(max-width:768px){
    .wrapper{
        flex-direction:column;
        width:95%;
    }

    .left,.right{
        width:100%;
    }
}

</style>
</head>

<body>

<div class="wrapper">

    <!-- LEFT SIDE FORM -->
    <div class="left">

        <h2>Create Invoice</h2>
        <div class="data">
            <h3> Enter Product ID
            </h3>
  <input type="number" id="pid" placeholder="Product ID">
   <input type="number" id="qty" placeholder="Quantity">
        </div>
      
       <div class="btns">
 <button onclick="getProduct()">Fetch Product</button>

       </div>
       

       
       

    </div>

    <!-- RIGHT SIDE DISPLAY -->
    <div class="right">

        <h2>Product Details</h2>

        <div class="box" id="info">
            Enter product ID to view details
        </div>

        <div class="result" id="result"></div>
  <div class="invoice-btn">
    <button onclick="makeInvoice()">Generate Invoice</button>
  </div>
    </div>

</div>

<script>

/* GET PRODUCT */
function getProduct(){

    let id = document.getElementById("pid").value;

    fetch("invoice.php?action=get_product&id="+id)
    .then(res=>res.json())
    .then(data=>{

        if(data.status=="ok"){
            document.getElementById("info").innerHTML =
            "📦 Name: "+data.name+"<br>"+
            "💰 Price: "+data.price+"<br>"+
            "📊 Stock: "+data.quantity;

            document.getElementById("result").innerHTML = "";
        } else {
            document.getElementById("info").innerHTML =
            "<span class='error'>"+data.msg+"</span>";
        }

    });

}

/* CREATE INVOICE */
function makeInvoice(){

    let id = document.getElementById("pid").value;
    let qty = document.getElementById("qty").value;

    fetch("invoice.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:"action=invoice&id="+id+"&qty="+qty
    })
    .then(res=>res.json())
    .then(data=>{

        if(data.status=="error"){
            document.getElementById("result").innerHTML =
            "<span class='error'>"+data.msg+"</span>";
        }else{
            document.getElementById("result").innerHTML =
            "🧾 Total Bill: "+data.total;
        }

    });

}

</script>

</body>
</html> 