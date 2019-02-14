<!DOCTYPE html>
<html>
<head>
	<title>GLI</title>
	<style  type="text/css">
		body{
			/*background-color: orange;*/
		}

		#title-h1{
 			position: absolute;
  			left: 32%;
			font-family: Garamond;
		}

		#title-h2{
			font-size: 25px;
			position: relative;
			margin-left: 5%;
  			top: 20px;
  			font-family: "Comic Sans MS", cursive, sans-serif;
		}

		#divChart{
			float:center; 
			background-color: transparent; 
		}
	</style>

	<script>
		
	</script>

	<script src="dist/Chart.bundle.min.js"></script>
    <!-- <script src="dist/utils.js"></script> -->
</head>
<body style="background-image: url('imagebck2.jpeg'); background-repeat: all;">

	<div>
	<?php

	include "dbconnect.php";

	$distance_left = 50;
	$garbage_location = "";
	$rc = $conn->lastRow();
	while ($fech = mysqli_fetch_array($rc)) {
		$sensorValue  = $fech['distance'];
		$garbage_location = $fech['location'];

	}

	$binMax = 100;
	$binHeight = 60.0; // Assuming the garbage bin is 50.0cm in height.
	
	$binLevel = abs($binHeight - $sensorValue);

	// echo $binLevel." ".$garbage_location;

	$percent = (double)$binLevel / $binHeight * 100;
	$percent = ceil($percent);

	// echo "<h1>$percent % | $binLevel</h1>";
  
  // if its above 70 percent empty
  	$alert ='';
      if ($percent >= 70.0){
        
         	$colour = "red";
         	$status_label = "Garbage-Level : CONTENT DUE FOR DISPOSAL";        
        }
        else if($percent >= 50.0)
        {
         	$colour = "yellow";
         	$status_label = "Garbage-Level :  HALF";
        }
        else
        {
        	$colour = "green";
        	$status_label = "Garbage-Level : EMPTY";
         	$alert=' GARBAGE CONSIDERED AS EMPTY ';
        }
?>	
	<h1 id='title-h1'>GARBAGE MONITORING SYSTEM</h1><br/>
	<h1 id='title-h2'>LOCATION : <?php echo $garbage_location; ?></h1><br/>
	</div>

	<div id="divChart">
		<canvas id="bar-chart" width="900" height="340"></canvas>
	</div>

	<script>
        
        window.onload = function() {
            // Bar chart
				new Chart(document.getElementById("bar-chart"), {
				    type: 'bar',
				    data: {
				      labels: ["Garbage Level Measured in (Cm)"],
				      datasets: [
				        {
				          label: "<?php echo $status_label; ?>",
				          backgroundColor: ["<?php echo $colour; ?>"],
				          data: [<?php echo $percent; ?>]
				        }
				      ]
				    },
				    options: {
				      legend: { display: false },
				      title: {
				        display: true,
				        text: 'Garbage Level Indicator :   <?php echo "$percent %  |  USED: $binLevel CM | $alert";?>'
				      },
				      scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Garbage Level Graphical Display | Garbage Location: <?php echo $garbage_location ?>'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 2,
                                stepValue: 2,
                                max: <?php echo $binMax; //$percent; ?>
                            }
                        }]
                },
				    }
				});
        };
    </script>
</body>
</html>
