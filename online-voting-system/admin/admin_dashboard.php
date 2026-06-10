<?php
include "auth.php";

$total_voters = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM user WHERE role=1"));
$total_parties = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM user WHERE role=2"));
$total_votes = mysqli_fetch_assoc(
    mysqli_query($connect,"SELECT SUM(votes) AS total FROM user WHERE role=2")
)['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body class="admin-bg">

<div class="container mt-3">

<div class="d-flex justify-content-between align-items-center bg-success text-white p-3 rounded">
    <h4 class="m-0">Online Voting – Admin Panel</h4>
    <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
</div>

<div class="row mt-4 g-4">

<div class="col-md-4">
    <div class="card card-box text-center p-3">
        <h5>Total Voters</h5>
        <h1 class="text-success"><?= $total_voters ?></h1>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-box text-center p-3">
        <h5>Total Parties</h5>
        <h1 class="text-primary"><?= $total_parties ?></h1>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-box text-center p-3">
        <h5>Total Votes</h5>
        <h1 class="text-danger"><?= $total_votes ?></h1>
    </div>
</div>

</div>

<div class="text-center mt-4">
    <a href="manage_users.php" class="btn btn-success me-2">Manage Voters</a>
    <a href="result.php" class="btn btn-primary me-2">View Result</a>

    
    <a href="reset_vote.php"
       class="btn btn-danger"
       onclick="return confirm('Are you sure you want to reset all votes?');">
       Reset Votes
    </a>


<a href="reset_parties.php">
    <button style="padding: 10px; background-color: #e67e22; color: white; border-radius: 5px; border: none; cursor: pointer; font-weight: bold; margin-top: 10px;">
        Reset Party Values
    </button>
</a>








</div>

</div>
</body>
</html>
