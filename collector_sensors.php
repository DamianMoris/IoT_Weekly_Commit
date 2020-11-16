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
$id = $conn->insert_id;
$name = $_POST["name"];
$lasttimestamp = date("H:i:s");
$ip = $_POST["ip"];

$sql = "INSERT INTO SensorTable (ID, Name, LastTimestamp, IP)
VALUES ($id , '$name', '$lasttimestamp', '$ip')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
