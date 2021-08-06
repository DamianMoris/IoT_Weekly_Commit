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

//error_reporting(0);
$output = '';
if(isset($_POST["query"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["query"]);
 $sensor = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM DataTable 
  WHERE Value LIKE '%".$value."%'
  OR SensorID LIKE '%".$sensor."%'
 ";
}
else
{
 $query = "
  SELECT * FROM DataTable ORDER BY Row DESC
 ";
}
$result = mysqli_query($connect, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($connect));
    exit();
}
echo $query;
if(!$result || mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Row</th>
     <th>Timestamp</th>
     <th>Value</th>
     <th>SensorID</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["Row"].'</td>
    <td>'.$row["Timestamp"].'</td>
    <td>'.$row["Value"].'</td>
    <td>'.$row["SensorID"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'No Data Found';
}

?>

<!--
//<?php
//$servername = "localhost";
//$username = "student_11900357";
//$password = "6RGlAFoUGUzQ";
//$dbname = "student_11900357";
//
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
////$query = "SELECT * FROM DataTable ORDER BY Row desc";
//	
//$output = '';
//$query = "
//  SELECT * FROM DataTable 
//  WHERE Rows LIKE '%".$_POST["search"]."%'
//  OR Timestamp LIKE '%".$_POST["search"]."%'
//  OR Value LIKE '%".$_POST["search"]."%'
//  OR SensorID LIKE '%".$_POST["search"]."%'
// ";
//
//$result = mysqli_query($conn, $query);
//if(mysqli_num_rows($result) > 0){
// $output .= '
//  <div class="table-responsive">
//   <table class="table table bordered">
//    <tr>
//     <th>Rows</th>
//     <th>Timestamp</th>
//     <th>Value</th>
//     <th>SensorID</th>
//    </tr>';
// while($row = mysqli_fetch_array($result)){
//  $output .= '
//   <tr>
//    <td>'.$row["Rows"].'</td>
//    <td>'.$row["Timestamp"].'</td>
//    <td>'.$row["Value"].'</td>
//    <td>'.$row["SensorID"].'</td>
//   </tr>';
// }
// echo $output;
//}
//else{
// echo 'Data Not Found';
//}

?>-->