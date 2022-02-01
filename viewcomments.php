<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
<head>
						
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
					
</head>
<div class="panel panel-default">
<div class="panel-heading">Submit Your Comments</div>
  <div class="panel-body">
  	<form method="post">
  	  <div class="form-group">
	    <label for="exampleInputEmail1">Name</label>
	    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name" required="required">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Email address</label>
	    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required="required">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Subject</label>
	    <textarea name="subject" class="form-control" rows="3" required="required"></textarea>
	  </div>
	  <button type="submit" class="btn btn-primary" onclick="return mess();">Submit</button>
	</form>
  </div>
</div>
<script type="text/javascript">
function mess()
{
	 alert("Recorded successfully");
	 return true;
}
</script>


<?php
	$connection = mysqli_connect('localhost', 'root', '', 'ghuraghuri');
    $hotelID=$_GET["hotelId"];
	if(isset($_POST) & !empty($_POST)){
	$name = mysqli_real_escape_string($connection, $_POST['name']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$subject = mysqli_real_escape_string($connection, $_POST['subject']);
	

	$isql = "INSERT INTO comments (name, email, subject, hotelId) VALUES ('$name', '$email', '$subject', '$hotelID')";
	$ires = mysqli_query($connection, $isql) or die(mysqli_error($connection));
	if($ires){
		header("Location:viewcomments.php");
		exit;
	}else{
		$fmsg = "Failed to Submit Your Comment";
	}
}

$sql = "SELECT * FROM comments WHERE hotelId='$hotelID'";
$res = mysqli_query($connection, $sql);
?>
	
<section>
  <h1>Comments</h1>
    <div class="container">
        
	<?php	  while ( $r = mysqli_fetch_assoc($res)) {?>
            <div class="col-sm-5 col-md-6 col-12 pb-4">
              
				
                <div class="comment mt-4 text-justify float-left"> 
                    
                    <tr><td><img src="images\favicon.ico" class="rounded-circle" width="40" height="40"></td>
                    <td><h1 style="color:green;"><?php echo $r['name']; ?></h1></td></tr>
                     <table></table>
                    <tr><h3>>>><?php echo $r['subject']; ?></h3></tr>
                </div>
				<br></br>
            </div>
			<?php } error_reporting(0);?>
        
    </div>
</section>