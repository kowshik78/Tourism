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
  		<meta name="author" content="Joydeep Dev Nath">
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
								<a href="hotels.php"><li>Hotels</li></a>
								<a href="flights.php"><li>Flights</li></a>
								<a href="index.php"><li>Homepage</li></a>
								<a href="logout.php"><li>Logout</li></a>

							</ul>
							
						</div>
						
					</div>
		<?php
			$mode=$_POST["modeHidden"];
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
		<div class="spacer">a</div>
		<div class="bookingWrapper">

			<div class="headingOne" style="margin-left:-500px;">
				Please review and confirm your booking
			</div>

			<?php if($mode=="hotel"): ?>
	
			<div class="container">
	
			<?php
				$hotelID = $_POST["hotelIDHidden"];
				$hotelSQL = "SELECT * FROM `hotels` WHERE hotelID='$hotelID'";
				$hotelQuery = $conn->query($hotelSQL);
				$row = $hotelQuery->fetch_assoc();
			?>
				
				<div class="col-sm-6""> 
				
					<div class="boxLeftHotel">
						<div class="col-sm-12 hotelMode">Booking Summary</div>
						<div class="col-sm-12 hotelName">
							Name of the hotel: <span class="nameText"><?php echo $row["hotelName"].', '.$row["locality"].', '.$row["city"]; ?></span>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="checkIn"><?php echo $_SESSION["checkIn"]; ?></div>
							<div class="checkInSubscript">Check In Date</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="checkOut"><?php echo $_SESSION["checkOut"]; ?></div>
							<div class="checkOutSubscript">Check Out Date</div>
						</div>

						<div class="col-sm-3 borderRight">
							<div class="noOfRooms"><?php echo $_SESSION["noOfRooms"]; ?></div>
							<div class="noOfRoomsSubscript">No. of rooms</div>
						</div>
                 </div>
            </div>
	     
				
              
             <div class="container" >
				<div class="col-sm-7"> <!-- fare container -->
				
				<div class="col-sm-10">
					<div class="boxRightHotel">
					<div class="col-sm-12 fareSummary">Payment Summary</div>	
					<div class="col-sm-8">
					<?php
						$var1 = $_SESSION["checkIn"];
						$var2 = $_SESSION["checkOut"];
						$date1 = date_create(str_replace('/', '-', $var1));
						$date2 = date_create(str_replace('/', '-', $var2));
						$diff=date_diff($date1,$date2);
					?>
						<div class="heading"><?php echo $_SESSION["noOfRooms"]; ?> Rooms x <?php echo $diff->format("%a Days"); ?></div>
						<div class="heading">Convenience Fee</div>	
					</div>
					
					<?php $noOfDays = $diff->format("%a"); ?>
					<div class="col-sm-4">
					<div class="price"><span class="sansSerif">₹ </span><?php echo $_SESSION["noOfRooms"]*$row["price"]*$noOfDays; ?></div>
					<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>	
					
					<div class="col-sm-12">		
					<div class="calcBar"></div>		
					</div>
					
					<div class="col-sm-8">
					<div class="headingTotal">Total Payment</div>
					</div>
					
					<div class="col-sm-4">
					<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($_SESSION["noOfRooms"]*$row["price"]*$noOfDays)+250; ?></div>
					</div>
					
					<form action="generateReceipt.php" method="POST">
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm Booking">
						</div>
						<?php $totalFare = ($_SESSION["noOfRooms"]*$row["price"]*$noOfDays)+250; ?>
                         <input type="hidden" name="modeIDHidden" value="hotel">						
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="hotelIDHidden" value="<?php echo $hotelID; ?>">
						
					</form>
				</div>
			</div> 
				</div> 
				
	
			</div>

      </div> 
	         <?php elseif($mode=="OneWayFlight"): ?>
			
			<div class="bookingWrapper">
			
			<?php
				
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
				
				$outboundFlightSQL = "SELECT * FROM `flights` WHERE flight_no='$flightNoOutbound'";
				$outboundFlightQuery = $conn->query($outboundFlightSQL);
				$row = $outboundFlightQuery->fetch_assoc();
				//$outboundFlightFare = $outboundFlightQuery->fetch_array(MYSQLI_NUM);
				
			?>
				
				<div class="container"> <!-- departure container -->
				
				<div class="col-sm-12">
				
					<div class="boxLeftOneWayFlight">
					
						<div class="col-sm-12 mode">Departure</div>
						
						<div class="col-sm-4">
						
						<div class="origin"><?php echo $origin; ?></div>
						<div class="departs">Departs <?php echo $depart; ?> at: <?php echo $row["departs"]; ?></div>
						
						</div>
						
						<div class="col-sm-4">
							
							<div class="arrow"></div>
							
						</div>
						
						<div class="col-sm-4">
						
						<div class="destination"><?php echo $destination; ?></div>
						<div class="arrives">Arrives <?php echo $depart; ?> at: <?php echo $row["arrives"]; ?></div>
						
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="operator"><?php echo $row["operator"]; ?></div>
							<div class="operatorSubscript">Operator</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="class"><?php echo $className; ?></div>
							<div class="classSubscript">Class</div>
						</div>
						
						<div class="col-sm-3 borderRight">
							<div class="class"><?php echo $_SESSION["username"]; ?></div>
							<div class="classSubscript">User Name</div>
						</div>
						<div class="col-sm-3 borderRight">
							<div class="class"><?php echo $row["flight_no"]; ?></div>
							<div class="classSubscript">bookingID</div>
						</div>
					
					</div> <!-- boxLeft -->
				
				</div> <!-- col-sm-7 Departure -->
				
				</div>
				
		
				
				<div class="container">
					
					<div class="col-sm-4">
						<div class="price"><span class="sansSerif">₹ </span><?php echo $row["fare"]; ?></div>
						<div class="price"><span class="sansSerif">₹ </span>250</div>
					</div>	
					
					<div class="col-sm-12">
							
							<div class="calcBar"></div>
							
					</div>
					
					<div class="col-sm-8">
						<div class="headingTotal">Total Fare</div>
					</div>
					
					<div class="col-sm-4">
						<div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($row["fare"])+250; ?></div>
					</div>
					
					<form action="generateReceipt.php" method="POST">
					
						<div class="bookingButton text-center">
							<input type="submit" class="confirmButton" value="Confirm Booking">
						</div>
						
						<?php $totalFare = ($row["fare"])+250 ?>
						<input type="hidden" name="modeIDHidden" value="OneWayFlight">
						<input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
						<input type="hidden" name="typeHidden" value="<?php echo $type; ?>">
						<input type="hidden" name="classHidden" value="<?php echo $class; ?>">
						<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
						<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
						<input type="hidden" name="departHidden" value="<?php echo $depart; ?>">
                  <!--	<input type="hidden" name="returnHidden" value="--><?php //echo $return; ?><!--">-->
						<input type="hidden" name="flightNoOutboundHidden" value="<?php echo $row["flight_no"]; ?>">
						
					</form>
					
				</div>
				
			
		</div> <!-- fare container -->
				
		
		
		<?php endif; ?>
	