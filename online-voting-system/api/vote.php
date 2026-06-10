<?php
session_start();
include("connect.php");

$gid = $_POST['gid'];                  
$uid = $_SESSION['userdata']['id'];    


$check = mysqli_query($connect, "SELECT status FROM user WHERE id='$uid'");
$row = mysqli_fetch_assoc($check);

if ($row['status'] == 1) {
    echo "
    <script>
        alert('You have already voted!');
        window.location='../routes/dashboard.php';
    </script>
    ";
    exit();
}


$update_votes = mysqli_query(
    $connect,
    "UPDATE user SET votes = votes + 1 WHERE id = '$gid'"
);


$update_user = mysqli_query(
    $connect,
    "UPDATE user SET status = 1 WHERE id = '$uid'"
);

if ($update_votes && $update_user) {

    
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;

    echo "
    <script>
        alert('Voting Successful!');
        window.location='../routes/dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Error while voting!');
        window.location='../routes/dashboard.php';
    </script>
    ";
}
?>