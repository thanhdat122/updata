<?php 
require_once './connect.php';  
if(isset($_POST["aduser"]) && isset($_POST["adpass"]))
{
	$user = $_POST["aduser"];
	$pass = $_POST["adpass"];
	$sql ="SELECT * FROM account WHERE username = '$user' AND pwd= '$pass'";
	$rows = pg_query($sql);
	if(pg_num_rows($rows)==1) { ?>
		<script>
            alert("Login successfully!!");
        </script>
    <?php
    } else { 
        ?>
            <script>
                alert("Wrong Username/Password");
                window.location.href = "/index.php";
            </script>
        <?php }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="app.css">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>ATN SALES MANAGEMENT APPLICATION</h1>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price ($)</th>
                <th>Description</th>
                <th>Editing</th>
            </tr>

            <?php
            require_once './database.php';
            $sql = "SELECT * FROM product";
            $stmt = $pdo->prepare($sql);
            foreach ($pdo->query($sql) as $row) {
            ?>
            <tr>
                <td><?php echo $row['productid']?></td> 
                <td><?php echo $row['proname']?></td> 
                <td><?php echo $row['price']?></td> 
                <td><?php echo $row['descrip']?></td> 

                <td>
                <form action='/delete.php' method="POST">
                <input type='hidden' name='productid' value='<?php echo $row['productid']?>'>
                <input class="button1" type='submit' value='Delete'>
                </form> <br>
                <form action="/update.php" method="POST">
                <input type='hidden' name='productid' value='<?php echo $row['productid']?>'>
                <input type='hidden' name='name' value='<?php echo $row['proname']?>'>
                <input type='hidden' name='price' value='<?php echo $row['price']?>'>
                <input type='hidden' name='descrip' value='<?php echo $row['descrip']?>'>
                <input class="button1" type='submit' value='Update'>
                </form>
                </td>

            </tr>
            <?php
            }
            ?> 
        </table>

       <div style="margin-left: 600px; margin-top: 30px;" ><a href="/add.php"><button class="buttonadd">Add More</button></a></div> 
        <br><br>
    </div>
</body>

</html>