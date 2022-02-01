<?php session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blockedBooking.php");
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
	
		<title>Flights | Project Meteor</title>
    
    	<link href="css/main.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/bootstrap-select.css" rel="stylesheet">
		<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    	<script src="js/jquery-3.2.1.min.js"></script>
    	<script src="js/main.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<script src="js/bootstrap-select.js"></script>
    	<script src="js/bootstrap-dropdown.js"></script>
    	<script src="js/jquery-2.1.1.min.js"></script>
    	<script src="js/moment-with-locales.js"></script>
    	<script src="js/bootstrap-datetimepicker.js"></script>
    	<script src="js/scrolling-nav.js"></script>
    	<script src="js/jquery.easing.min.js"></script>
		<script type="text/javascript">
		
			$(function () {
       				$('#datetimepicker1').datetimepicker({
		   			format: 'L',
		   			locale: 'en-gb',
					useCurrent: false,
					minDate: moment()
	   				});
				
        			$('#datetimepicker2').datetimepicker({
            		useCurrent: false,
					format: 'L',
					locale: 'en-gb',
					minDate: moment()
					});
				
					$("#datetimepicker1").on("dp.change", function (e) {
            		$('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        			});
				
        			$("#datetimepicker2").on("dp.change", function (e) {
            		$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        			});
    		});
			
		</script>
    	
	</head>
	
	<body>
	
	<div class="header">
					
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
					
					</div>
		<div class="container-fluid" id="book">
		
			<div class="flights col-sm-12">
			
		
				
				<div class="col-sm-12">
					
					<div class="">
   					
    					<div class="content">
    					
    					<form name="flightSearch" action="oneWayFlightSearch.php" method="POST">
    					
    						<div class="radioContainer">
    							<div class="col-sm-6 text-left">
    								<input type="radio" name="flightType" value="One Way" id="oneWay" checked="checked">
    								<label for="oneWay"><span class="radioLeft">One Way</span></label>
									<input type="radio" name="flightClass" value="Business Class" style="height:35px; width:35px;" id="businessClass">
    								<label for="businessClass"><span class="radioRight" style="color:black;font-weight:bold;font-size:30px;">Business Class</span></label>		
  									<input type="radio" name="flightClass" value="Economy Class" style="height:35px; width:35px;" id="economyClass" checked>
    								<label for="economyClass"><span class="radioRight" style="color:black;font-weight:bold;font-size:30px;" >Economy Class</span></label>
    							</div>
    						
							</div> <!-- radioContainer -->
    					
    						<div class="col-sm-6">			
   							<div class="form-group">
   								 <label for="origin" style="color:black;font-weight:bold;font-size:30px;">Origin:<p> </p></label>
     
      								<select id= "origin"  data-live-search="true" class="selectpicker form-control" data-size="5" title="Select Origin" name="origin" required>
       									<option value="Dhaka"  data-tokens="DEL New Delhi">Dhaka</option>
        								<option value="Rajshahi"  data-tokens="BOM Mumbai">Rajshahi</option>
        								<option value="Chittagong"" data-tokens="CCU Kolkata">Chittagong</option>
        								<option value="Khulna"  data-tokens="BLR Bengaluru">Khulna</option>
        								<option value="Barishal"  data-tokens="PNQ Pune">Barishal</option>
        								<option value="Sylhet" data-tokens="MAA Chennai">Sylhet</option>
      								</select>
							</div>
            			</div>
            			
            				<div class="col-sm-6">			
   							<div class="form-group">
   								 <label for="destination" style="color:black;font-weight:bold;font-size:30px;">Destination:<p> </p></label>
     
      								<select id= "destination"  data-live-search="true" class="selectpicker form-control" data-size="5" title="Select Destination" name="destination" required>
       									<option value="Dhaka"  data-tokens="DEL New Delhi">Dhaka</option>
        								<option value="Rajshahi" data-tokens="BOM Mumbai">Rajshahi</option>
        								<option value="Chittagong"  data-tokens="CCU Kolkata">Chittagong</option>
        								<option value="Khulna"  data-tokens="BLR Bengaluru">Khulna</option>
        								<option value="Barishal" data-tokens="PNQ Pune">Barishal</option>
        								<option value="Sylhet"  data-tokens="MAA Chennai">Sylhet</option>
      								</select>
							</div>
            			</div>
            			
            				<div class="col-sm-3">
        						<div class="form-group">
     								<label for="datetime1" style="color:black;font-weight:bold;font-size:30px;">Select Departure Date:<p> </p></label>
            						<div class="input-group date" id="datetimepicker1">
                						<input id="datetime1" type="text" class="inputDate form-control" placeholder="Select Departure Date" name="depart" required/>
                						<span class="input-group-addon">
                   						<span class="fa fa-calendar"></span>
                						</span>
            						</div>
        						</div>
    						</div>
    						
    						<div class="col-sm-3">
       							<div class="form-group">
           							<label for="datetime2" style="color:black;font-weight:bold;font-size:30px;">Select Return Date:<p> </p></label>
            						<div class="input-group date" id="datetimepicker2">
                							<input  id="datetime2" type="text" class="inputDate form-control" placeholder="Select Return Date" name="return" required/>
                							<span class="input-group-addon">
                    						<span class="fa fa-calendar"></span>
                					        </span>
            				        </div>
                                </div>
                             </div>
            			
            			
            				<div class="col-sm-12 text-center" >
            			
            					<input type="submit" class="button" name="searchFlights" value="Search Flights" style=" background-color: black;">
            				
            				</div>
            				
            			</form>
            			
    					</div>
					</div> 
					
				</div>
	
			</div>
					
					<div class="popularFlights col-sm-12">
					
						<div class="heading">
						
								Popular Flights
						
						</div>
						
						<div class="bg">
						
						<?php
		                    $uid=$_SESSION['username'];
							$servername = "localhost";
							$username = "root";
							$password = "";
							$dbname = "ghuraghuri";
							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn->connect_error) {
								die("Connection failed: " . $conn->connect_error);
							}
							
				$qur= "select * from flightbookings WHERE username='$uid' AND origin=(select origin from flightbookings group by origin order by count(origin) desc limit 1)limit 5";
			                $robi = $conn->query($qur);
							
							$FlightsSQL = "SELECT * FROM `flights` ORDER BY `noOfBookings` DESC LIMIT 3";
							$FlightsQuery = $conn->query($FlightsSQL);
    						while($row = $FlightsQuery->fetch_assoc()) {
		                    $operator=$row["operator"];
							
						?>
						
						 <?php  while($flightRow = $robi->fetch_assoc()) { ?>
							<div class="listItem">
								<div class="col-sm-2 text-center">
									<div class="headings">
		
										Operator
			
									</div>
		
									<div class="operatorLogo text-center">
			
										<?php if($operator=="IndiGo"): ?>
				
										<img src="images/flights/operatorLogos/indigo.jpg">
										
										<?php elseif($operator=="AirIndia"): ?>
										
										<img src="images/flights/operatorLogos/airindia.jpg">
										
										<?php elseif($operator=="Vistara"): ?>
										
										<img src="images/flights/operatorLogos/vistara.jpg">
										
										<?php elseif($row["operator"]=="Jet Airways"): ?>
							
										<img src="images/flights/operatorLogos/jetairways.jpg">
										
										<?php elseif($row["operator"]=="Spicejet"): ?>
										
										<img src="images/flights/operatorLogos/spicejet.jpg">
										
										<?php elseif($row["operator"]=="GoAir"): ?>
										
										<img src="images/flights/operatorLogos/goair.jpg">
							
										<?php elseif($row["operator"]=="AirAsia"): ?>
										
										<img src="images/flights/operatorLogos/airasia.jpg">
										
										<?php endif; ?>
									</div>
		
								</div>

								<div class="col-sm-2 text-center">
	
									<div class="headings">
		
										Origin
			
									</div>
		
									<div class="values origin">
		
										<?php echo $row["origin"]; ?>
			
									</div>
		
									<div class="originSubscript">
		
										<?php echo $row["origin_code"]; ?>
			
									</div>
		
								</div>
	
	
								<div class="col-sm-2 text-center">
	
									<div class="headings">
		
										Destination
			
									</div>
		
									<div class="values destination">
		
										<?php echo $row["destination"]; ?>
			
									</div>
		
									<div class="destinationSubscript">
		
										<?php echo $row["destination_code"]; ?>
			
									</div>
		
								</div>
	
									
								<div class="col-sm-2 text-center">
	
									<div class="headings">
		
										Time
			
									</div>
		
									<div class="values time">
		
										<div class="departure">
											
											<?php echo $row["departs"]; ?>
											
										</div>
										
										<div class="arrival">
											
											<?php echo $row["arrives"]; ?>
											
										</div>
		
									</div>
		
								</div>
	
	
								<div class="col-sm-2 text-center">
	
									<div class="headings">
		
										Fare
			
									</div>
		
									<div class="values fare">
		
										<?php echo $row["fare"]; ?>
			
									</div>
								</div>
	
								<?php
				
								$flightNo = $row["flight_no"];
									
								$Available = "SELECT seats_available FROM `flights` WHERE flight_no='$flightNo'";
								$AvailableQuery = $conn->query($Available);
								$AvailableGet = $AvailableQuery ->fetch_array(MYSQLI_NUM);
							
								$Available = $AvailableGet[0];
								
								?>
				
								<?php if($Available>0): ?>
					
								<div class="col-sm-2 text-center" style="border-right: none;">
								
									<div class="headings">
		
										BookNow
			
									</div>

									<div class="availabilitySubscript">
		
										<a class="page-scroll" href="#book">
										<input type="submit" class="availabilityBookingButton" value="Book Now">
										</a>
			
									</div>
		
								</div>
								
								<?php else:  ?>
								
								<div class="col-sm-2 text-center" style="border-right: none;">
								<!-- try to remove the inline css -->
									
									<div class="headings">
		
										Availability
			
									</div>

									<div class="values availabilityRed">
				
										Unavailable
					
									</div>
				
									<div class="unavailabilitySubscript">
				
										Sold Out
					
									</div>

								</div>
				
								<?php endif;?>

							</div> 
							<?php } }?>
							
						</div> 
						
					</div>
				
				
		</div> 
	</body>
</html>