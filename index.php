<?php
session_start();
if(isset($_SESSION['user']))
{
	$s = $_SESSION['user'];
	header('Location: '.$s.'.php');
}
?>
<html>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.10.0.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	
	<meta name="viewport" content="width=auto, initial-scale=1, maximum-scale=1, user-scalable=no">
	<head>
		<title>
				Shippable
		</title>
	</head>
	<body>
		<form action="backup.php" method="POST">
      	<div class="container">
      		<div class="row">
      			<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
		    	    <h2 class="form-signin-heading" style="margin:10px">Shippable Application</h2>
		        	<div class="input-group" style="margin:0px">
 						<span class="input-group-addon" id="basic-addon1">Url Link</span>
  						<input id="username" name="url" type="text" class="form-control" placeholder="https://www.github.com/{username}/{repo}" required="true" aria-describedby="basic-addon1">
					</div>
		        	<div class="col-md-6 col-md-offset-4 col-lg-6 col-lg-offset-4 col-sm-6 col-sm-offset-3">
		        			<button class="btn btn-primary " type="submit" style="margin:10px" id="registerButton">Submit</button>
	        		</div>
      			</div>
      		</div>
      	</div>
		</form>
		<div class="container">
      		<div class="row">
      			<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
					<h4 class="form-signin-heading" style="margin:10px">Sample Url</h4>
					<span class="input-group-addon" id="basic-addon1">https://www.github.com/{username}/{repo}</span>
				</div>
			</div>
		</div>		
	</body>
</html>
