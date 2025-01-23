<?php
    include '../config/connection.php';
    if(isset($_POST['submiter']))
    {
        $pname = htmlspecialchars($_POST['pname']);
        $pprice = intval($_POST['pprice']);
        $pdesc = htmlspecialchars($_POST['pdesc']);
        $pcategory = htmlspecialchars($_POST['pcategory']);
        
        $thumb1 = $_FILES['thumb1']['name'];
        $tmp_name1 = $_FILES['thumb1']['tmp_name'];
        $folder1 = '../product_image/'.$thumb1;

        $thumb2 = $_FILES['thumb2']['name'];
        $tmp_name2 = $_FILES['thumb2']['tmp_name'];
        $folder2 = '../product_image/'.$thumb2;
        $thumb3 = $_FILES['thumb3']['name'];
        $tmp_name3 = $_FILES['thumb3']['tmp_name'];
        $folder3 = '../product_image/'.$thumb3;
        $thumb4 = $_FILES['thumb4']['name'];
        $tmp_name4 = $_FILES['thumb4']['tmp_name'];
        $folder4 = '../product_image/'.$thumb4;

        $query = mysqli_query($conn,"insert into `Product_details` (pname,pprice,pthumb1,pthumb2,pthumb3,pthumb4,pdesc,pcategory) values ('$pname','$pprice','$thumb1','$thumb2','$thumb3','$thumb4','$pdesc','$pcategory')");
        if(move_uploaded_file($tmp_name1,$folder1) && move_uploaded_file($tmp_name2,$folder2) && move_uploaded_file($tmp_name3,$folder3) &&
        move_uploaded_file($tmp_name4,$folder4))
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
    <link rel="stylesheet" href="../css/product_upload.css">
    <link rel="icon" href="/img/icon.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Pacifico&family=Permanent+Marker&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Product_Upload</title>
</head>
<body>
    <div class="container">
        <a href="../dashboard/admin.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="box">
            <h1>Product Upload Form</h1>
            <div class="form">
            <form action="product_upload.php" method="post" enctype="multipart/form-data">
                <div class="pname">
                <label>Product Name:</label>
                <input type="text" name="pname" placeholder="Enter Product Name" required id="pnameinput">
                </div>
                <div class="pprice">
                <label>Product Price:</label>
                <input type="text" name="pprice" placeholder="Enter Price" required>
                </div>
                <div class="pcategory">
                    <label>Product Category:</label>
                    <select name="pcategory" id="" required>
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="DairyProducts">DairyProducts</option>
                    </select>
                </div>
                <div class="mimage">
                    <label>Product Main Image:</label>
                    <input type="file" name="thumb1" accept="image/*" required>
                </div>
                <div class="pimage1">
                    <label>Sub-Image 1:</label>
                    <input type="file" name="thumb2" accept="image/*">
                </div>
                <div class="pimage2">
                    <label>Sub-Image 2:</label>
                    <input type="file" name="thumb3" accept="image/*">
                </div>
                <div class="pimage3">
                <label>Sub-Image 3:</label>
                <input type="file" name="thumb4" accept="image/*">
                </div>
                <div class="pdesc">
                    <label>Description:</label>
                    <textarea name="pdesc" placeholder="Describe fetures and specification about the product" required></textarea>
                </div>
                <div class="submit">
                    <input type="submit" name="submiter">
                </div>
            
            </form>
            </div>
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