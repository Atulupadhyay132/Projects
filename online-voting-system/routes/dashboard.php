<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../index.html");
    exit;
}
  $userdata = $_SESSION['userdata'];
  $groupsdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
  $status = '<b style="color:red">Not voted</b>';
}
else{
   $status = '<b style="color:green">voted</b>';                                                                                                                                                                                                                                    
}
?>

<html>
<head>
    <title>Online Voting System</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body class="home-bg">
    <style>
          #backbtn{
            padding: 5px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #48dbfb; 
            color: white;
            float: left;
            margin: 10px;
          }

          #logoutbtn{
            padding: 5px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #48dbfb;
            color: white;
             float: right;
               margin: 10px;
          }

          #Profil{
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
          }

          #Group{
             background-color: white;
            width: 60%;
            padding: 20px;
             float: right;
          }

          #votebtn{
             padding: 5px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #48dbfb;
            color: white;
            float: left;
          }

         #mainpanel{
          padding: 10px;
         } 

        #voted{
         padding: 5px;
            font-size: 15px;
            border-radius: 5px;
            background-color: green;
            color: white;
            float: left;
        }

    </style>
    <div id="mainsection">
        <center>
            <div id="headersection">
                <a href="../"><button id="backbtn">Back</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>    
        </center>
        <hr>

        <div id="mainpanel">
            <div id="Profil">
                <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
                <b>Name:</b> <?php echo $userdata['name'] ?><br><br>
                <b>Mobile:</b> <?php echo $userdata['mobile'] ?><br><br>
                <b>Address:</b><?php echo $userdata['address'] ?><br><br>
                <b>Status:</b><?php echo $status ?><br><br>
                
                <?php
                // Receipt button logic
                if($_SESSION['userdata']['status'] == 1){
                    ?>
                    <a href="voter_receipt.php" style="text-decoration: none;">
                        <button type="button" style="background-color: black; color: white; padding: 5px 15px; border: none; border-radius: 4px; font-size: 13px; cursor: pointer; margin-top: 5px;">
                            Get Receipt
                        </button>
                    </a>
                    <?php
                }
                ?>
            </div>
             
            <div id="Group">
                <?php 
                if($_SESSION['groupsdata']){
                    for($i=0; $i<count($groupsdata); $i++){
                        ?>
                        <div style="margin-bottom: 20px; overflow: auto;">
                            <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                            <b>Group Name:</b> <?php echo $groupsdata[$i]['name']?><br><br>
                            
                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>">
                                <?php
                                if($_SESSION['userdata']['status'] == 0){
                                    ?>
                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                    <?php
                                } else {
                                    ?>
                                    <button type="button" disabled id="voted">Voted</button>
                                    <?php
                                }
                                ?>
                            </form>
                        </div>
                        <hr>
                        <?php 
                    }
                }
                else{
                    echo "No groups available.";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>