<?php
session_start();
include("../api/connect.php");

// Check login
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}
$userdata = $_SESSION['userdata'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Voting Receipt</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f4f4; padding: 50px; }
        .receipt-card {
            max-width: 450px;
            margin: auto;
            background: white;
            padding: 30px;
            border: 1px solid #2ecc71;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header { color: #27ae60; font-size: 24px; font-weight: bold; margin-bottom: 5px; }
        .details { text-align: left; margin: 20px 0; line-height: 1.8; border-top: 1px solid #eee; padding-top: 15px; }
        .qr-code { margin-top: 15px; padding: 10px; border: 1px dashed #ccc; display: inline-block; }
        .btn-section { margin-top: 25px; }
        .print-btn { background: #000; color: #fff; padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .back-btn { color: #555; text-decoration: none; font-size: 14px; margin-left: 10px; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

    <div class="receipt-card">
        <div class="header">VOTING RECEIPT</div>
        <p style="color: #888; font-size: 14px;">Online Voting System</p>
        
        <div class="details">
            <b>Name:</b> <?php echo $userdata['name']; ?><br>
            <b>Aadhar:</b> XXXX-XXXX-<?php echo substr($userdata['aadhaar'], -4); ?><br>
            <b>Status:</b> <span style="color: green;">Voted Successfully</span><br>
            <b>Date:</b> <?php echo date("d-M-Y"); ?><br>
            <b>Ref ID:</b> #VOTE<?php echo rand(10000, 99999); ?>
        </div>

        <div class="qr-code">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=VOTER%20DETAILS%0AName:%20<?php echo $userdata['name']; ?>%0AAadhar:%20<?php echo $userdata['aadhaar']; ?>%0AStatus:%20Voted%20Successfully" 
     alt="QR Code" 
     width="150">
     
            <p style="font-size: 10px; color: #999; margin: 5px 0 0 0;">Digital Verification QR</p>
        </div>

        <div class="btn-section no-print">
            <button onclick="window.print()" class="print-btn">Print PDF</button>
            <a href="dashboard.php" class="back-btn">Back</a>
        </div>
    </div>

</body>
</html>