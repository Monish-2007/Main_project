<?php
    include "../config/connection.php";

    if(isset($_POST['order_btn']))
    {
        $name = $_POST['uname'];
        $number = $_POST['unumber'];
        $email = $_POST['uemail'];
        $method = $_POST['umethod'];
        $flat = $_POST['uaddress1'];
        $street = $_POST['uaddress2'];
        $city = $_POST['ucity'];
        $state = $_POST['ustate'];
        $country = $_POST['ucountry'];
        $pin = $_POST['upin'];

        $cart_query = mysqli_query($conn,"select * from `cart`");
        $product_total=0;
        if(mysqli_num_rows($cart_query)>0)
        {
            while($product_item=mysqli_fetch_assoc($cart_query))
            {
                $product_name[] = $product_item['cname'] .' ('.$product_item['quantity'].' )';
                $product_price = number_format($product_item['cprice'] * $product_item['quantity']);
                $product_total += $product_price;
            }
        }
        $total_product=implode(', ',$product_name);
        $detail_query = mysqli_query($conn,"insert into orders (name,number,email,method,flat,street,city,state,country,pincode,total_products,total_price) values ('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin','$total_product','$product_total')");
        if($cart_query && $detail_query)
        {
            echo"
                <div class='order-message-container'>
                    <div class='message-container'>
                        <h2>Thank you For Shopping</h2>
                        <div class='order-detail'>
                            <span>".$total_product."</span>
                            <span class='total'>Total: ₹ ".$product_total."/- </span>
                        </div>
                        <div class='customer-details'>
                            <p>Your Name: <span>".$name."</span> </p>
                            <p>Your Number: <span>".$number."</span> </p>
                            <p>Your Email: <span>".$email."</span> </p>
                            <p>Your Address: <span>".$flat.','.$street.','.$city.','.$state.','.$country."</span> </p>
                            <p>Your Payment Mode: <span>".$method."</span></p>
                            <p>(*pay when product arrives*)</p>
                        </div>
                        <div class='btn'>
                            <a href='../php/product.php'>Continue Shopping</a>
                        </div>
                    </div>
                </div>      
            ";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="icon" href="/img/icon.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Pacifico&family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <title>checkout</title>
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
            <div class="checkout-form">
                <h1>Complete Your Order</h1>
                <div class="form">
                    <div class="display-order">
                        <?php
                        $select_cart = mysqli_query($conn,"select * from `cart`");
                        $total=0;
                        $grand_total=0;
                        if(mysqli_num_rows($select_cart)>0)
                        {
                            while($fetch_cart=mysqli_fetch_assoc($select_cart))
                            {
                            $total_price = number_format($fetch_cart['cprice'] * $fetch_cart['quantity']);
                            $grand_total = $total+=$total_price;
                    ?>
                            <span class="productwithquantity"><?php echo $fetch_cart['cname']; ?>(<?php echo $fetch_cart['quantity']; ?>)</span>
                    <?php
                            }
                        }
                        else
                        {
                            echo "<div id='empty'><span>your cart is empty</span></div>";
                        }
                    ?>
                        <br>
                        <span class="grand-total">Grand Total:  ₹<?php echo $grand_total ?>/-</span>
                    </div>
                    <div class="form-box">
                    <form action="" method="post">
                        <div class="inputbox">
                            <label>Your Name:</label>
                            <input type="text" name="uname" placeholder="Enter Your Name" required>
                        </div>
                        <div class="inputbox">
                            <label>Your Number:</label>
                            <input type="text" name="unumber" placeholder="Enter Your Number" required>
                        </div>
                        <div class="inputbox">
                            <label>Your Email:</label>
                            <input type="email" name="uemail" placeholder="Enter Your Email" required>
                        </div>
                        <div class="inputbox">
                            <label>Pay Method:</label>
                            <select name="umethod">
                                <option value="cash on delivery">cash on delivery</option>
                                <option value="credit card">credit card</option>
                                <option value="online transaction">online transaction</option>
                            </select>
                        </div>
                        <div class="inputbox">
                            <label>Address Line1:</label>
                            <input type="text" name="uaddress1" placeholder="e.g: Flat No" required>
                        </div>
                        <div class="inputbox">
                            <label>Address Line2:</label>
                            <input type="text" name="uaddress2" placeholder="e.g: Street Name" required>
                        </div>
                        <div class="inputbox">
                            <label>City:</label>
                            <input type="text" name="ucity" placeholder="Enter Your City" required>
                        </div>
                        <div class="inputbox">
                            <label>State:</label>
                            <input type="text" name="ustate" placeholder="Enter Your State" required>
                        </div>
                        <div class="inputbox">
                            <label>Country:</label>
                            <input type="text" name="ucountry" placeholder="Enter Your Country" required>
                        </div>
                        <div class="inputbox">
                            <label>Pin Code:</label>
                            <input type="text" name="upin" placeholder="Enter Your Pincode" required>
                        </div>
                        <input type="submit" value="Order Now" name="order_btn" class="submit">
                    </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>