

<?php
session_start();

/* Prevent browser cache */
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/* BLOCK DIRECT ACCESS */
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    session_destroy();
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","inventory_system");

if(!$conn){
    die("Connection Failed");
}

/* TOTAL PRODUCTS */
$total_products = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM products"))['total'];

/* TOTAL STOCK */
$total_stock = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(quantity) as total FROM products"))['total'];

/* TOTAL PRICE */
$total_price = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(price * quantity) as total FROM products"))['total'];

/* LOW STOCK */
$low_stock = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM products WHERE quantity < 5"))['total'];

/* HIGH PRICE PRODUCT */
$high_price = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT MAX(price) as max_price FROM products"))['max_price'];

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>
<head>

    <title>Inventory Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#ffffff; 
    display:flex;
}
.stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin:20px;
}

.card{
    display:flex;
    background:#c3e24e;
    padding:20px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
    transition:0.3s;
    justify-content: space-around;
    align-items: center;
}

.card:hover{
    transform:translateY(-5px);
    background:#3498db;
    color:white;
}
.card .text{
   display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: flex-start;

}
.card .text p{
    font-size:10px;
    font-weight:normal;
    text-align:left;
}
.card .text h3{
    font-size:18px;
}
.card h3{
    margin-bottom:10px;
    font-size:18px;
}

.card p{
    font-size:30px;
    font-weight:bold;
}

/* Responsive */

