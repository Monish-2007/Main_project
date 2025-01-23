<?php
    include "../config/connection.php";
    $cquery=mysqli_query($conn,"select * from `orders` where id=1");
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
    <link rel="stylesheet" href="../css/demo.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php
        if(mysqli_num_rows($cquery)>0)
        {
            while($row=mysqli_fetch_assoc($cquery))
            {
        ?>
        <div class="customer">
            <h1>Customer Details</h1>
            <br>
            <h2>Customer Name: <?php echo $row['name'] ?></h2>
            <br>
            <h2>Customer No: <?php echo $row['number'] ?></h2>
            <br>
            <h2>Customer email: <?php echo $row['email'] ?></h2>
            <br>
            <h2>Customer Flat no: <?php echo $row['flat'] ?></h2>
            <br>
            <h2>Customer Street: <?php echo $row['street'] ?></h2>
            <br>
            <h2>Customer City: <?php echo $row['city'] ?></h2>
            <br>
            <h2>Customer Pincode: <?php echo $row['pincode'] ?></h2>
            <br>
            <h2>Customer State: <?php echo $row['state'] ?></h2>
            <br>
            <h2>Customer Country: <?php echo $row['country'] ?></h2>
        </div>
        <?php
            }
        }
        ?>
        
    </div>
</body>
</html>