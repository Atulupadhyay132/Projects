<?php
// Aapki connect.php file ka use karke database se judna
include("connect.php");

$name = mysqli_real_escape_string($connect, $_POST['name']);
$aadhar = mysqli_real_escape_string($connect, $_POST['aadhar']);
$mobile = mysqli_real_escape_string($connect, $_POST['mobile']);
$subject = mysqli_real_escape_string($connect, $_POST['subject']);
$complaint = mysqli_real_escape_string($connect, $_POST['complaint']);

// Nayi table 'contact_us' mein data insert karna
$insert_query = "INSERT INTO contact_us (name, aadhar_number, mobile_number, subject, complaint) 
                 VALUES ('$name', '$aadhar', '$mobile', '$subject', '$complaint')";

$result = mysqli_query($connect, $insert_query);

if($result){
    echo '
    <script>
        alert("Thank you! Your message has been sent successfully.");
        window.location = "../index.html";
    </script>
    ';
} else {
    echo '
    <script>
        alert("Error: Database connection failed.");
        window.location = "../contact.html";
    </script>
    ';
}
?>