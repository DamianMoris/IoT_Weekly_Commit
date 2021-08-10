<?php
	// Database connection settings
	$servername = "localhost";
	$username = "student_11900357";
	$password = "6RGlAFoUGUzQ";
	$dbname = "student_11900357";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$temp = '';
	$pres = '';
	$time = '';

	//query to get data from the table
	$sql_temp = "SELECT * FROM DataTable WHERE SensorID = 28";
    $result_temp = mysqli_query($conn, $sql_temp);
	
	$sql_pres = "SELECT * FROM DataTable WHERE SensorID = 29";
    $result_pres = mysqli_query($conn, $sql_pres);
	
	$sql_time = "SELECT * FROM DataTable WHERE SensorID = 29";
    $result_time = mysqli_query($conn, $sql_time);
	
	//loop through the returned temperature data
	while ($row = mysqli_fetch_array($result_temp)) {
			$temp = $temp . '"'. $row['Value'].'",';
	}
	
	//loop through the returned pressure data
	while ($row = mysqli_fetch_array($result_pres)) {
			$pres = $pres . '"'. $row['Value'] .'",';
	}

	//loop through the returned timestamps
	while ($row = mysqli_fetch_array($result_time)) {
		$time = $time . '"'. $row['Timestamp'].'",';
	}
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>-->
		<title>BMP180 data</title>

		<style type="text/css">			
			body{
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #1e1e1e;
			}

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>

	</head>

	<body>	   
	    <div class="container">	
	    <h1>Temperature and Pressure Graph</h1>       
			<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
			<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
			<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>-->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js" integrity="sha512-UXumZrZNiOwnTcZSHLOfcTs0aos2MzBWHXOHOuB0J/R44QB0dwY5JgfbvljXcklVf65Gc4El6RjZ+lnwd2az2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/1.1.1/chartjs-plugin-zoom.min.js" integrity="sha512-NxlWEbNbTV6acWnTsWRLIiwzOw0IwHQOYUCKBiu/NqZ+5jSy7gjMbpYI+/4KvaNuZ1qolbw+Vnd76pbIUYEG8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var temperatureChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: [<?php echo $time; ?>],
						datasets: 
						[{
							label: 'Temperature (°C)',
							yAxisID: 'TEMPERATUREY',
							data: [<?php echo $temp; ?>],
							backgroundColor: 'transparent',
							borderColor: 'rgba(255,99,132)',
							borderWidth: 1,
							pointRadius: 0
						},
						
						{
							label: 'Pressure (hPa)',
							yAxisID: 'PRESSUREY',
							data: [<?php echo $pres; ?>],
							backgroundColor: 'transparent',
							borderColor: 'rgba(0,255,255)',
							borderWidth: 1,
							pointRadius: 0
						}],
					},
				 
					options: {
						scales: {
							yAxes: [{
								id: 'TEMPERATUREY',
								type: 'linear',
								position: 'left',
								beginAtZero: false,
								ticks: {
									fontColor: 'rgba(255,99,132)'
								}
							},
							
							{
								id: 'PRESSUREY',
								type: 'linear',
								position: 'left',
								beginAtZero: false,
								ticks: {
									fontColor: 'rgba(0,255,255)'
								}
							}],
							
							xAxes: [{
								position: 'left',
								beginAtZero: false,
								ticks:{
									callback:function(label){
										var month = label.split(";")[0];
										var year = label.split(";")[1];
										return month;
									}
								}
							}],
						},
						
						plugins: {
							zoom: {
								zoom: {
									wheel: {
										enabled: true
									},
									
									mode: 'x'
								}
							}
						}
					},

						
					tooltips: {
						mode: 'index'
					},
					
					legend: {
						display: true,
						position: 'top',
						labels: {
							fontColor: 'rgb(255,0,0)',
							fontSize: 20
						},
						onClick: null
					}
				});
			</script>
	    </div>    
	</body>
</html>