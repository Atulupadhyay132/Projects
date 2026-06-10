<?php
include("auth.php");
include("connect.php");

/* sab voters ka vote status reset */
$reset = mysqli_query($connect, "UPDATE user SET status = 0, votes = 0 WHERE role = 1");

if($reset){
    echo "
    <script>
        alert('All votes reset successfully');
        window.location = 'admin_dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Error while resetting votes');
        window.location = 'admin_dashboard.php';
    </script>
    ";
}
?>