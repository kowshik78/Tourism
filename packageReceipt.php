<?php session_start();
ob_start();
?>

<!DOCTYPE html>

<html lang="en">
	

	<head>
	
  		<meta charset="UTF-8">
  		<meta name="author" content="Joydeep Dev Nath">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" href="images/favicon.ico">
	
		<title>Receipt | Project Meteor</title>
    
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
								<a href="hotels.php"><li>Hotels</li></a>
								<a href="flights.php"><li>Flights</li></a>
								<a href="index.php"><li>Homepage</li></a>
								<a href="logout.php"><li>Logout</li></a>

							</ul>
							
						</div>
						
					</div>
		
		<div class="spacer">a</div>

		<?php 
		date_default_timezone_set("Asia/Dhaka");
		$date=date('l jS \of F Y \a\t h:i:s A');
		$packID=$_POST["packIDHidden"];
        $booking_id=$_POST["Id2"];
		?>
		
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
		
		<div class="col-sm-12 generateReceipt">
		
			<div class="commonHeader">
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-7 text-left">
					
					<div class="headingOne">
						
						Booking Receipt
						
					</div>
					
					<div class="dateTime">
						
						<span class="generated">Generated: </span><?php echo $date; ?>
						
					</div>
					
				</div>
				
				<div class="col-sm-3 text-right">
					
					<a href="./"><img src="images/logo.png" alt="Project Meteor Logo" /></a>
					
				</div>
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-12"></div>
				
				<div class="col-sm-1"></div>
				<div class="col-sm-10 bar"></div>
				<div class="col-sm-1"></div>
					
			</div> <!-- contains the header and logo -->
				
				<div class="col-sm-12"></div> <!-- empty class -->
				<div class="col-sm-1"></div>	
				<div class="col-sm-10">
			
					<div class="subHeading">
						
						Booking Information:
						
					</div>
				
				</div>
				
				<div class="col-sm-12"></div>
				<div class="col-sm-1"></div>
				<div class="col-sm-10 boxCenter">
				
					<?php
					
						$sql = "SELECT * FROM landmark WHERE destinationId='$booking_id'";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						$booking_id= $row["destinationId"];
					
					?>
					
					<div class="col-sm-1 borderRight text-center">
					
						<div class="flightOperatorHeading">
						
							Destination Name
							
						</div>
						
						<div class="flightOperator">
						
							<?php $packID=$row["title"];
							echo substr($packID,0,3) ?>
							
						</div>
						
						<div class="flightNo">
						
							<?php $packID=$row["title"];
							echo substr($packID,3) ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-3 borderRight text-center">
					
						<div class="flightOperatorHeading">
						
							Location
							
						</div>
						
						<div class="flightOperator">
						
							<?php echo $row["location"]; ?>
							
						</div>
						
						<div class="flightNo">
						
							<?php echo $row["zone"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 borderRight text-center">
					
						<div class="departsHeading">
						
							Duration
							
						</div>

						
						<div class="departsSubscript">
						
							<?php echo $row["duration"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 borderRight text-center">
					
						<div class="arrivesHeading">
						
							CheckIn_CheckOut
							
						</div>
						
						<div class="arrivesSubscript">
						
							<?php echo $row["departure_destination"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
				</div> <!-- outboundFlight Box -->
			
				<div class="col-sm-12 spacer">a</div>
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
			
					<div class="subHeading">
						
						Payment Information
						
					</div>
				
				</div>
							
				<div class="col-sm-12"></div> <!-- empty class --><div class="col-sm-1"></div>
				<div class="col-sm-12"></div> <!-- empty class --><div class="col-sm-1"></div>
					<div class="col-sm-10 boxCenter">
					
						<div class="columnHeaders">
							
							<div class="col-sm-4 borderBottom">
								
								<div class="serialNoHeader text-center">
									
									Price
									
								</div>
								
							</div>
							
							
						</div>
						
						<div class="col-sm-4">
								
							<div class="serialNo text-center">
								
								<span class="rupee">₹</span><?php echo $row["price"]; ?>
								
							</div>
								
						</div>

						
					</div> <!-- boxCenter -->
				<div class="col-sm-1"></div>
			
			<div class="importantInfo">
				<div class="col-sm-12"></div> 
				<div class="col-sm-12 spacer">a</div>
				<div class="col-sm-1"></div>
				<div class="col-sm-10 bar"></div>
				<div class="col-sm-1"></div>
				<div class="col-sm-12"></div>
				<div class="col-sm-1"></div>
				<div class="col-sm-1"></div>		
				<div class="col-sm-12 spacer">a</div>
				<div class="col-sm-12"></div>
			</div> 
		</div> <!-- generateTicket -->		
		<div class="spacer">a</div>		
	</body>
</html>

<?php

	$user = $_SESSION["username"];
	$packName = $row["title"];
	$location = $row ["location"];
	$price = $row["price"];
    $p = $row["duration"];
    $pr = $row["description"];
    $pri = $row["departure_destination"];
    $pric = $row["mainImage"];
	$InsertSQL = "INSERT INTO `packagebookings`
	              (booking_id,title,userid,location,price,duration,description,departure_description,main_Image) 
	              VALUES('$booking_id','$packName','$user','$location','$price','$p','$pr','$pri','$pric')";
	$bookingDataInsertQuery = $conn->query($InsertSQL);

    $bookingIDSQL = "SELECT * FROM `packagebookings` ORDER BY `booking_id` DESC LIMIT 1";
	$bookingIDQuery = $conn->query($bookingIDSQL);
	$bookingIDGet = $bookingIDQuery ->fetch_array(MYSQLI_NUM);
	$latestBookingID = $bookingIDGet[0];
	$currentBookingID = $latestBookingID;
	
?>
