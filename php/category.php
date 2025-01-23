<?php
    include "../config/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/category.css">
    <link rel="icon" href="/img/icon.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Pacifico&family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Category</title>
</head>
<body>
    <div class="main-container">
        <div class="sub-container1">
            <div class="logo">
                <h1>Flipzon</h1>
            </div>
            <div class="search">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Search Product">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form> 
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../php/product.php">Product</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="../php/about.html">About</a></li>
                    <li><a href="../php/login.html">Login</a></li>
                </ul>
            </div>
            <div class="icon-detail">
                <a href="../php/likes.php"><i class="fa-regular fa-heart"></i></a>
                <a href="../php/addtocart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href=""><i class="fa-solid fa-circle-user"></i></a>
                <?php
                $count_cart=mysqli_query($conn,"select count(*) as count from `cart`");
                while($ccart=mysqli_fetch_assoc($count_cart))
                {
                ?>
                    <span id="count_cart"><?php echo $ccart['count'] ?></span>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="sub-container2">
            <div class="category">
                <div class="c1">
                    <img src="../img/cfruit" alt="">
                    <h3>Fruits</h3>
                    <a href="../php/c_product.php?pcategory=Fruits">Explore</a>
                </div>
                <div class="c1">
                    <img src="../img/cvegetables.jpg" alt="">
                    <h3>Vegetables</h3>
                    <a href="../php/c_product.php?pcategory=Vegetables">Explore</a>
                </div>
                <div class="c1">
                    <img src="../img/cdairy.jpg" alt="">
                    <h3>Dairy Products</h3>
                    <a href="../php/c_product.php?pcategory=DairyProducts">Explore</a>
                </div>
                <div class="c1">
                    <img src="/img/cfruit" alt="">
                    <h3>Fruits</h3>
                    <a href="">Explore</a>
                </div>
                <div class="c1">
                    <img src="/img/cfruit" alt="">
                    <h3>Fruits</h3>
                    <a href="">Explore</a>
                </div>
                <div class="c1">
                    <img src="/img/cfruit" alt="">
                    <h3>Fruits</h3>
                    <a href="">Explore</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>