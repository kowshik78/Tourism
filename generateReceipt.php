<?php session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blocked.php");
   		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
}
?>

<!-- dumping the current page to buffer -->
<?php
ob_start();
?>

<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

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
		   $mode=$_POST["modeIDHidden"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "ghuraghuri";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		?>
        <?php if($mode=="hotel"): 
		
        $mode=$_POST["modeIDHidden"];		
		date_default_timezone_set("Asia/Dhaka");
		$date=date('l jS \of F Y \a\t h:i:s A');
		$hotelID=$_POST["hotelIDHidden"];
		$fare=$_POST["fareHidden"];
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
					
					<a href="./"><img src="images/logo.png" alt="" /></a>
					
				</div>
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-12"></div>
				
				<div class="col-sm-1"></div>
				<div class="col-sm-10 bar"></div>
				<div class="col-sm-1"></div>
				<div class="col-sm-12"></div> <!-- empty class -->
			
				<div class="col-sm-1"></div>
				
				<div class="col-sm-10">
			
					<div class="subHeading">
						
						Booking Information:
						
					</div>
				
				</div>
							
				<div class="col-sm-12"></div> <!-- empty class -->
			
				<div class="col-sm-1"></div>
					
			</div> <!-- contains the header and logo -->
		
		
		
		
				<div class="col-sm-10 boxCenter"> <!-- outboundFlight Box -->
				
					<?php
					
						$sql = "SELECT * FROM hotels WHERE hotelID='$hotelID'";
						$result = $conn->query($sql);
						$row = $result->fetch_assoc()
					
					?>
					
					<div class="col-sm-1 borderRight text-center">
					
						<div class="flightOperatorHeading">
						
							Hotel ID
							
						</div>
						
						<div class="flightOperator">
						
							<?php $hotelID=$row["hotelID"];
							echo substr($hotelID,0,3) ?>
							
						</div>
						
						<div class="flightNo">
						
							<?php $hotelID=$row["hotelID"];
							echo substr($hotelID,3) ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-3 borderRight text-center">
					
						<div class="flightOperatorHeading">
						
							Hotel Name
							
						</div>
						
						<div class="flightOperator">
						
							<?php echo $row["hotelName"]; ?>
							
						</div>
						
						<div class="flightNo">
						
							<?php echo $row["locality"].', '.$row["city"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 borderRight text-center">
					
						<div class="departsHeading">
						
							Check In
							
						</div>
						
						<div class="departs">
						
							<?php echo $_SESSION["checkIn"]; ?>
							
						</div>
						
						<div class="departsSubscript">
						
							<?php echo $row["checkIn"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 borderRight text-center">
					
						<div class="arrivesHeading">
						
							Check Out
							
						</div>
						
						<div class="arrives">
						
							<?php echo $_SESSION["checkOut"]; ?>
							
						</div>
						
						<div class="arrivesSubscript">
						
							<?php echo $row["checkOut"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 borderRight text-center">
					
						<div class="originHeading">
						
							No. of rooms
							
						</div>
						
						<div class="origin">
						
							<?php echo $_SESSION["noOfRooms"]; ?>
							
						</div>
						
						<div class="originSubscript">
						
							rooms
							
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
							
				<div class="col-sm-12"></div> <!-- empty class -->
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-12"></div> <!-- empty class -->
				
				<div class="col-sm-1"></div>
			
					<div class="col-sm-10 boxCenter">
					
						<div class="columnHeaders">
							
							<div class="col-sm-4 borderBottom">
								
								<div class="serialNoHeader text-center">
									
									Charge per room
									
								</div>
								
							</div>
							
							<div class="col-sm-4 borderBottom">
								
								<div class="passengerNameHeader text-center">
									
									Amount paid
									
								</div>
								
							</div>
							
							<div class="col-sm-4 borderBottom">
								
								<div class="genderHeader text-center">
									
									Payment Mode
									
								</div>
								
							</div>
							
						</div> <!-- columnHeaders -->
						
						<div class="col-sm-4">
								
							<div class="serialNo text-center">
								
								<span class="rupee">₹</span><?php echo $row["price"]; ?>
								
							</div>
								
						</div>
						
						<div class="col-sm-4">
								
							<div class="serialNo text-center">
								
								<span class="rupee">₹</span><?php echo $fare ?>
								
							</div>
								
						</div>
						
						<div class="col-sm-4">
								
							<div class="serialNo text-center">
								
								Card Payment
								
							</div>
								
						</div>	
						
					</div> <!-- boxCenter -->
				
				<div class="col-sm-1"></div>
		</div> <!-- generateTicket -->
		
<?php
	
	$user = $_SESSION["username"];
	$dateFormatteddateFormatted = date("d-m-Y"); //formatting the date as DD-MM-YY
	$hotelName = $row["hotelName"].', '.$row["locality"].', '.$row["city"];
	$location = $row ["city"];
	$bookingDataInsertSQL = "INSERT INTO `hotelbookings`(hotelName,date,username,cancelled,location) VALUES('$hotelName','$date','$user','no','$location')";
	$bookingDataInsertQuery = $conn->query($bookingDataInsertSQL);
				
	$bookingIDSQL = "SELECT * FROM `hotelbookings` ORDER BY `bookingID` DESC LIMIT 1";
	$bookingIDQuery = $conn->query($bookingIDSQL);
	$bookingIDGet = $bookingIDQuery ->fetch_array(MYSQLI_NUM);
	$latestBookingID = $bookingIDGet[0];
	$currentBookingID = $latestBookingID;
								
?>	
		<div class="spacer">a</div>
	    ---------------------------------------------------------------
        <?php elseif($mode=="OneWayFlight"): 
	
		date_default_timezone_set("Asia/Dhaka");
		$date2=date('l jS \of F Y \a\t h:i:s A');
		$user2=$_SESSION["username"];
		$mode=$_POST["modeIDHidden"];
		$fare2=$_POST["fareHidden"];
		$type=$_POST["typeHidden"];
		$class=$_POST["classHidden"];
		$origin=$_POST["originHidden"];
		$destination=$_POST["destinationHidden"];
		$depart=$_POST["departHidden"];
		$flightNoOutbound=$_POST["flightNoOutboundHidden"];
		
		if($class=="Economy Class")
			$className="Economy";
		else
				$className="Business"; 
		?>
		
		 <div class="col-sm-12 generateReceipt">
		 <div class="commonHeader">
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-7 text-left">
					
					<div class="headingOne">
						
						E Ticket
						
					</div>
					
					<div class="dateTime">
						
						<span class="generated">Generated: </span><?php echo $date2; ?>
						
					</div>
					
				</div>
				
				<div class="col-sm-3 text-right">
					
					<a href="./"><img src="images/logo.png" alt="" /></a>
					
				</div>
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-12"></div>
				
				<div class="col-sm-1"></div>
				<div class="col-sm-10 bar"></div>
				<div class="col-sm-1"></div>
				<div class="col-sm-12"></div> <!-- empty class -->
			
				<div class="col-sm-1"></div>
				
				<div class="col-sm-10">
			
					<div class="subHeading">
						
						FLIGHT Booking Information:
						
					</div>
					<div class="subHeading">
						
						<div class="subHeading">
						
						<?php echo $user2; ?>
						
				     	</div>
				
						
					</div>
				
				
				</div>
							
				<div class="col-sm-12"></div> <!-- empty class -->
			
				<div class="col-sm-1"></div>
					
			    </div> <!-- contains the header and logo -->
		 		<div class="col-sm-10 boxCenter"> <!-- outboundFlight Box -->
				
					<?php
					
						$sql2 = "SELECT * FROM flights WHERE flight_no='$flightNoOutbound'";
						$result2 = $conn->query($sql2);
						$row2 = $result2->fetch_assoc()
					
					?>
					
					<div class="col-sm-1 borderRight text-center">
					
						<div class="flightOperatorHeading">
						
							FLIGHT ID
							
						</div>
						
						<div class="flightOperator">
						
							<?php echo $row2["flight_no"]; ?>
							
						</div>
						
						
					</div> <!-- col-sm-4 -->
						
					<div class="col-sm-2 borderRight text-center">
					
						<div class="departsHeading">
						
							ARRIVAL
							
						</div>
						
						<div class="departs">
						
							<?php echo $row2["arrives"]; ?>
							
						</div>
						
						<div class="departsSubscript">
						
							<?php echo $row2["arrives"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 borderRight text-center">
					
						<div class="arrivesHeading">
						
							DEPARTURE
							
						</div>
						
						<div class="arrives">
						
							<?php echo $row2["departs"]; ?>
							
						</div>
						
						<div class="arrivesSubscript">
						
							<?php echo $row2["departs"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 borderRight text-center">
					
						<div class="originHeading">
						
							Origin
							
						</div>
						
						<div class="origin">
						
							<?php echo $row2["origin"]; ?>
							
						</div>
						
						<div class="originSubscript">
						
							Destination
							
						</div>
						<div class="origin">
						
							<?php echo $row2["destination"]; ?>
							
						</div>
						
					</div> <!-- col-sm-4 -->
					
					<div class="col-sm-2 text-center">
					
						<div class="destinationHeading">
						
							Operator
							
						</div>
						
						<div class="origin">
						
							<?php echo $row2["operator"]; ?>
							
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
							
				<div class="col-sm-12"></div> <!-- empty class -->
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-12"></div> <!-- empty class -->
				
				<div class="col-sm-1"></div>
			
					<div class="col-sm-10 boxCenter">
					
						<div class="columnHeaders">
							
							<div class="col-sm-4 borderBottom">
								
								<div class="passengerNameHeader text-center">
									
									Amount
									
								</div>
								
							</div>
							
							
						</div> <!-- columnHeaders -->
						
						<div class="col-sm-4">
								
							<div class="serialNo text-center">
								
								<span class="rupee">₹</span><?php echo $row2["fare"]; ?>
								
							</div>
								
						</div>
					
					</div> <!-- boxCenter -->
				
				<div class="col-sm-1"></div>
		 
		 </div>
<?php

	$bookingDataInsertSQL = "INSERT INTO `flightbookings`(username,date,cancelled,origin,destination,type) 
	VALUES('$user2','$date2','no','$origin','$destination','$mode')";
	$bookingDataInsertQuery = $conn->query($bookingDataInsertSQL);
	$bookingIDSQL = "SELECT * FROM `flightbookings` ORDER BY `bookingID` DESC LIMIT 1";
	$bookingIDQuery = $conn->query($bookingIDSQL);
	$bookingIDGet = $bookingIDQuery ->fetch_array(MYSQLI_NUM);
	$latestBookingID = $bookingIDGet[0];
	$currentBookingID = $latestBookingID;
?>

         <?php endif; ?>	
         <div class="importantInfo">
			
				<div class="col-sm-12"></div> <!-- empty class -->
				
				<div class="col-sm-12 spacer">a</div>
				<div class="col-sm-12 spacer">a</div>
				
				<div class="col-sm-1"></div>
				
					<div class="col-sm-10">
				
						<div class="subHeading">
							
							Important Information
							
						</div>
					
					</div>
						
				<div class="col-sm-1"></div>
					
				<div class="col-sm-12"></div>
						
				<div class="col-sm-1"></div>
				<div class="col-sm-10 bar"></div>
				<div class="col-sm-1"></div>
				
				<div class="col-sm-12"></div>
				
				<div class="col-sm-1"></div>
				
				<div class="col-sm-10">
					
					<div class="info">
						
						<span class="strong"></span> A printed copy of this receipt must be presented at the time of check-in.						
						
					</div>
					
			
					
				</div>
				
				<div class="col-sm-1"></div>
							
				<div class="col-sm-12 spacer">a</div>
								
				<div class="col-sm-12"></div> <!-- empty class -->
				
			</div> <!-- importantInfo -->		 
	</body>
	
	<!-- BODY TAG ENDS -->
	
</html>


