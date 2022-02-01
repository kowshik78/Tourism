<?php session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blockedBooking.php");
   		
}
?>

<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

	<head>

  		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" href="images/favicon.ico">
    
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
		<script type="text/javascript">
		
			$(function () {
       				$('#datetimepicker5').datetimepicker({
		   			format: 'L',
		   			locale: 'en-gb',
					useCurrent: false,
					minDate: moment()
	   				});
				
        			$('#datetimepicker6').datetimepicker({
            		useCurrent: false,
					format: 'L',
					locale: 'en-gb'
					});
				
					$("#datetimepicker5").on("dp.change", function (e) {
            		$('#datetimepicker6').data("DateTimePicker").minDate(e.date);
        			});
				
        			$("#datetimepicker2").on("dp.change", function (e) {
            		$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        			});
    		});
			
		</script>
    	
	</head>

	<body>
        
		<div class="container-fluid">
		
			<div class="hotels col-sm-12">
			
			<!-- HEADER SECTION STARTS -->
				
				<div class="col-sm-12">
					
					<div class="header">
					
					<div class="col-sm-12">
						
						<div class="menu text-center">
							
							<ul>
								<li href="hotels.php">Hotels</li>
								<a href="flights.php"><li>Flights</li></a>
								<a href="index.php"><li>Homepage</li></a>
								<a href="logout.php"><li>Logout</li></a>

							</ul>
							
						</div>
						
					</div>
					
					</div>
				
				<div class="col-sm-12">
					
					<div class="search" id="searchHotel">
   					
    					<div class="content">
    					
    					<form action="hotelSearch.php" method="GET">
    					
    						<div class="col-sm-3">			
   							<div class="form-group">
   								 <label for="city">City:<p> </p></label>
     
      								<select id= "city"  data-live-search="true" class="selectpicker form-control" data-size="5" title="Select City" name="city" required>
       									<option value="Dhaka" data-tokens="DEL New Delhi">Dhaka</option>
        								<option value="Rajshahi" data-tokens="BOM Mumbai">Rajshahi</option>
        								<option value="Chittagong" data-tokens="CCU Kolkata">Chittagong</option>
        								<option value="Khulna" data-tokens="BLR Bangalore">Khulna</option>
        								<option value="Barishal" data-tokens="MAA Chennai">Barishal</option>
        								<option value="Sylhet" data-tokens="PNQ Pune">Sylhet</option>
        								<option value="Colgbazar" data-tokens="KER Kerala">Colgbazar</option>
        								<option value="Banglabandha" data-tokens="GAU Guwahati">Banglabandha</option>
        								<option value="teknaf" data-tokens="MAN Manali">teknaf</option>
      								</select>
							</div>
            			</div>
            			
            				<div class="col-sm-3">
        						<div class="form-group">
     								<label for="datetime5">Check-in:<p> </p></label>
            						<div class="input-group date" id="datetimepicker5">
                						<input id="datetime5" type="text" class="inputDate form-control" placeholder="Select Check-in Date" name="checkIn" required/>
                						<span class="input-group-addon">
                   						<span class="fa fa-calendar"></span>
                						</span>
            						</div>
        						</div>
    						</div>
    						
    						<div class="col-sm-3">
        						<div class="form-group">
     								<label for="datetime6">Check-out:<p> </p></label>
            						<div class="input-group date" id="datetimepicker6">
                						<input id="datetime6" type="text" class="inputDate form-control" placeholder="Select Check-out Date" name="checkOut" required/>
                						<span class="input-group-addon">
                   						<span class="fa fa-calendar"></span>
                						</span>
            						</div>
        						</div>
    						</div>
    						
							<div class="col-sm-3">
	
							<label for="rooms">No. of rooms:<p> </p></label>
    							<div class="form-group">
    								<select id= "rooms" class="selectpicker form-control" data-size="5" title="Select no. of rooms" name="rooms" required>
  										<option value="1">1</option>
  										<option value="2">2</option>
  										<option value="3">3</option>
  										<option value="4">4</option>
									</select>
								</div>
							</div>
           				
            				<div class="col-sm-12 text-center">
            			        <br></br><br></br>
            					<input type="submit" class="button" name="searchHotels" value="Search Hotels" id="searchHotelButton">
            				
            				</div>

            			</form>
            			
    					</div> 
    					
					</div> 
					
				</div>
				
			</div> 
			
			
			
			<!-- POPULAR BUS SECTION STARTS -->
			
				<!-- <div class="col-sm-12"> -->
					
					<div class="popularHotels col-sm-12">
					
						<div class="heading">
						
							  জনপ্রিয় রাত্রিযাপন
						
						</div>
						
						<div class="bg">
						
							<!-- replace listItems below by PHP loops -->
							
							<div  class="col-sm-4" >
						
								<div class="listItem" style="border-radius: 50%;">
								
									<div class="imageContainer text-center">
										
										<img src="images/hotels/cities/NewDelhi/piccadily.jpg" alt="New Delhi Hotels" style="border-radius: 60%;">
										
									</div>
									
									<div class="headings">
										
										পতেঙ্গা
										
									</div>
									
									<div class="info">
										
										3-star hotels averaging ₹ 2000
										
									</div>
									
									<div class="info">
										
										5-star hotels averaging ₹ 6500
										
									</div>
								
									
								</div> <!-- listItem 1 -->
							
							</div> <!-- col-sm-4 -->
							
							<div  class="col-sm-4">
						
								<div class="listItem" style="border-radius: 50%;">
								
									<div class="imageContainer text-center">
										
										<img src="images/hotels/cities/Mumbai/JWMarriott.jpg" alt="Mumbai Hotels" style="border-radius: 60%;">
										
									</div>
									
									<div class="headings">
										
										সাতছড়ি
										
									</div>
									
									<div class="info" >
										
										3-star hotels averaging ₹ 3900
										
									</div>
									
									<div class="info" >
										
										5-star hotels averaging ₹ 9700
										
									</div>
								
									
								</div> <!-- listItem 2 -->
							
							</div> <!-- col-sm-4 -->
							
							<div  class="col-sm-4">
						
								<div class="listItem" style="border-radius: 50%;">
								
									<div class="imageContainer text-center">
										
										<img src="images/hotels/cities/Kolkata/HyattRegency.jpg" alt="kolkata Hotels" style="border-radius: 60%;">
										
									</div>
									
									<div class="headings">
										
										বিয়ানীবাজার
										
									</div>
									
									<div class="info">
										
										3-star hotels averaging ₹ 3000
										
									</div>
									
									<div class="info">
										
										5-star hotels averaging ₹ 7750
										
									</div>
								
									
								</div> <!-- listItem 3 -->
							
							</div> <!-- col-sm-4 -->
							
							
						</div> <!-- bg -->
						
					</div> <!-- popularBus -->
		
		</div>
	
	</body>
	
</html>