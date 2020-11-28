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
$humidity_sensor_id = "SELECT ID FROM SensorTable WHERE Name = 'Humidity Sensor'";
$temperature_sensor_id = "SELECT ID FROM SensorTable WHERE Name = 'Temperature Sensor'";
$timestamp = date("d-m-Y H:i:s");
$humidity = $_POST["humidity"];
$temperature = $_POST["temperature"];

$result_humidity_id = $conn->query($humidity_sensor_id);
$result_temperature_id = $conn->query($temperature_sensor_id);


     $sql = "INSERT INTO DataTable (SensorID, Value, Timestamp)
     VALUES ($result_humidity_id , $humidity, $timestamp)";

     if ($conn->query($sql) === TRUE) {
       echo "New record created successfully";
     } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
     }

$conn->close();
?>
