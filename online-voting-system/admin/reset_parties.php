<?php
    session_start();
    include('../api/connect.php');

    // Query: Sabhi parties (role=2) ke votes ko zero (0) karne ke liye
    $query = "UPDATE user SET votes = 0 WHERE role = 2";
    $reset = mysqli_query($connect, $query);

    if($reset){
        echo '
            <script>
                alert("Parties votes reset successfully!");
                window.location = "admin_dashboard.php";
            </script>
        ';
    }
    else{
        echo '
            <script>
                alert("Error resetting parties!");
                window.location = "admin_dashboard.php";
            </script>
        ';
    }
?>