<link rel="stylesheet" type="text/css" href="index_style.css">
<?php 
// Database connection settings
$servername = "localhost";
$username = "student_11900357";
$password = "6RGlAFoUGUzQ";
$dbname = "student_11900357";

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connect->connect_error) {
	die("Connection failed: " . $connect->connect_error);
}
 
echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0'>
<channel>
<title>Rss</title>
<header><h1>Rss feed:</h1></header>
<description><p>Min/Max and Average values of sensors</description>
<link>(https://11900357.pxl-ea-ict.be)</p></link>";

$tempmax = '';
$tempmin = '';
$tempavg = '';

$presmax = '';
$presmin = '';
$presavg = '';

$tempquery = "SELECT MAX(Value) AS tempmax, MIN(Value) AS tempmin, AVG(Value) AS tempavg FROM DataTable WHERE SensorID = '28'";
$tempresult = mysqli_query($connect, $tempquery);
$presquery = "SELECT MAX(Value) AS presmax, MIN(Value) AS presmin, AVG(Value) AS presavg FROM DataTable WHERE SensorID = '29'";
$presresult = mysqli_query($connect, $presquery);

while(!$tempresult || $row = mysqli_fetch_assoc($tempresult))
{
	$tempmin = $row['tempmin'];
	$tempmax = $row['tempmax'];
	$tempavg = round($row['tempavg'], 2);
	
	echo "<h2>Temperature Data:</h2>";
	echo "<p>Max temperature: $tempmin °C</p>";
	echo "<p>Min temperature: $tempmax °C</p>";
	echo "<p>Average temperature: $tempavg °C</p>";
}

while(!$presresult || $row = mysqli_fetch_assoc($presresult))
{
	$presmin = $row['presmin'];
	$presmax = $row['presmax'];
	$presavg = round($row['presavg'], 2);
	
	echo "<h2>Pressure Data:</h2>";
	echo "<p>Max pressure: $presmin hPa</p>";
	echo "<p>Min pressure: $presmax hPa</p>";
	echo "<p>Average pressure: $presavg hPa</p>";
	echo "<br/>";
}

echo "</channel>";
echo "</rss>";
?>