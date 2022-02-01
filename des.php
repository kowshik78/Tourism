<!DOCTYPE html>

<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link href="packagevendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="packageassets/css/fontawesome.css">
    <link rel="stylesheet" href="packageassets/css/templatemo-stand-blog.css">
	
	 <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600&family=Oswald:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/tooplate-antique-cafe.css">   
  
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>
<style>
body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">
<div class="">
						
						<div class="">
							
							<table><ul>
								<tr><td><a href="hotels.php"><li>Hotels</li></a></td>
								<td><a href="flights.php"><li>Flights</li></a></td>
								<td><a href="index.php"><li>Homepage</li></a></td>
								<td><a href="logout.php"><li>Logout</li></a></td></tr>

							</ul></table>
							
						</div>
						
					</div>
<div class="w3-content" style="max-width:1400px">
<header class="w3-container w3-center w3-padding-32"> 
  <h1><b>Visit NOW!</b></h1>
</header>
</div> 
			<?php
			
		    $val=$_GET["val"];
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "ghuraghuri";
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
	
			$sql = "SELECT * FROM `landmark` WHERE zone='$val' limit 1" ;
			$result = $conn->query($sql);
            $sql = "SELECT * FROM `landmark`";
			$result2 = $conn->query($sql);			

		?>

<div class="w3-row">>
<div class="w3-col l8 s12">
  <?php  while ($row = $result->fetch_assoc()) { ?>
  <div class="w3-card-4 w3-margin w3-white">
    <img src="<?php echo $row['mainImage'];?>" alt="Nature" style="width:100%">
    <div class="w3-container">
      <h3><b><?php echo $row['title']; ?></b></h3>
      <h5><?php echo $row['location']; ?></h5>
    </div>
    <div class="w3-container">
      <p><?php echo $row['details']; ?></p>
 
    </div> 
 </div><?php } ?>
</div>




<div class="w3-col l4">
  
  <div class="w3-card w3-margin">
    <div class="w3-container w3-padding">
      <h4>Famous Destinations!</h4>
    </div>
	<?php  while ($row2 = $result2->fetch_assoc()) { ?>
    <ul class="w3-ul w3-hoverable w3-white">
      <li class="w3-padding-16">
       <img src="<?php echo $row2['mainImage'];?>" alt="Image" class="w3-left w3-margin-right" style="width:50px">
        <a href="des.php?val=<?php echo $row2['zone']; ?>"
		<span class="w3-large"><?php echo $row2['title']; ?></span></a>
      </li> 
    </ul><?php } ?>
  </div>
  <hr> 
</div>
</div><br>>
</div>
</body>
</html>
