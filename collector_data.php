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
echo "Connected successfully";
?>



<?php
$humidity_sensor_id = SELECT SensorID FROM DataTable;
$temperature_sensor_id = SELECT SensorID FROM DataTable;
$lasttimestamp = date("H:i:s");
$humidity = $_POST["humdity"];
$temperature = $_POST["humdity"];

$sql = "INSERT INTO SensorTable (ID, Name, LastTimestamp, IP)
VALUES ($id , '$name', '$lasttimestamp', '$ip')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
