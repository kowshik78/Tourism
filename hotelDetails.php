<?php session_start();
if (!isset($_SESSION["username"])) {
    header("Location:blocked.php");
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="images/favicon.ico">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700"
          rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js"></script>

    <!-- CSS -->
    <link href="style.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href='jquery-bar-rating-master/dist/themes/fontawesome-stars.css' rel='stylesheet' type='text/css'>
    <!-- Script -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                onSelect: function (value, text, event) {

                    // Get element id by data-id attribute
                    var el = this;
                    var el_id = el.$elem.data('id');

                    // rating was selected by a user
                    if (typeof (event) !== 'undefined') {

                        var split_id = el_id.split("_");

                        var postid = split_id[1];  // postid

                        // AJAX Request
                        $.ajax({
                            url: 'rating_ajax.php',
                            type: 'post',
                            data: {postid: postid, rating: value},
                            dataType: 'json',
                            success: function (data) {
                                // Update average
                                var average = data['averageRating'];
                                $('#avgrating_' + postid).text(average);
                            }
                        });
                    }
                }
            });
        });

    </script>
</head>
<style>
    .block {
        display: block;
        width: 40%;
        border: none;
        background-color: black;
        color: white;
        padding: 14px 28px;
        font-size: 26px;
        cursor: pointer;
        text-align: center;
    }
</style>

<body>
<div class="">

    <div class="menu text-center">

        <ul>
            <a href="hotels.php">
                <li>Hotels</li>
            </a>
            <a href="flights.php">
                <li>Flights</li>
            </a>
            <a href="index.php">
                <li>Homepage</li>
            </a>
            <a href="logout.php">
                <li>Logout</li>
            </a>

        </ul>

    </div>

</div>

<?php

$hotelID = $_GET["hotelId"];

?>

<div class="spacer">a</div>
<div class="spacer">a</div>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghuraghuri";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM hotels WHERE hotelID='$hotelID'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//rating
$userid = $_SESSION["username"];
$query = "SELECT * FROM hotels";
$rwesult = $conn->query($query);
$row1 = $rwesult->fetch_assoc();
$postid = $hotelID;
//$title = $roww['hotelName'];
//$content = $roww['hotelDesc'];
// User rating
//$query = "SELECT * FROM post_rating WHERE postid='$postid' and userid='$userid'";
//$userresult = $conn->query($query);
//$roww = $rwesult->fetch_assoc();
//$rating = $row1['rating'];
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM post_rating WHERE postid='$postid'";
$avgresult = $conn->query($query);
$row1 = $avgresult->fetch_assoc();
$averageRating = $row1['averageRating'];
if ($averageRating <= 0) {
    $averageRating = "Give 1st Rating";
}

?>

<div class="col-sm-1"></div> <!-- empty div -->

