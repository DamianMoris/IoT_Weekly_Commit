<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Data Table</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">Filter Data from Database</h2><br />
   <div class="form-group">
	    <div class="input-group">
			<span class="input-group-addon">Sensor</span>
			<select name="sensor" id="sensor" class="form-control">
				<option value="0">Dont filter by sensor</option>
				<option value="28">Temperature Sensor</option>
				<option value="29">Pressure Sensor</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Value</span>
			<input type="text" name="value" id="value" class="form-control"/>
		</div>
		<div class="input-group">
			<label for="time1">Input two timestamp as search boundaries:</label><input type="date" name="time1" id="time1">
			<label for="time2"></label><input type="date" name="time2" id="time2">
		</div>
   </div>
   <br />
   <div id="result"></div>
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"sensor_data_table.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#value').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

<!--
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Test</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">Ajax Live Data Search</h2><br />
   <div class="form-group">
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Search by Value" class="form-control" />
    </div>
   </div>
   <br />
   <div id="result"></div>
  </div>
 </body>
</html>


<script>
$(document).ready(function(){
 $('#search_text').keyup(function(){
  var txt = $(this).val();
  if(txt != '')
  {
   $.ajax({
	   url:"sensor_data_table.php",
	   method:"POST",
	   data:{search:txt},
	   dataType:"text",
	   success:function(data)
	   {
		$('#result').html(data);
	   }
	});
  }
  else
  {
   $('#result').html('');
  }
 });
});
</script>-->