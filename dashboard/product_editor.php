<?php
    include "../config/connection.php";

    if(isset($_GET['did']))
    {
        $did = $_GET['did'];
        $dquery = mysqli_query($conn,"delete from product_details where pid='$did'") or die("some error occured in deletion process");
    }
    if(isset($_GET['uid']))
    {
        $uid =$_GET['uid'];
        $squery=mysqli_query($conn,"select * from `product_details` where pid='$uid'");
        if(mysqli_num_rows($squery)>0)
        {
            while($row = mysqli_fetch_assoc($squery))
            {
        ?>
        <form action="../dashboard/product_editor.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pid" value="<?php echo $row['pid'] ?>">
                <div class="inputbox">
                    <label>Product Name: </label>
                    <input type="text" name="pname" placeholder="Enter Product Name" value="<?php echo $row['pname'] ?>">
                </div>
                <div class="inputbox">
                    <label>Product Price: </label>
                    <input type="text" name="pprice" placeholder="Enter Product Price" value="<?php echo $row['pprice'] ?>">
                </div>
                <div class="inputbox">
                    <label>Product Category: </label>
                    <select name="pcategory" value="<?php echo $row['pcategory'] ?>">
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="DairyProducts">DairyProducts</option>
                    </select>
                </div>
                <div class="inputbox">
                    <label>Main Image: </label>
                    <input type="file" name="pthumb1" value="<?php echo $row['pthumb1'] ?>">
                </div>
                <div class="inputbox">
                    <label>Sub Image 1: </label>
                    <input type="file" name="pthumb2" value="<?php echo $row['pthumb2'] ?>">
                </div>
                <div class="inputbox">
                    <label>Sub Image 2: </label>
                    <input type="file" name="pthumb3" value="<?php echo $row['pthumb2'] ?>">
                </div>
                <div class="inputbox">
                    <label>Sub Image 3: </label>
                    <input type="file" name="pthumb4" value="<?php echo $row['pthumb4'] ?>">
                </div>
                <div class="inputbox">
                    <label>Product Description: </label>
                    <br>
                    <textarea name="pdesc">
                        <?php echo $row['pdesc'] ?>
                    </textarea>
                </div>
                <div class="inputbox">
                    <input type="submit" name="submiter">
                </div>
            </form>
        <?php
            }
        }
    }
    if(isset($_POST['submiter']))
    {
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pdesc = $_POST['pdesc'];
        $pcategory = $_POST['pcategory'];
        $pthumb1 = $_FILES['pthumb1']['name'];
        $tmp_name1 = $_FILES['pthumb1']['tmp_name'];
        $folder1 = '../product_image/'.$pthumb1;
        $pthumb2 = $_FILES['pthumb2']['name'];
        $tmp_name2 = $_FILES['pthumb2']['tmp_name'];
        $folder2 = '../product_image/'.$pthumb2;
        $pthumb3 = $_FILES['pthumb3']['name'];
        $tmp_name3 = $_FILES['pthumb3']['tmp_name'];
        $folder3 = '../product_image/'.$pthumb3;
        $pthumb4 = $_FILES['pthumb4']['name'];
        $tmp_name4 = $_FILES['pthumb4']['tmp_name'];
        $folder4 = '../product_image/'.$pthumb4;

        $uquery = mysqli_query($conn,"update `product_details` set pname='$pname'or pprice='$pprice' or pdesc='$pdesc',pcategory='$pcategory'or pthumb1='$pthumb1'or pthumb2='$pthumb2'or pthumb3='$pthumb3'or pthumb4='$pthumb4' where pid='$pid'");
        if(move_uploaded_file($tmp_name1,$folder1) && move_uploaded_file($tmp_name2,$folder2) && move_uploaded_file($tmp_name3,$folder3) && move_uploaded_file($tmp_name4,$folder4))
        {
        ?>
            <div id="mess"><span>New Record Added Sucessfully</span><i class="fa-solid fa-xmark" id="messi" style=" cursor:pointer;"></i></div>
            
        <?php
        }
        else 
        {
            echo "some error occurs in the data";
        }
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
    <link rel="stylesheet" href="../css/product_editor.css">
    <title>Product Editor</title>
</head>
<body>
    <div class="container">
        <a href="../dashboard/admin.php"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Product Editor</h1>
        <div class="products">
            <div class="prox_head">
                    <li>Product Id</li>
                    <li>Product Image</li>
                    <li>Product Name</li>
                    <li>Product Price</li>
                    <li>Product Modify</li>
            </div>
            <?php
                $pquery=mysqli_query($conn,"select * from `product_details`");
                if(mysqli_num_rows($pquery)>0)
                {
                    $i=1;
                    while($row=mysqli_fetch_assoc($pquery))
                    {
            ?>
                        <div class="prox">
                                <li><?php echo $i ?></li>
                                <li><img src="../product_image/<?php echo $row['pthumb1'] ?>" alt="" style="width: 85px; height: 75px;"></li>
                                <li><?php echo $row['pname'] ?></li>
                                <li><?php echo $row['pprice'] ?></li>
                                <li>
                                    <a href="../dashboard/product_editor.php?uid=<?php echo $row['pid'] ?>" onclick="confirm('Are you sure to update the product')">update</a>
                                    <a href="../dashboard/product_editor.php?did=<?php echo $row['pid'] ?>" onclick="confirm('Are you sure to delete the product ')">delete</a>
                                </li>
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