<?php
    $server = "localhost" ;
    $username = "root" ;
    $password = "";
    $dbname = "ssquare" ;
              
    $conn = mysqli_connect($server ,$username ,$password , $dbname) ;
     if(isset($_POST['submit'])){
        if(!empty($_POST[ 'name']) && !empty($_POST['email']) && !empty($_POST["phone"]) && !empty($_POST["message"])){
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $message = $_POST["message"];
           $query = "insert into contact_us(name, email, phone, message) values('$name','$email', '$phone' , '$message')" ;
           $run = mysqli_query($conn,$query) or die(mysqli_error($conn));
           
           if($run){
             header('Location: ../contact.php');
           }
           else {
            echo "Form not submitted" ;
           }
        }
       else{
            echo " all fields required" ;
        }
     }

?>