@media(max-width:992px){
    .stats{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:600px){
    .stats{
        grid-template-columns:1fr;
    }
}
/* TOPBAR */
.topbar{
    background:#2c3e50;
    color:white;
    padding:20px;
    text-align:center;
    justify-content:center;
}

.topbar h2{
    font-size:22px;
}

.topbar p{
    margin-top:8px;
    font-size:14px;
}

/* MAIN CONTENT */

.main-content{
    padding:20px;
}

/* HEADING */

.head{
    margin-bottom:25px;
}

.head h1{
    color:black;
    margin-bottom:5px;
    padding-left: 20px;
}


/* CARD SECTION */

.card2{
   display:flex;
   padding:20px;
}

/* GRID */

.menu-grid{
    display:file_exists;
    grid-template-columns:repeat(5,1fr);
    gap:20px;
}

/* BOXES */

.box{
    background:white;
    border-radius:15px;
    padding:30px 20px;
    text-align:center;
    transition:0.3s;
    cursor:pointer;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.box:hover{
    transform:translateY(-5px);
    background:#3498db;
}

.box:hover a{
    color:white;
}

.box a{
    text-decoration:none;
    color:#2c3e50;
    font-size:16px;
    font-weight:600;
}

/* MOBILE MENU BUTTON */

.menu-btn{
    display:none;
    background:#3498db;
    color:white;
    padding:10px 15px;
    border:none;
    border-radius:8px;
    margin-bottom:20px;
    cursor:pointer;
}

/* TABLET RESPONSIVE */

@media(max-width:992px){

    .menu-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .topbar h2{
        font-size:20px;
    }

}

/* MOBILE RESPONSIVE */

@media(max-width:600px){

    .topbar{
        padding:15px;
    }

    .topbar h2{
        font-size:20px;
    }


    .main-content{
        padding:15px;
    }

    .head h1{
        font-size:20px;
    }

    .menu-grid{
        grid-template-columns:1fr;
    }

    .box{
        padding:25px 15px;
    }

    .box a{
        font-size:15px;
    }

}


/* ALL PRODUCTS CSS */


/* TOP BAR */
.topbar{
    display: flex;
    background: #2c3e50;
    color: white;
    padding: 20px;
  
    align-items: center;
}
.topbar .menuicon{
    width:10%;
}
.topbar .heading{
    width:75%;
}
/* CONTAINER */
.container{
    width:100%;
    margin:30px auto;
    background:white;
    border-radius:10px;
}
.container h2{
    font-size:20px;
    font-weight:600;    
    padding-bottom:15px;
}
/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:white;
    color:black ;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ccc;
}

tr:hover{
    background:#c3e24e;
}
.main-section{
display:block;
width:100%;
}




/* SIDEBAR MENU CSS*/




/* Menu Icon */
.menu{
    border-radius:0px 15px 15px 0px;
    background:#
}
.menu .logo{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.menu .logo h3{
    font-size:30px;
    color:#c3e24e;
}
.menu-icon{
    font-size:25px;
    cursor:pointer;
    margin-right:15px;
}

/* Sidebar */
.sidebar{
   
    width:250px;
    height:100%;
    background:white;
    padding-top:60px;
   
}

/* Sidebar active */
.sidebar.active{
    left:0;
}

/* Links */
.sidebar a{
    display:block;
    padding:15px;
    color:BLACK;
    text-decoration:none;
   background:#ffffff;
    cursor: pointer;
    margin:15px;
    border-radius:15px;
}

.sidebar a:hover{
    background:#c3e24e;
}

/* Overlay (important fix) */
.menuicon{
    display:none;   
}

/* SIDEBAR MENU ONLY SLIDEABLE IN MOBILE OR TABLET*/
@media(max-width:600px){

.menuicon{
    display:BLOCK;   
}
.sidebar{
    position:fixed;
    top:0;
    left:-260px;
    width:250px;
    height:100%;
    background:WHITE;
    padding-top:60px;
    transition:0.3s ease;
}

/* Sidebar active */
.sidebar.active{
    left:0;
}
.overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    display:none;
}

/* Show overlay */
.overlay.active{
    display:block;
}

}


</style>

</head>

<body>
    <div class="menu">
        <div class="logo">
            <h3>MENU</h3>
        </div>
         <div class="overlay" id="overlay" onclick="closeMenu()"></div>
        <div class="sidebar" id="sidebar">
            
            <a href="addproduct.php">Add Product</a>
            <a href="showproducts.php">Show Products</a>
            <a href="updatestock.php">Update Stock</a>
            <a href="deleteproduct.php">Delete Product</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
        

       





<!-- TOPBAR -->
<div class="main-section">
 

    <div class="topbar">  
        <div class="menuicon">
            <div class="menu-icon" onclick="toggleMenu()">☰</div>
        </div> 
        <div class="heading">
            <h2>Inventory Management System</h2>
        </div>
    </div>

<!-- MAIN CONTENT -->

<div class="main-content">

    <!-- HEADING -->

    <div class="head">

        <h1>Dashboard</h1>

    </div>
    <div class="stats">

    <div class="card">
        <div class="text">
        <h3>Total Products</h3>
        <p>Total Number of Products in Inventory</p>
        </div>
        <p><?php echo $total_products; ?></p>
    </div>

    <div class="card">
        <div class="text">
        <h3>Total Stock</h3>
        <p>Show the total stock left in Inventory</p>
        </div>
        
        <p><?php echo $total_stock; ?></p>
    </div>

    <div class="card">
        <div class="text">
                <h3>Total Value</h3>
                <p>Shows Total Amount of Products in Inventory</p>
        </div>
        
        <p><?php echo $total_price; ?></p>
    </div>

    <div class="card">
        <div class="text">
             <h3>Low Stock</h3>
        <p>Shows lowest Stock of Products in Inventory</p>
        </div>
        <p><?php echo $low_stock; ?></p>
    </div>

    <div class="card">
        <div class="text">
            <h3>Highest Price</h3>
        <p>Show Highest Price of a Products in Inventory</p>
        </div>
        <p><?php echo $high_price; ?></p>
    </div>

</div>
    <!-- MENU SECTION -->









<!-- SHOWS ALL PRODUCTS ON DASHBOARD  -->
<?php
/* GET PRODUCTS */
$query = "SELECT * FROM products";
$result = mysqli_query($conn,$query);
?>

<div class="container">

<h2>All Products</h2>

<table>

<tr>
    <th>Product ID</th>
    <th>Product Name</th>
    <th>Price</th>
    <th>Quantity</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
</tr>

<?php } ?>

</table>

</div>



</div>

<script>

function toggleMenu(){

    let sidebar = document.getElementById("sidebar");
    let overlay = document.getElementById("overlay");

    sidebar.classList.toggle("active");
    overlay.classList.toggle("active");
}

function closeMenu(){

    document.getElementById("sidebar").classList.remove("active");
    document.getElementById("overlay").classList.remove("active");
}

</script>


</body>
</html>