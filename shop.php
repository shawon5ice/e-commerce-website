<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSquare | Shop Now</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <section id="header">
        <a href="#"><img src="./img/logo.png" class="logo" alt="" height="30px"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="./contact.php">ContactUs</a></li>
                <li><a href=""><i class="far fa-shopping-bag"></i></a></li>
            </ul>
        </div>
    </section>
    <section id="product1" class="section-p1">
        <h2>All Products</h2>
        <div class="pro-container">
        <?php
            include 'db/db_connection.php';
            // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                    $product_name = $row['name'];
                    $product_description = $row['description'];
                    $product_price = $row['price'];
                    $product_rating = $row['rating'];
                    $product_brand = $row['brand'];
                    $product_img = $row['image'];
                    ?>
                    <div class="pro">
                            <img src="img/uploads/products/<?php echo $product_img; ?>" alt="">
                            <div class="des">
                                <span><?php echo $product_brand; ?></span>
                                <h5><?php echo $product_name; ?></h5>
                                <div class="star">
                                <?php for($i = 0; $i < (int)$product_rating;$i++){?>
                                            <i class="fas fa-star"></i>
                                    <?php } ?>
                                </div>
                                <h4><?php echo $product_price,'Tk'; ?></h4>
                            </div>
                            <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                        </div>
                    <?php 
                    }
                    $conn->close();
                }
            ?>
        </div>
    </section>
    <?php include 'footer.php';?>
</body>
</html>