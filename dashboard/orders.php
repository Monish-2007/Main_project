<?php
    include "../config/connection.php";

    if(isset($_GET['cds']))
    {
        $oid = $_GET['cds'];
        $oquery = mysqli_query($conn,"select * from `orders` where id='$oid'");
        if(mysqli_num_rows($oquery)>0)
        {
            while($row=mysqli_fetch_assoc($oquery))
            {
        ?>
        <div class="customer">
            <h1>Customer Details</h1>
            <div class="detail-box">
                <h3>Customer Name: </h3><span><?php echo $row['name'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer No: </h3><span><?php echo $row['number'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer email: </h3><span><?php echo $row['email'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer Flat no: </h3><span><?php echo $row['flat'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer Street: </h3><span><?php echo $row['street'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer City: </h3><span><?php echo $row['city'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer Pincode: </h3><span><?php echo $row['pincode'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer State: </h3><span><?php echo $row['state'] ?></span>
            </div>
            <div class="detail-box">
                <h3>Customer Country: </h3><span><?php echo $row['country'] ?></span>
            </div>
            <div class="back-btn">
                <a href="../dashboard/orders.php">Go Back</a>
            </div>
        </div>
        <?php
            }
        }
    }
    if(isset($_GET['order_d']))
    {
        $did = $_GET['order_d'];
        $dquery = mysqli_query($conn,"delete from `orders` where id='$did'");
        if($dquery)
        {
            echo "
            <div class='delete-message' id='mess'>
                <h3>order is deleted sucessfully</h3>
                <i class='fa-solid fa-xmark' id='messi' style='cursor:pointer;'></i>
            </div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/orders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Pacifico&family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Orders</title>
</head>
<body>
    <div class="container">
        <a href="../dashboard/admin.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="order-box">
            <h1> Flipzon Orders</h2>
            <?php
                $squery=mysqli_query($conn,"select * from `orders`");
                if(mysqli_num_rows($squery)>0)
                {
                    $i=1;
                    while($row = mysqli_fetch_assoc($squery))
                    {
            ?>
            
            <div class="orders">
                <div class="order_id">
                    <span>Order No: <?php echo $i ?></span>
                    <span>Order Id: <?php echo $row['id'] ?></span>
                    <span>Order Placed Time: <?php echo $row['times'] ?></span>
                </div>
                <br>
                <h2>Ordered Products</h2>
                <br>
                <div class="product_details">
                    <span><?php echo $row['total_products'] ?></span>
                </div>
                <br>
                <div class="total">
                    <span>Total Price: ₹<?php echo $row['total_price'] ?>/-</span>
                </div>
                <br>
                <div class="method_btn">
                    <div class="method">
                        <h2><?php echo $row['method'] ?></h2>
                    </div>
                    <div class="btn">
                        <a href="#">Accept</a>
                        <a href="../dashboard/orders.php?order_d=<?php echo $row['id'] ?>" onclick="confirm('Are you sure to delete this order')">Delete order</a>
                        <a href="../dashboard/orders.php?cds=<?php echo $row['id'] ?>">Customer Details</a>
                    </div>
                </div>
            </div>
            <?php
                    $i+=1;
                    }
                }
            ?>
        </div>
    </div>
    <script>
        document.getElementById('messi').addEventListener("click",function()
        {
            document.getElementById('mess').style.display="none";
        });
    </script>
</body>
</html>