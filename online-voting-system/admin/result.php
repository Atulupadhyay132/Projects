<?php
session_start();
include("../api/connect.php");

// 1. Database se Groups aur Votes fetch karna Chart ke liye
$res = mysqli_query($connect, "SELECT name, votes FROM user WHERE role=2");
$chart_data = "";
while($row = mysqli_fetch_array($res)){
    // Format: ['BJP', 5],
    $chart_data .= "['".$row['name']."', ".$row['votes']."],";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Live Election Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Party Name', 'Votes'],
          <?php echo $chart_data; ?>
        ]);

        var options = {
          title: 'Live Voting Percentage',
          is3D: true,
          backgroundColor: 'transparent',
          titleTextStyle: { color: 'white', fontSize: 20 },
          legend: { textStyle: { color: 'white', fontSize: 14 } },
          chartArea: {width:'100%', height:'80%'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    
    <style>
        body {
            background: url('../css/bg2.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-box {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .table {
            background-color: rgba(255, 255, 255, 0.9) !important;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center main-box text-white shadow-lg">
            
            <h2 class="mb-4">🗳️ LIVE ELECTION RESULTS</h2>
            <hr style="border-top: 2px solid white;">

            <div id="piechart_3d" style="width: 100%; height: 400px;"></div>

            <div class="mt-5">
                <table class="table table-striped table-bordered text-center shadow">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr No</th>
                            <th>Party Name</th>
                            <th>Current Votes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $res_table = mysqli_query($connect, "SELECT name, votes FROM user WHERE role=2");
                        while($row = mysqli_fetch_array($res_table)){
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td class="text-start ps-5"><b><?php echo $row['name']; ?></b></td>
                                <td>
                                    <span class="badge bg-success fs-6 px-3">
                                        <?php echo $row['votes']; ?> Votes
                                    </span>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="admin_dashboard.php" class="btn btn-outline-light px-5">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>