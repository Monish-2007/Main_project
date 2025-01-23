<?php
    include "./config/connection.php";
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="/img/icon.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Pacifico&family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Flipzon</title>
</head>
<body>
    <div class="main-container">
        <div class="sub-container1">
            <div class="logo">
                <h1>Flipzon</h1>
            </div>
            <div class="search">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="text" placeholder="Search Product" name="search">
                    <button type="submit" name="submiter"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form> 
            </div>
            <div class="nav-bar">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="./php/product.php">Product</a></li>
                    <li><a href="./php/category.php">Category</a></li>
                    <li><a href="./php/about.html">About</a></li>
                    <li><a href="./php/login.html">Login</a></li>
                </ul>
            </div>
            <div class="icon-detail">
                <a href="./php/likes.php"><i class="fa-regular fa-heart"></i></a>
                <a href="./php/addtocart.php"><i class="fa-solid fa-cart-shopping"></i></a>
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
            <div class="discount-page">
                <div class="content">
                    <h1>Offer Ever</h1>
                    <h3>Best Selling Product</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus et, temporibus quidem adipisci nam accusantium dolorem nisi quibusdam, ullam quo officia. Recusandae esse molestiae reprehenderit quasi omnis minima et ex?</p>
                </div>
                <div class="image">
                    <img src="./img/discount.png" alt="" class="soffer">
                </div>
            </div>
        </div>
        <div class="sub-container3">
            <div class="search-product">
            <?php
                if(isset($_POST['submiter']))
                {
                    $search=$_POST['search'];
                    $query = mysqli_query($conn,"select * from `product_details` where pid like '%$search%' or pname like '%$search%'");
                    if(mysqli_num_rows($query)>0)
                    {
                        while($row=mysqli_fetch_assoc($query))
                        {
            ?>
                <div class="p1">
                    <a href="./php/likes.php?pid=<?php echo $row['pid'] ?>" id="plike"><i class="fa-solid fa-heart"></i></a>
                    <img src="./product_image/<?php echo $row['pthumb1'] ?>" alt="">
                    <h3><?php echo $row['pname'] ?></h3>
                    <h3>₹<?php echo $row['pprice'] ?></h3>
                    <div class="button">
                        <a href="./php/view_detail.php?pid=<?php echo $row['pid'] ?>">details</a>
                        <a href="./php/addtocart.php?pid=<?php echo $row['pid'] ?>">Add to Cart</a>
                    </div>
                </div>

            <?php
                        }
                    }
                }
            ?>
                
            </div>
        </div>
    </div>
</body>
</html>