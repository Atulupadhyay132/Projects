<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body class="home-bg">
    <center>
    <div id="headerSection"><h1>ONLINE VOTING SYSTEM</h1></div>
    <hr>
    <div id="bodySection">
        <form action="../api/reset.php" method="POST">
            <h2>Reset Your Password</h2>
            <input type="number" name="mobile" placeholder="Enter Mobile number" required><br><br>
            <input type="text" name="secret" placeholder="Enter your Secret Answer" required><br><br>
            <input type="password" name="newpass" placeholder="Enter New Password" required><br><br>
            <button id="loginbtn" type="submit">Update Password</button><br><br>


<a href="../index.html" 
   style="color: white; 
          background-color: black; 
          padding: 8px 15px; 
          text-decoration: none; 
          border-radius: 5px; 
          display: inline-block; 
          font-family: sans-serif; 
          font-size: 14px;
          margin-top: 10px;">
   Back to Login
</a>




        </form>
    </div>
    </center>
</body>
</html>