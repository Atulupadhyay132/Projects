<?php
include("connect.php");

$mobile = $_POST['mobile'];
$secret = $_POST['secret'];
$newpass = $_POST['newpass'];

// Yahan $connect use karo aur values ko quotes (' ') mein dalo
$check = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile' AND secret_answer='$secret'");

if(mysqli_num_rows($check) > 0){
    // Naya password update karne ki query
    $update = mysqli_query($connect, "UPDATE user SET password='$newpass' WHERE mobile='$mobile'");
    
    if($update){
        echo '<script>
                alert("Password database mein change ho gaya! Ab naye password se login karo.");
                window.location = "../index.html";
              </script>';
    }
} else {
    echo '<script>
            alert("Details match nahi hui! Try again."); 
            window.location = "../routes/forgot-password.php";
          </script>';
}
?>