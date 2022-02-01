<!DOCTYPE html>
<?php include 'collaborative.php' ; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link href="packagevendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/tooplate-antique-cafe.css">
	<link href="css/main.css" rel="stylesheet">
    	
	    <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
        <!-- Script -->
		<script src="js/jquery-3.2.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
                return false;
            };
        $(function() {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function(value, text, event) {

                   var id = getUrlParameter("Id");
                    // rating was selected by a user
                    if (typeof(event) !== 'undefined') {
                      //  var split_id = el_id.split("_");
                     //   var postid = split_id[1];  // postid
                        // AJAX Request
                        $.ajax({
                            url: 'package_rating_ajax.php',
                            type: 'post',
                            data: {postid:id,rating:value},
                            dataType: 'json',
                            success: function(data){
                                // Update average
                                var average = data['averageRating'];
                                $('#avgrating_'+postid).text(average);
                            }
                        });
                    }
                }
            });
        });

        </script>
  </head>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 150px;
  margin: auto;
  text-align: left;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 6px;
  color: white;
  background-color: #000;
  text-align: left;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>
  <body >
        <?php
		session_start();
		if(!isset($_SESSION["username"]))
		{
    	header("Location:blocked.php");
   		$_SESSION['url'] = $_SERVER['REQUEST_URI'];
		}
			$ID=$_GET["Id"];
			$userid = $_SESSION["username"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "ghuraghuri";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT * FROM landmark where destinationId='$ID'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();

            $preds=implode(', ', giveTopThreePred($userid));
			$qur= "select * from landmark WHERE destinationId IN ($preds)  limit 5";
			$robi = $conn->query($qur);
			var_dump($qur);
        //rating
        $userid = $_SESSION["username"];
        $query = "SELECT * FROM landmark";
        $rwesult = $conn->query($query);
        $roww = $rwesult->fetch_assoc();
        $postid = $ID;
        //$title = $roww['hotelName'];
        //$content = $roww['hotelDesc'];
        // User rating
        //$query = "SELECT * FROM post_rating WHERE postid='$postid' and userid='$userid'";
        //$userresult = $conn->query($query);
        //$roww = $rwesult->fetch_assoc();
        //$rating = $roww['rating'];
        $query = "SELECT ROUND(AVG(rating),1) as averageRating FROM package_rating WHERE postid='$postid'";
        $avgresult = $conn->query($query);
        $roww = $avgresult->fetch_assoc();
        $averageRating = $roww['averageRating'];
        if ($averageRating <= 0) {
            $averageRating = "Give 1st Rating";
        }
        //echo $averageRating;
        ?>

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
					</div class="col-sm-12">
				 </div>
	   </div>

      <div class="container">
        <div class="row">
            <h1 style="color:black; font-weight:1000; font-size: 50px; "><?php echo $row['title']; ?><?php echo ", " ?><?php echo $row['location'];?> </h1>
			    <form action="packageReceipt.php" method="POST">
						<div class="content">
							<input type="submit" class="bookNow" value="Book Now" style="font-size:30px;font-weight:999; background-color:orange; color:black;padding:20px;" />
				            <input type="hidden" name="packIDHidden" value="<?php echo $row["title"]; ?>" />
                            <input type="hidden" name="Id2" value="<?php echo $row["destinationId"]; ?>" />
						</div>
			   </form>
			   
        </div>
	     <?php if(isRatable($userid, $ID)) { ?>
		   <div class="col-sm-5 text-center" style="margin-top: -438px; padding-left: 810px;">
            <div>
                <select class="rating" ; data-id="rating_<?php echo $postid; ?>">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="col-sm-12 rating noMargin">
                <script type='text/javascript'>
                    $(document).ready(function () {
                        $('#rating_<?php echo $postid; ?>').barrating('set');
                    });
                </script>
            </div>
           </div>
              <?php } ?>
      </div>
   
    <section class=" grid-system" style="padding-left: 50px;">
        <div class="row" >
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                       <img src="<?php echo $row['mainImage'];?>">
                    </div>
                    <div class="down-content"style="background-color:black">
                      <p style="font-size:20px; font-weight:500; color:white; margin-left:20px; margin-bottom:20px"><?php echo $row['description']; ?></p>
                     <div class="spacer">.</div>
                    </div>
                  </div>
                </div>
			 </div>
            </div>
				
			<h1 style="font-size:40px; font-weight:bold; color:blue;background-color:yellow;">Packages My Might Like!</h1>
            <div class="all-blog-posts">
              <div class="row">
				<?php  while($hotelRow = $robi->fetch_assoc()) {?>
						  <div class="card" style="margin: 27px; max-width: 250px">
					        <h1 style="font-weight:1000; font-size: 25px"><?php echo $hotelRow["title"]; ?></h1>
                            <p style="font-weight:40; font-size: 25px"><?php echo $hotelRow["duration"]; ?></p>
							<img src="<?php echo $hotelRow["mainImage"]; ?>">
							<h1 style="font-weight:1000; font-size: 25p"><?php echo $hotelRow["price"]; ?>Tk</h1>
	                       <h1><a href="packageDetail.php?Id=<?php echo $hotelRow["destinationId"];?>">
						   <button style="font-size:20px;background-color:orange; color:black;">Click</button></a></h1>
						 </div>  
				<?php } ?>
              </div>
            </div>
			
          </div>
          <div class="col-lg-3" >
            <div class="sidebar">
              <div class="row">
                <div>
				  <div>
                   <div >
                    <div class="bg-black p-12 text-center">
                      <h1 class="text-white text-5xl tm-logo-font mb-5">Duration</h1>
                       <p class="tm-text-gold tm-text-2xl" style="font-size: 2.5em"><?php echo $row['duration']; ?></p>
                         </div>
                           <div class="bg-black p-12 mb-5 text-center">
                             <h1 class="text-white text-4xl tm-logo-font mb-5" style="font-size: 2.5em">Departure - Destination</h1>
                             <p class="tm-text-gold tm-text-2xl"  style="font-size: 2.5em"><?php echo $row['departure_destination']; ?></p>
                           </div>
                         
						  <h3 style="font-size:40px;font-weight:600; background-color:black; color:white;padding:10px;">Rating : <span id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?></span></h3>
                          <h1 style="font-weight:1000; font-size: 50px; border: 5px solid green">Price:   <?php echo $row['price']; ?>Tk</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </body>
</html>
