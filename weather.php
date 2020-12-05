<?php
	error_reporting(0);
	$weather="";
	$error="";
	if(isset($_GET['city'])){
		
		$urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=3a631c7c9c04903a3c1223444571335a");
		
		$weatherArray = json_decode($urlContents,true);
		
		if($weatherArray['cod'] == 200){
		
			$weather = "The Weather in ".$_GET['city']." is currently ".$weatherArray['weather'][0]['description'].".";
			
			$temp = intval($weatherArray['main']['temp'] - 273);
			
			$weather .= " The temperature is ".$temp."&deg;C.";
		}
		else{
			$error = "could not found the city - Please try again later";
		}
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Weather Scraper</title>
	<style type="text/css">
		html { 
		  background: url(weather.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		body{
			background:none;
		}
		.container{
			text-align:center;
			width:450px;
			margin-top:200px;
		}
		input{
			
			margin:20px 0;
		}
		#weathers{
			margin-top:15px;
		}
	</style>
  </head>
  <body>
	<div class="container">
		<h1>What's The Weather?</h1>
		<form>
		  <div class="form-group">
			<label for="weathering">Enter the name of a city</label>
			<input type="text" class="form-control" name="city" id="weathering" placeholder="Eg. Mumbai,Delhi">
		  </div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<div id="weathers">
			<?php
				if($weather){
					echo'<div class="alert alert-success" role="alert">'.$weather.'</div>';
				}else if($error){
					echo'<div class="alert alert-danger" role="alert">'.$error.'</div>';
				}
			?>
		
		</div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>