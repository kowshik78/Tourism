<?php session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blocked.php");
   		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
}
?>

<!DOCTYPE html>

<html lang="en">


	<head>
	
  		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" href="images/favicon.ico">
	
    	<link href="css/main.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    	<script src="js/jquery-3.2.1.min.js"></script>
    	<script src="js/main.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	
	</head>
	
	<body>
          <div class="">
						
						<div class="menu text-center">
							
							<ul>
								<li href="hotels.php">Hotels</li>
								<a href="flights.php"><li>Flights</li></a>
								<a href="index.php"><li>Homepage</li></a>
								<a href="logout.php"><li>Logout</li></a>

							</ul>
							
						</div>
						
					</div>
		
		
		
		<?php
		
			$city=$_GET["city"];
			$checkIn=$_GET["checkIn"];
			$checkOut=$_GET["checkOut"];
			$noOfRooms=$_GET["rooms"];
		
			$_SESSION["city"]=$city;
			$_SESSION["checkIn"]=$checkIn;
			$_SESSION["checkOut"]=$checkOut;
			$_SESSION["noOfRooms"]=$noOfRooms;		
		?>
		
		<div class="spacer">a</div>
		
		<div class="searchHotels">
					
			<div class="query">
						
				Hotels in <?php echo $city; ?>	
						
			</div>
			

		<?php
		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "ghuraghuri";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		
			$sql = "SELECT * FROM hotels WHERE city='$city'";
			$rowcount = mysqli_num_rows(mysqli_query($conn,$sql));
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
		?>
		
			<div class="col-sm-12 noOfHotels">
				<?php echo $rowcount ." hotels found.";?>
			
		    </div> <!-- searchFlights -->
		
		<div class="col-sm-12 searchHotels">
		
		<?php
				while($row = $result->fetch_assoc()) {
        			
		?>
					
			<div class="col-sm-4 text-center">
												
				<div class="col-sm-12 listItem">
													
				<!-- FLIGHT INFO STARTS -->

				<div class="col-sm-12 imageContainer text-center">
										
					<img src="<?php echo $row["mainImage"]; ?>" alt="<?php echo $row["hotelName"] ?>">
										
				</div>
				
				
				<div class="col-sm-12 hotelName"><?php echo $row["hotelName"]; ?></div>
				
				<div class="col-sm-12 starContainer">
					
					<?php
					
						$noOfStars=$row["stars"];
					
						for($i=0; $i<$noOfStars; $i++) {?>
						
						<i class="fa fa-star"></i>
						
						<?php } ?>
					
				</div>
				
				<div class="col-sm-12 priceContainer">
					
					<?php echo $row["price"] ?>
					
				</div>
				
				<div class="col-sm-12 priceNote">
					
					per room per night
					
				</div>
				
				<div class="col-sm-12 view">
					
					<a href="hotelDetails.php?hotelId=<?php echo $row["hotelID"]; ?>"><input type="button" class="viewDetails" name="viewDetails" value="View Hotel Details"/></a>
					
				</div>
	
				
			</div> <!-- listItem 1 -->
  		
  		</div>
   		

   		<?php	} 	}   ?>
		
		<?php $conn->close(); ?>
		
		  
       
			
		<div class="spacerLarge">.</div>
		
				
	</body>
	
</html>