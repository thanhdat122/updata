<?php
require("connect.php");

$id = $_POST['productid'];
if (isset($_POST['update'])) {
	$name = $_POST["proname"];
    $price = $_POST["price"];
	$descrip = $_POST["descrip"];
	if ($name == ""||$price == ""|| $descrip == "") {
    ?>
		<script>
			alert("Product information should not be blank!!");
		</script>
		<?php
    } else {
		$sql = "select * from product where proname='$name'";
		$query = pg_query($conn, $sql);
		if(pg_num_rows($query)>0) {
		?> 
			<script>
				alert("The product is available!!");
			</script>
		<?php
		} else {
			$sql = "UPDATE product SET proname='$name', price='$price', descrip='$descrip' WHERE productid='$id'";
			$run = pg_query($conn, $sql);
			if ($run) { ?>
			<script type="text/javascript">
					alert ("Update info successfully!!");
					window.location.href = "/managing.php";
			</script>
			<?php 
			} else { ?>
			<script type="text/javascript">
					alert ("Update product failed!!");
					window.location.href = "/managing.php";
			</script>
			<?php } 
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
    <title>Update</title>
</head>

<body>
    <div>
        
        <form action="/update.php" method="POST">
			<?php
			$qry = "SELECT * FROM product WHERE productid = '$id'";
			$result = pg_query($conn, $qry);
			$row = pg_fetch_row($result);
			?>
			
			<div class="container">
		  	<h2>Update Information</h2>
		  	<p>Fill out the product information here:</p>
		  	
		  	<input type="hidden" name="productid" value="<?= $row[0] ?>">
		    <div class="form-group">
		      <label for="usr">Name:</label><br>
		      <input type="text" name="proname" value="<?= $row[1] ?>">
		    </div>
		    <div class="form-group">
		      <label for="pwd">Price:</label><br>
		      <input type="text" name="price" value="<?= $row[2] ?>">
		    </div>
		    <div class="form-group">
		      <label for="pwd">Description:</label><br>
		      <input type="text" name="descrip" value="<?= $row[3] ?>">
		    </div>
		  	<input type="submit" name="update" value="Update">
			</div>

		</form>
                <button style="margin-left: 200px;"><a href="/managing.php">Back</a></button>
		<br><br>
    </div>
</body>

</html>