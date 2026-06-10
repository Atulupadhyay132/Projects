<?php
session_start();
include("../api/connect.php");

// 1. Search Logic
$search = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';

// 2. Query with Search Filter
if($search != ""){
    // Mobile, Aadhaar ya Name se search karne ke liye
    $query = "SELECT * FROM user WHERE role=1 AND (name LIKE '%$search%' OR mobile LIKE '%$search%' OR aadhaar LIKE '%$search%')";
} else {
    $query = "SELECT * FROM user WHERE role=1";
}

$res = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Voters</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="admin-bg">
    <div class="container mt-4 admin-card p-4 bg-light rounded shadow">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-success m-0">Voters List</h4>
            
            <form action="" method="GET" class="d-flex gap-2">
                <input type="text" name="search" value="<?php echo $search; ?>" class="form-control" placeholder="Search Mobile or Aadhaar..." style="width: 250px;">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                <?php if($search != ""): ?>
                    <a href="manage_users.php" class="btn btn-outline-danger btn-sm">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <table class="table table-bordered text-center align-middle">
            <thead class="table-success">
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Aadhaar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($res) > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        ?>
                        <tr>
                            <td>
                                <img src="../uploads/<?php echo $row['photo']; ?>" width="50" height="50" class="rounded-circle" style="object-fit: cover; border: 1px solid #ddd;">
                            </td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>XXXX-XXXX-<?php echo substr($row['aadhaar'], -4); ?></td>
                            <td>
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge bg-success">Voted</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Not Voted</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-muted p-4'>No voters found!</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="mt-3">
            <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">← Back to Dashboard</a>
        </div>
    </div>

    <style>
        .admin-bg {
            background: url('../css/bg2.png'); /* Apne background image ka path check kar lena */
            background-size: cover;
            min-height: 100vh;
            padding-top: 50px;
        }
        .admin-card {
            max-width: 1000px;
            margin: auto;
        }
    </style>
</body>
</html>