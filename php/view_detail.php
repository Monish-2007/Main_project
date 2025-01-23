<?php
    include "../config/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/view_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Pacifico&family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <title>view_detail</title>
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
                    <li><a href="../php/category.php">Category</a></li>
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
            <?php
            include "../config/connection.php";
            if(isset($_GET['pid']))
            {
                $pid = $_GET['pid'];
                $query = mysqli_query($conn,"select * from `product_details` where pid = '$pid'");
                if(mysqli_num_rows($query)>0)
                {
                    while($row = mysqli_fetch_assoc($query))
                    {
            ?>
                        <div class="view_detail">
                        <div class="p-images">
                            <div class="main-image">
                                <img src="../product_image/<?php echo $row['pthumb1'] ?>" alt="" style="width: 450px; height: 300px; border: 1px solid black;" id="mainimage">
                            </div>
                            <div class="sub-image">
                                <img src="../product_image/<?php echo $row['pthumb1'] ?>" alt="" style="width: 100px; height: 100px; border: 1px solid black;">
                                <img id="thumb2" src="../product_image/<?php echo $row['pthumb2'] ?>" alt="" style="width: 100px; height: 100px; border: 1px solid black;">
                                <img src="../product_image/<?php echo $row['pthumb3'] ?>" alt="" style="width: 100px; height: 100px; border: 1px solid black;" id="thumb3">
                                <img src="../product_image/<?php echo $row['pthumb4'] ?>" alt="" style="width: 100px; height: 100px; border: 1px solid black;" id="thumb4">
                            </div>
                        </div>
                        <div class="p-content">
                            <div class="p-sub-content">
                                <h1><?php echo $row['pname'] ?></h1>
                                <br>
                                <div class="p-desc">
                                    <h3>Description: <?php echo $row['pdesc'] ?></h3>
                                </div>
                                <br>
                                <h2>₹ <?php echo $row['pprice']?>/-</h2>
                            </div>
                            <div class="button">
                                <a href="../php/addtocart.php?pid=<?php echo $row['pid'] ?>">Buy</a>
                                <a href="">See more</a>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }
            }
            ?>
            
        </div>
    </div>
    <script type="text/javascript">
        var main=document.querySelector("#mainimage"),
              thumb2=document.querySelector("#thumb2"),
              thumb2src=document.querySelector("#thumb2").src,
              thumb3=document.querySelector("#thumb3"),
              thumb3src=document.querySelector("#thumb3").src,
              thumb4=document.querySelector("#thumb4"),
              thumb4src=document.querySelector("#thumb4").src;

        thumb2.addEventListener('click',()={
            main.src=thumb2src
        })
        thumb3.addEventListener('click',()={
            main.src=thumb3src
        })
        thumb4src.addEventListener('click',()={
            main.src=thumb4src
        })

    </script>
</body>
</html>