<div class="col-sm-10 hotelDetails">

    <div class="col-sm-12 listItem">

        <div class="col-sm-8 leftBox">

            <div class="col-sm-12 imageContainer">

                <img src="<?php echo $row["mainImage"]; ?>" alt="Image not found"/>

            </div>

        </div>

        <div class="col-sm-4 rightBox borderLeft">

            <div class="hotelName col-sm-12 text-center noMargin">

                <?php echo $row["hotelName"]; ?>

            </div>

            <div class="location col-sm-12 text-center">

                <span class="fa fa-map-marker"></span> <?php echo $row["locality"] . ', ' . $row["city"]; ?>

            </div>


            <form action="booking.php" method="POST">

                <div class="col-sm-12 text-center">

                    <input type="submit" class="bookNow" value="Book Now"/>

                </div>

                <input type="hidden" name="modeHidden" value="hotel"/>
                <input type="hidden" name="hotelIDHidden" value="<?php echo $hotelID; ?>"/>

            </form>

            <div class="col-sm-5 text-center">
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
                    <h3><span id='avgrating_<?php echo $postid; ?>'><?php echo $averageRating; ?></span></h3>

                    <script type='text/javascript'>
                        $(document).ready(function () {
                            $('#rating_<?php echo $postid; ?>').barrating('set');
                        });
                    </script>

                </div>

                <div class="col-sm-12 ratingText noMargin">

                    <?php

                    $rating = $row["rating"];

                    if ($rating >= 4): ?>

                        Excellent

                    <?php

                    elseif ($rating >= 3 and $rating < 4): ?>

                        Average

                    <?php

                    elseif ($rating < 3): ?>

                        Bad

                    <?php endif; ?>

                </div>

            </div>

            <div class="col-sm-7 text-center">

                <div class="col-sm-12 starContainer">
                    <div class="spacer">a</div>
                    <?php

                    $noOfStars = $row["stars"];

                    for ($i = 0; $i < $noOfStars; $i++) { ?>

                        <i class="fa fa-star"></i>

                    <?php } ?>

                </div>

            </div>

            <div class="col-sm-12 amenities text-center">

                <ul>

                    <?php if ($row["wifi"] == "yes") { ?>
                        <li class="fa fa-wifi icons" id="wifi"></li>
                    <?php } ?>

                    <?php if ($row["swimmingPool"] == "yes") { ?>
                        <li class="fa fa-life-buoy icons" id="pool"></li>
                    <?php } ?>

                    <?php if ($row["parking"] == "yes") { ?>
                        <li class="fa fa-car icons" id="parking"></li>
                    <?php } ?>

                    <?php if ($row["restaurant"] == "yes") { ?>
                        <li class="fa fa-cutlery icons" id="restaurant"></li>
                    <?php } ?>

                    <?php if ($row["laundry"] == "yes") { ?>
                        <li class="fa fa-shirtsinbulk icons" id="laundry"></li>
                    <?php } ?>

                    <?php if ($row["cafe"] == "yes") { ?>
                        <li class="fa fa-coffee icons" id="cafe"></li>
                    <?php } ?>

                </ul>

                <div class="col-sm-12"></div>

                <ul>

                    <?php if ($row["wifi"] == "yes") { ?>
                        <li class="tags">Wifi</li>
                    <?php } ?>

                    <?php if ($row["swimmingPool"] == "yes") { ?>
                        <li class="tags">Pool</li>
                    <?php } ?>

                    <?php if ($row["parking"] == "yes") { ?>
                        <li class="tags">Parking</li>
                    <?php } ?>

                    <?php if ($row["restaurant"] == "yes") { ?>
                        <li class="tags">Restaurant</li>
                    <?php } ?>

                    <?php if ($row["laundry"] == "yes") { ?>
                        <li class="tags">Laundry</li>
                    <?php } ?>

                    <?php if ($row["cafe"] == "yes") { ?>
                        <li class="tags">Cafe</li>
                    <?php } ?>

                </ul>

            </div> <!-- amenities -->

            <div class="col-sm-12 checkInOut text-center">

                <div class="col-sm-6 checkIn">

                    <div class="col-sm-12 time">

                        <?php echo $row["checkIn"]; ?>

                    </div>

                    <div class="col-sm-12 timeTag">

                        Check In

                    </div>

                </div>

                <div class="col-sm-6 checkOut">

                    <div class="col-sm-12 time">

                        <?php echo $row["checkOut"]; ?>

                    </div>

                    <div class="col-sm-12 timeTag">

                        Check Out

                    </div>

                </div>

            </div> <!-- checkInOut -->

            <div class="col-sm-12 priceContainer text-center">

                Tk <?php echo $row["price"]; ?>

            </div>

            <div class="col-sm-12 priceNote text-center">


            </div>

        </div>
        <div class="spacer">a</div>

        <div class="col-sm-12 hotelDesc">

            <?php echo $row["hotelDesc"]; ?>

        </div>

        <div class="col-sm-1"></div>
        <div class="col-sm-12 spacer">.</div>
        <a href="viewcomments.php?hotelId=<?php echo $row["hotelID"]; ?>" style="color: black;">
            <button type="button" class="block">Post Comment</button>
        </a>
</body>
</html>