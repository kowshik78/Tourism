<?php
session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blocked.php");
   		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
}
$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "ghuraghuri";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

$userid = $_SESSION["username"];
$postid = $_POST['postid'];
$rating = $_POST['rating'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM package_rating WHERE postid='$postid' and userid='$userid'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$count = $row['cntpost'];

if($count == 0){
    $insertquery = "INSERT INTO package_rating(userid,postid,rating) values('$userid','$postid','$rating')";
    $conn->query($insertquery);
}else {
    $updatequery = "UPDATE package_rating SET rating='$rating' where userid='$userid' and postid='$postid'";
    $conn->query($updatequery);
}


// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM package_rating WHERE postid='$postid'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$averageRating = $row['averageRating'];

$return_arr = array("averageRating"=>$averageRating);

echo json_encode($return_arr);
?>