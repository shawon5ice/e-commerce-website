<?php

    $server = "localhost" ;
    $username = "root" ;
    $password = "";
    $dbname = "ssquare" ;
            
    $conn = mysqli_connect($server ,$username ,$password , $dbname) ;

    if (isset($_POST['submit'])) {
        if(!empty($_POST[ 'name']) && !empty($_POST['price']) && !empty($_POST["description"]) && !empty($_POST["rating"]) && !empty($_POST["category"]) && !empty($_POST["brand_name"])
        && !empty($_FILES["product_img"])){
            $name = $_POST["name"];
            $price = $_POST["price"];
            $description = $_POST["description"];
            $rating = $_POST["rating"];
            $category = $_POST["category"];
            $brand_name = $_POST["brand_name"];
           
           
            $img_name = $_FILES['product_img']['name'];
	        $img_size = $_FILES['product_img']['size'];
	        $tmp_name = $_FILES['product_img']['tmp_name'];
	        $error = $_FILES['product_img']['error'];

            if ($error === 0) {
                if ($img_size > 12500000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: index.php?error=$em");
                }else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png"); 

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = '../img/uploads/products/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
                        

                        // Insert into Database
                        $query = "INSERT INTO products(name, image, description, category, price, rating, brand) VALUES ('$name','$new_img_name','$description','$category','$price','$rating','$brand_name')";
                        
                        $run = mysqli_query($conn,$query) or die(mysqli_error($conn));
                        if($run){
                            header("Location: product.html");
                        }else{
                            $em = "Failed to insert into database";
                            header("Location: product.html=$em");
                        }
                    }else {
                        $em = "You can't upload files of this type";
                        header("Location: product.html?error=$em");
                    }
                }
            }else {
                $em = "unknown error occurred!";
                header("Location: product.html?error=$em");
            }

        }else {
            header("Location: product.html");
        }
    }
?>