<?php
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
echo "Connected successfully\n";


$last = mysqli_query($conn,"SELECT SensorID FROM DataTable ORDER BY Row DESC LIMIT 2");
$last_arr = mysqli_fetch_assoc($last);
$last_sensorID = $last_arr['SensorID'];
//echo $last_sensorID;

$temperature_sensor_id = mysqli_query($conn,"SELECT ID FROM SensorTable WHERE (Name = 'Temperature Sensor')");
$pressure_sensor_id = mysqli_query($conn,"SELECT ID FROM SensorTable WHERE (Name = 'Pressure Sensor')");
$timestamp = date("d-m-Y H:i:s");
$pressure = $_GET["pressure"];
$temperature = $_GET["temperature"];

$result_temperature_id_array = mysqli_fetch_assoc($temperature_sensor_id);
$result_temperature_id = $result_temperature_id_array['ID'];
$result_pressure_id_array = mysqli_fetch_assoc($pressure_sensor_id);
$result_pressure_id = $result_pressure_id_array['ID'];


	$sql = "INSERT INTO DataTable set SensorID = '".$result_temperature_id."', Value = '".$temperature."', Timestamp = '".$timestamp."'";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully\n";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "UPDATE SensorTable SET LastTimestamp = '".$timestamp."' WHERE ID = '".$result_temperature_id."'";
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully\n";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	if($last_sensorID != $result_pressure_id)
	{
		$sql = "INSERT INTO DataTable set SensorID = '".$result_pressure_id."', Value = '".$pressure."', Timestamp = '".$timestamp."'";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully\n";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		$sql = "UPDATE SensorTable SET LastTimestamp = '".$timestamp."' WHERE ID = '".$result_pressure_id."'";
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully\n";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

$conn->close();
?>