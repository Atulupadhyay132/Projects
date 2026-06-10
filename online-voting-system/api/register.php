<?php
include("connect.php");

$name       = $_POST['name'];
$mobile     = $_POST['mobile'];
$password   = $_POST['password'];
$cpassword  = $_POST['cpassword'];
$address    = $_POST['address'];
$role       = $_POST['role'];
$aadhaar    = $_POST['aadhaar'];

$secret = $_POST['secret'];

$image      = $_FILES['photo']['name'];
$tmp_name   = $_FILES['photo']['tmp_name'];

/* 1️⃣ Password match check */
if ($password != $cpassword) {
    echo "
    <script>
        alert('Password and Confirm Password do not match');
        window.location='../routes/register.html';
    </script>";
    exit;
}

/* 2️⃣ Aadhaar already exists check */
$check = mysqli_query($connect, "SELECT * FROM user WHERE aadhaar='$aadhaar'");

if (mysqli_num_rows($check) > 0) {
    echo "
    <script>
        alert('Invalid Credentials! Aadhaar number already registered');
        window.location='../routes/register.html';
    </script>";
    exit;
}

/* 3️⃣ Image upload */

move_uploaded_file($tmp_name, "../uploads/$image");

/* 4️⃣ Insert new user */
$insert = mysqli_query($connect,
    "INSERT INTO user 
    (name, mobile, aadhaar, address, password, photo, role, status, votes,secret_answer) 
    VALUES 
    ('$name', '$mobile', '$aadhaar', '$address', '$password', '$image', '$role', 0, 0, '$secret')"
);

/* 5️⃣ Success / Error */
if ($insert) {
    echo "
    <script>
        alert('Registration Successful');
        window.location='../';
    </script>";
} else {
    echo "
    <script>
        alert('Something went wrong');
        window.location='../routes/register.html';
    </script>";
}
?>


