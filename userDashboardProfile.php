<?php session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blocked.php");
   		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
}
?>

<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

	<head>
	
  		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" href="images/favicon.ico">
	
		<title>Dashboard | Project Meteor</title>
    
    	<link href="css/main.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/bootstrap-select.css" rel="stylesheet">
		<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    	<script src="js/jquery-3.2.1.min.js"></script>
    	<script src="js/userDashboard.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<script src="js/bootstrap-select.js"></script>
    	<script src="js/bootstrap-dropdown.js"></script>
    	<script src="js/jquery-2.1.1.min.js"></script>
    	<script src="js/moment-with-locales.js"></script>
    	<script src="js/bootstrap-datetimepicker.js"></script>
    		
	</head>
		<style>
div:hover {
  background-color: black;
}
a:hover {
  background-color: orange;
}
#r3 {
  border-radius: 70%;
  background: #3B3534;
  padding: 40px; 
  width: 300px;
  height: 150px;
} 
#r4 {
  border-radius: 70%;
  background: #3B3534;
  padding: 100px; 
  width: 700px;
  height: 600px;
} 
		</style>

	<?php
	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ghuraghuri";
		$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	?>
		
	<body>
	
		<div class="container-fluid">
		
			<div class="col-sm-12 userDashboard text-center">
			
			
			
			<div class="col-sm-12">
					
				<div class="heading text-center">
					
					<a href="index.php" src="images/logo.png"> Ghura Ghuri</a>
				</div>
						
			</div>
			
			<div class="col-sm-1"></div>
			
			
			
			<div class="col-sm-7 containerBoxRight text-left" id="r4">
				
				<?php
				
					$user = $_SESSION["username"];
					
					$profileSQL = "SELECT * FROM `users` WHERE Username='$user'";
					$profileQuery = $conn->query($profileSQL);
					$row = $profileQuery->fetch_assoc();

				?>
				
				<div class="col-sm-12 profile">
				
					<div class="col-sm-12 profileWrapper">
					<span class="tag">Username: </span><span class="content"><?php echo $row["Username"]; ?> </span>
					</div>					
					<div class="col-sm-12 profileWrapper">
					<span class="tag">Full Name: </span><span class="content"><?php echo $row["FullName"]; ?> </span>
					</div>
					<div class="col-sm-6 profileWrapper">
					<span class="tag">E-Mail: </span><span class="content"><?php echo $row["EMail"]; ?> </span>
					</div>
					<div class="col-sm-6 profileWrapper">
					<span class="tag">Phone: </span><span class="content"><?php echo $row["Phone"]; ?> </span>
					</div>
					<div class="col-sm-12 profileWrapper">
					<span class="tag">Address: </span><span class="content"><?php echo $row["AddressLine1"].", ".$row["AddressLine2"].", ".$row["City"].", ".$row["State"]; ?> </span>
					</div>
					<div class="col-sm-12 profileWrapper">
					<span class="tag">Account Created: </span><span class="content"><?php echo $row["Date"]; ?> </span>
					</div>	
					
				</div>
				
				
			</div>
			
			<div class="col-sm-1"></div>
			
			<div class="col-sm-12 spacer">a</div>
			<div class="col-sm-12 spacer">a</div>
			
			</div>
		
		</div> <!-- container-fluid -->
		
		
		
	</body>
	

	<!-- BODY TAG ENDS -->
	
</html>
	