<?php
    include "../config/connection.php";
    if(isset($_GET['pid']))
    {
        $pid = $_GET['pid'];                    
        $query = mysqli_query($conn,"select * from `product_details` where pid='$pid'");
        if(mysqli_num_rows($query)>0)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                $cname = $row['pname'];
                $cprice = intval($row['pprice']);
                $cimage = $row['pthumb1'];
            }
            $squery=mysqli_query($conn,"select * from `cart` where cname='$cname'");
            if(mysqli_num_rows($squery)>0)
            {
                header('location:../php/addtocart.php');
                $message[]="this product already in your cart";
            }
            else
            {
                $iquery = mysqli_query($conn,"insert into `cart` (cname,cprice,cimage) values ('$cname','$cprice','$cimage')");
                header('location:../php/product.php');
            }
            
        }
    }
    if(isset($_POST['submiter']))
    {
        $cid = $_POST['cid'];
        $cquantity = intval($_POST['update_quantity']);
        mysqli_query($conn,"update `cart` set quantity='$cquantity' where cid='$cid'");
        header('location:../php/addtocart.php');
    }
    if(isset($_GET['ccid']))
    {
        $ccid = $_GET['ccid'];
        mysqli_query($conn,"delete from `cart` where cid='$ccid'");
        header('location:../php/addtocart.php');
    }
    if(isset($_GET['delete']))
    {
        mysqli_query($conn,"delete from `cart`");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Pacifico&family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/addtocart.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <a href="../php/product.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Add To Cart</h1>
        <div class="product-cart">
            <br>
            <br>
            <table>
                <thead>
                    <th>Product No</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Amount</th>
                    <th>Product Remove</th>
                </thead>
                <tbody>
                <?php
                    $cquery = mysqli_query($conn,"select * from `cart`");
                    $grant_total=intval(0);
                    if(mysqli_num_rows($cquery)>0)
                    {
                        $i=1;
                        while($crow = mysqli_fetch_assoc($cquery))
                        {
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><img src="../product_image/<?php echo $crow['cimage'] ?>" alt="" height=75px></td>
                        <td><?php echo $crow['cname'] ?></td>
                        <td>₹<?php echo number_format($crow['cprice']) ?>/-</td>
                        <td>
                            <form action="addtocart.php" method="post">
                                <input type="hidden" name="cid" value="<?php echo $crow['cid'] ?>" >
                                <input type="number" name="update_quantity" min=1 value="<?php echo $crow['quantity'] ?>" class="number">
                                <input type="submit" name="submiter" value="update" class="submit">
                            </form>
                        </td>
                        <?php
                        $ccprice = $crow['cprice'];
                        $ccquantity = $crow['quantity'];
                        ?>
                        <td>₹<?php echo $sub_total=number_format($ccprice * $ccquantity) ?>/-</td>
                        <td><a href="../php/addtocart.php?ccid=<?php echo $crow['cid'] ?>">remove</a></td>
                    </tr>
                <?php
                        $i+=1;
                        $grant_total+=$sub_total;
                        }
                ?>
                <tr>
                    <td colspan="4" class="continue">continue shopping</td>
                    <td>Total Amount: </td>
                    <td>₹<?php echo $grant_total ?>/-</td>
                    <td><a href="../php/addtocart.php?delete">Delete All</a></td>
                    </tr>
                <?php
                    }
                    else{
                ?>
                    <tr>
                        <td colspan=7><?php echo "There is no product added"; ?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
        <br>
        <div class="check">
            <a href="../php/checkout.php" style="font-size: 20px; text-align:center; background-color: aqua; border-radius: 15px;">checkout</a>
        </div>
    </div>
</body>
</html>