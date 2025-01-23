<?php
    include "../config/connection.php";
    if(isset($_GET['pid']))
    {
        $ppid = $_GET['pid'];
        $query = mysqli_query($conn,"select * from `product_details` where pid='$ppid'");
        if(mysqli_num_rows($query)>0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $limage = $row['pthumb1'];
                $lname = $row['pname'];
                $lprice = $row['pprice'];
            }
        }
        $squery=mysqli_query($conn,"select * from `liked_products` where lname='$lname'");
        if(mysqli_num_rows($squery)>0)
        {
            $message[]="product is you already liked";
            header('location:../php/likes.php');
        }
        else{
            $lquery = mysqli_query($conn,"insert into `liked_products` (lname,lprice,limage) values ('$lname','$lprice','$limage')");
            header('location:../php/likes.php');
        }
    }
    if(isset($_GET['delete']))
    {
        $d=$_GET['delete'];
        mysqli_query($conn,"delete from `liked_products` where lid='$d'");

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
    <link rel="stylesheet" href="../css/likes.css">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center;">Your Favourite Products</h1>
    <div class="container">
        <a href="../php/product.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="liked-product">
            <table>
                <thead>
                    <th>Product Id</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>action</th>
                </thead>
                <tbody>
                    <?php
                    $lquery = mysqli_query($conn,"select * from `liked_products`");
                    if(mysqli_num_rows($lquery)>0)
                    {
                        $i=1;
                        while($lrow=mysqli_fetch_assoc($lquery))
                        {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><img src="../product_image/<?php echo $lrow['limage'] ?>" alt="" height=50px></td>
                            <td><?php echo $lrow['lname'] ?></td>
                            <td><?php echo $lrow['lprice'] ?></td>
                            <td><a href="../php/likes.php?delete=<?php echo $lrow['lid'] ?>">remove</a></td>
                        </tr>
                    <?php
                        $i+=1;
                        }
                    }
                    else{
                    ?>
                        <tr>
                            <td colspan=5><h2>you not add any product as a favourite</h2></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>