<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            height:100vh;
            background-image: url("../css/bg1.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            width:380px;
            background: rgba(255,255,255,0.95);
            padding:30px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
            text-align:center;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h3 class="text-success mb-4">Admin Panel Login</h3>

    <form method="POST">
        <input type="text" name="username" class="form-control mb-3" placeholder="Admin Username" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button class="btn btn-success w-100" name="login">Login</button>
    </form>

    <div class="mt-3">
        <a href="../index.html" class="btn btn-secondary w-100">Back to Home</a>
    </div>
</div>

<?php
if(isset($_POST['login'])){
    if($_POST['username']=="admin" && $_POST['password']=="admin123"){
        $_SESSION['admin']=true;
        header("Location: admin_dashboard.php");
        exit();
    }else{
        echo "<script>alert('Invalid Admin Login')</script>";
    }
}
?>

</body>
</html>