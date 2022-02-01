<?php session_start(); 
?>

<!DOCTYPE html>
<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ghuraghuri";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$profileSQL = "SELECT * FROM landmark where zone='CH'";
		$profileSQL1 = "SELECT * FROM landmark where zone='SY'";
		$profileSQL2 = "SELECT * FROM landmark where zone='RAJ'";
		$profileSQL3 = "SELECT * FROM landmark where zone='KHU'";
		$profileSQL4 = "SELECT * FROM landmark where zone='DHA'";
		$profileSQL5 = "SELECT * FROM landmark where zone='BAR'";
		$result = $conn->query($profileSQL);
		$result1 = $conn->query($profileSQL1);
		$result11 = $conn->query($profileSQL1);
		$result2 = $conn->query($profileSQL2);
		$result22 = $conn->query($profileSQL2);
		$result3= $conn->query($profileSQL3);
		$result4 = $conn->query($profileSQL4);
		$result5 = $conn->query($profileSQL5);
	?>
			
<html>
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="shortcut icon" href="images/favicon.ico">
	<link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href="css/hover-min.css" rel="stylesheet"/>
	<link href="css/main.css" rel="stylesheet"/>
   	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>

    <link rel="stylesheet" href="eww/font-awesome-4.7.0/css/font-awesome.min.css">               
    <link rel="stylesheet" href="eww/css/bootstrap.min.css">                                    
    <link rel="stylesheet" type="text/css" href="eww/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="eww/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="eww/slick/slick-theme.css"/>
    <link rel="stylesheet" href="eww/css/templatemo-style.css">   
	<script src="eww/js/jquery-1.11.3.min.js"></script>             
    <script src="eww/js/datepicker.min.js"></script>                
    <script src="eww/js/jquery.singlePageNav.min.js"></script>      
    <script src="eww/slick/slick.min.js"></script> 
	
    <script> 
        $(function(){

            // Change top navbar on scroll
            $(window).on("scroll", function() {
                if($(window).scrollTop() > 100) {
                    $(".tm-top-bar").addClass("active");
                } else {                    
                 $(".tm-top-bar").removeClass("active");
                }
            });

            // Smooth scroll to search form
            $('.tm-down-arrow-link').click(function(){
                $.scrollTo('#tm-section-search', 300, {easing:'linear'});
            });

            // Date Picker in Search form
            var pickerCheckIn = datepicker('#inputCheckIn');
            var pickerCheckOut = datepicker('#inputCheckOut');

            // Update nav links on scroll
            $('#tm-top-bar').singlePageNav({
                currentClass:'active',
                offset: 60
            });

            // Close navbar after clicked
            $('.nav-link').click(function(){
                $('#mainNav').removeClass('show');
            });

            // Slick Carousel
            $('.tm-slideshow').slick({
                infinite: true,
                arrows: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });

            loadGoogleMap();                                         
            $('.tm-current-year').text(new Date().getFullYear());       
        });
    </script> 
    <style>
        .bigText {
        height:1px;}
    </style>
	</head>
	
	
	<body>
	<div class="col-xs-12 home">
	<!-- HEADER SECTION -->
			<div class="col-sm-12">
				<div class="header">
					<br>
					<?php
					
					if(!isset($_SESSION["username"])) {
						include("common/headerTransparentLoggedOut.php");
					}
					else {
						include("common/headerTransparentLoggedIn.php");
					}
					
					?>
				</div>
			</div>
			
			<!-- carousel -->
		<div class="col-xs-12 banner">
		
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
		  	
			  	<ol class="carousel-indicators">
			   		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			   		<li data-target="#myCarousel" data-slide-to="1"></li>
			   		<li data-target="#myCarousel" data-slide-to="2"></li>
			  	</ol>
			
			   	<div class="carousel-inner">
			   	
			    	<div class="item active">
			    	  <img src="images/carousel/bd1.jpg" alt="Image1">
                      
			    	</div>
			    	
			    	<div class="item">
			    	  <img src="images/carousel/bd2.jpg" alt="Image2">
			    	</div>
				
			    	<div class="item">
			    	  <img src="images/carousel/bd3.jpg" alt="Image3">
			    	</div>
			    
			  	</div>
				
			   	<a href="#myCarousel" class="left carousel-control" data-slide="prev">
			    	<span class="glyphicon glyphicon-chevron-left"></span>
			    </a>
			    <a href="#myCarousel" class="right carousel-control" data-slide="next">
			        <span class="glyphicon glyphicon-chevron-right"></span>
			    </a>
			    
			</div>
			
		</div> <!-- banner -->
		
			<!-- icons -->
			<div class="col-xs-12 iconContainer">
				
				<div class="col-xs-12 iconHolder">
				
					<div class="col-xs-12 bookQuote">
					
						What would you like to book today?
						
					</div>
		         
					<div class="col-xs-12 iconGrids hvr-grow">
					
						
					</div>
					<div class="col-xs-12 iconGrids hvr-grow">
					
						<a href="hotels.php" style="color: black;">
						
						<div class="col-xs-12 icons text-center">
							<img src="images/icons/hotel.png" alt="hotels" class="iconsDim text-center"/>
						</div>
						
						<div class="col-xs-12 heading">
							<h1>Hotels</h1>
						</div>
						
						</a>
						
					</div>
					
					
					
					<div class="col-xs-12 iconGrids hvr-grow">
					
						<a href="flights.php" style="color: black;">
							
							<div class="col-xs-12 icons text-center">
								<img src="images/icons/flight.png" alt="flights" class="iconsDim text-center"/>
							</div>
							
							<div class="col-xs-12 heading">
								<h1>Flights</h1>
							</div>
							
						</a>
						
					</div>
					
				</div>
				
			</div>
			
			<!-- Asia-Europe_America 3 slide -->
			<input id="inputCheckIn" type="hidden">  <input id="inputCheckOut" class="bigText">  
            <?php 
			
			$varb = $result->fetch_assoc();$varb1 = $result1->fetch_assoc();$varb2 = $result2->fetch_assoc();
            ?>		
            <div>
                <section class="tm-slideshow-section">
                    <div class="tm-slideshow tm-slideshow-highlight">
                        <img src="img/hill1.jpg" alt="Image">
                        <img src="img/hill2.jpg" alt="Image">
                        <img src="img/hill3.jpg" alt="Image">    
                    </div>
                    <div class="tm-slideshow-description tm-bg-primary">
                        <h2 style="color:black">ঘুরে আসুন পাহাড়ে আর করুন ট্র্যাকিং</h2>
                        <h5>একদিনের রোমাঞ্চকর ভ্রমণে অনেকেই বেছে নেন সীতাকুণ্ডের এই ঝরঝরি ট্রেইল। কারণ একসঙ্গে কয়েকটি ঝরনা দেখার লোভ সামলাতে পারেন না অনেক পর্যটকরাই</h5>
                        <a href="des.php?val=<?php echo $varb['zone'];?>" class="text-uppercase tm-btn tm-btn-white tm-btn-white-primary">Continue Reading</a>
                    </div>
                </section>
                <section class="tm-slideshow-section tm-slideshow-section-reverse">

                    <div class="tm-right tm-slideshow tm-slideshow-highlight">
                        <img src="img/sea1.jpg" alt="Image">
                        <img src="img/sea2.jpg" alt="Image">
                        <img src="img/sea3.jpg" alt="Image">
                    </div> 

                    <div class="tm-slideshow-description tm-slideshow-description-left tm-bg-highlight">
                        <h2 class="">ভেসে যান সমুদ্রে</h2>
                        <h5>বিশ্বের সবচেয়ে বড় সমুদ্র সৈকত কক্সবাজার, অনেকের পছন্দের তালিকায় রয়েছে। এছাড়া এখানকার বিভিন্ন দ্বীপ যেমন মহেশখালী, কুতুবদিয়া, সোনাদিয়া, শাহপরি, সেন্টমার্টিন দ্বীপ ( স্থানীয় অনেকের কাছে নারিকেল জিঞ্জিরা), মাতাবাড়ি, বন,বৌদ্ধমন্দির রয়েছে।</h5>
                        <a href="des.php?val=<?php echo $varb1['zone'];?>"" class="text-uppercase tm-btn tm-btn-white tm-btn-white-highlight">Continue Reading</a>
                    </div>                        

                </section>
                <section class="tm-slideshow-section">
                    <div class="tm-slideshow tm-slideshow-highlight">
                        <img src="img/his3.jpg" alt="Image">
                        <img src="img/his2.jpg" alt="Image">
                        <img src="img/his1.jpg" alt="Image">
                    </div>
                    <div class="tm-slideshow-description tm-bg-primary">
                        <h2 style="color:black">ঐতিহাসিক স্থান</h2>
                        <h5>হাজার বছরের ইতিহাস ঐতিহ্য ও সংস্কৃতির দেশ আমাদের এই প্রিয় মাতৃভূমি বাংলাদেশে। ইতিহাস ও ঐতিহ্য সমৃদ্ধ এই দেশে কালের বিবর্তনে তৈরী হয়েছে অসংখ্য ঐতিহাসিক স্থান যার মধ্যে খুব কম ঐতিহাসিক স্থান সমুহের নামই আমরা জানি </h5>
                        <a href="des.php?val=<?php echo $varb2['zone'];?>"" class="text-uppercase tm-btn tm-btn-white tm-btn-white-primary">Continue Reading</a>
                    </div>
                </section>
            </div>     
			
			
			 
			<!-- Continent GRID -->
		<div class="col-xs-12 popularDestinationsContainer">
				
		  <div class="col-xs-12 destinationHolder">
			<div class="tm-container-outer" id="tm-section-3">
			  <!-- 6 Continent -->
                <ul class="nav nav-pills tm-tabs-links">
                    
                    <li class="tm-tab-link-li">
                        <a href="#2a" data-toggle="tab" class="tm-tab-link">
                            <img src="img/south-america.png" alt="Image" class="img-fluid">
                            সিলেট
                        </a>
                    </li>
                    <li class="tm-tab-link-li">
                        <a href="#3a" data-toggle="tab" class="tm-tab-link">
                            <img src="img/europe.png" alt="Image" class="img-fluid">
                            রাজশাহী
                        </a>
                    </li>
                    <li class="tm-tab-link-li">
                        <a href="#4a" data-toggle="tab" class="tm-tab-link"><!-- Current Active Tab -->
                            <img src="img/asia.png" alt="Image" class="img-fluid">
                            খুলনা
                        </a>
                    </li>
                    <li class="tm-tab-link-li">
                        <a href="#5a" data-toggle="tab" class="tm-tab-link">
                            <img src="img/africa.png" alt="Image" class="img-fluid">
                            ঢাকা
                        </a>
                    </li>
                    <li class="tm-tab-link-li">
                        <a href="#6a" data-toggle="tab" class="tm-tab-link">
                            <img src="img/antartica.png" alt="Image" class="img-fluid">
                            বরিশাল
                        </a>
                    </li>
                   
                </ul>
					
				<div class="tab-content clearfix">
                    <!-- Tab 1 -->
                    <div class="tab-pane fade" id="1a">
                         <div class="tm-recommended-place-wrap">
						 
                        </div>                      
                    </div> 
				 
                    <!-- Tab 2 -->
                    <div class="tab-pane fade" id="2a">
                         <div class="tm-recommended-place-wrap">
						 <?php 
						     $files1 = glob("img/SY/*.*");
							 for ($i = 0; $i < count($files1); $i++) {
						     $variable1 = $result11->fetch_assoc();
							 ?>
                            <div class="tm-recommended-place">
							<?php echo '<img src="' . $files1[$i] . '" alt="Random image" class="img-fluid tm-recommended-img"/>';  ?>
       							<div class="tm-recommended-description-box">
                                    <h3 class="tm-recommended-title"> <?php echo $variable1['title']; ?> </h3>
                                    <p class="tm-text-highlight"><?php echo $variable1['location']; ?></p>
                                    <p class="tm-text-gray"><?php echo $variable1['details']; ?></p>   
                                </div>
                                <a href="packageDetail.php?Id=<?php echo $variable1['destinationId'];?>" class="tm-recommended-price-box">
                                 <p class="tm-recommended-price"><?php echo $variable1['price']; ?></p>
                                </a>                        
                            </div> 
							 <?php } ?> 
                        </div>                      
                    </div> <!-- tab-pane -->          
                    
                    <!-- Tab 3 -->     
                    <div class="tab-pane fade" id="3a">
                         <div class="tm-recommended-place-wrap">
						 <?php 
						     $files2 = glob("img/RAJ/*.*");
							 for ($i = 0; $i <	 count($files2); $i++) {
						     $variable2 = $result22->fetch_assoc(); 
							 ?>
                            <div class="tm-recommended-place">
							<?php echo '<img src="' . $files2[$i] . '" alt="Random image" class="img-fluid tm-recommended-img"/>';  ?>
       							<div class="tm-recommended-description-box">
                                    <h3 class="tm-recommended-title"> <?php echo $variable2['title']; ?> </h3>
                                    <p class="tm-text-highlight"><?php echo $variable2['location']; ?></p>
                                    <p class="tm-text-gray"><?php echo $variable2['details']; ?></p>   
                                </div>
                                <a href="packageDetail.php?Id=<?php echo $variable2['destinationId'];?>" class="tm-recommended-price-box">
                                 <p class="tm-recommended-price"><?php echo $variable2['price']; ?></p>
                                </a>                        
                            </div> 
							 <?php } ?> 
                        </div>                      
                    </div> <!-- tab-pane -->
                    
                    <!-- Tab 4 -->
                     <div class="tab-pane fade" id="4a">
                         <div class="tm-recommended-place-wrap">
						 <?php 
						     $files3 = glob("img/KHU/*.*");
							 for ($i = 0; $i < count($files3); $i++) {
						     $variable3 = $result3->fetch_assoc(); 
							 ?>
                            <div class="tm-recommended-place">
							<?php echo '<img src="' . $files3[$i] . '" alt="Random image" class="img-fluid tm-recommended-img"/>';  ?>
       							<div class="tm-recommended-description-box">
                                    <h3 class="tm-recommended-title"> <?php echo $variable3['title']; ?> </h3>
                                    <p class="tm-text-highlight"><?php echo $variable3['location']; ?></p>
                                    <p class="tm-text-gray"><?php echo $variable3['details']; ?></p>   
                                </div>
                                <a href="packageDetail.php?Id=<?php echo $variable3['destinationId'];?>&amp;Id2=<?php echo $files3[$i]; ?>" class="tm-recommended-price-box">
                                 <p class="tm-recommended-price"><?php echo $variable3['price']; ?></p>
                                </a>                        
                            </div> 
							 <?php } ?> 
                        </div>                      
                    </div> <!-- tab-pane -->
                    
                    <!-- Tab 5 -->
                    <div class="tab-pane fade" id="5a">
                         <div class="tm-recommended-place-wrap">
						 <?php 
						     $files4 = glob("img/DHA/*.*");
							 for ($i = 0; $i < count($files4); $i++) {
						     $variable4 = $result4->fetch_assoc(); 
							 ?>
                            <div class="tm-recommended-place">
							<?php echo '<img src="' . $files4[$i] . '" alt="Random image" class="img-fluid tm-recommended-img"/>';  ?>
       							<div class="tm-recommended-description-box">
                                    <h3 class="tm-recommended-title"> <?php echo $variable4['title']; ?> </h3>
                                    <p class="tm-text-highlight"><?php echo $variable4['location']; ?></p>
                                    <p class="tm-text-gray"><?php echo $variable4['details']; ?></p>   
                                </div>
                                <a href="packageDetail.php?Id=<?php echo $variable4['destinationId'];?>" class="tm-recommended-price-box">
                                 <p class="tm-recommended-price"><?php echo $variable4['price']; ?></p>
                                </a>                        
                            </div> 
							 <?php } ?> 
                        </div>                      
                    </div> <!-- tab-pane -->   
                    
                    <!-- Tab 6 -->            
                     <div class="tab-pane fade" id="6a">
                         <div class="tm-recommended-place-wrap">
						 <?php 
						     $files5 = glob("img/BAR/*.*");
							 for ($i = 0; $i < count($files5); $i++) {
						     $variable5 = $result5->fetch_assoc(); 
							 ?>
                            <div class="tm-recommended-place">
							<?php echo '<img src="' . $files5[$i] . '" alt="Random image" class="img-fluid tm-recommended-img"/>';  ?>
       							<div class="tm-recommended-description-box">
                                    <h3 class="tm-recommended-title"> <?php echo $variable5['title']; ?> </h3>
                                    <p class="tm-text-highlight"><?php echo $variable5['location']; ?></p>
                                    <p class="tm-text-gray"><?php echo $variable5['details']; ?></p>   
                                </div>
                                <a href="packageDetail.php?Id=<?php echo $variable5['destinationId'];?>" class="tm-recommended-price-box">
                                 <p class="tm-recommended-price"><?php echo $variable5['price']; ?></p>
                                </a>                        
                            </div> 
							 <?php } ?> 
                        </div>                      
                    </div> <!-- tab-pane --> 
                </div>
				
			</div>
		 </div>	
		</div>		
	</div>
	</body>
</html>

