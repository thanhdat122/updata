<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <title>Add</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div>
        
        <?php 
        require("connect.php");   
        if(isset($_POST["submit"]))
            {
                $name = $_POST["proname"];
                $price = $_POST["price"];
                $descrip = $_POST["descrip"];
                if ($name == ""||$price == ""|| $descrip == "") 
                    {
                        ?>
                        <script>
                            alert("Product information should not be blank!!");
                        </script>
                        <?php
                    }
                else
                    {
                        $sql = "select * from product where proname='$name'";
                        $query = pg_query($conn, $sql);
                        if(pg_num_rows($query)>0)
                        {
                        ?> 
                            <script>
                                alert("The product is available!!");
                            </script>
                        <?php
                        }
                        else
                        {
                            $sql = "INSERT INTO product(proname, price, descrip) VALUES ('$name','$price','$descrip')";
                            pg_query($conn,$sql);
                            ?> 
                                <script>
                                    alert("Added successful!");
                                    window.location.href = "/managing.php";
                                </script>
                            <?php
                        }
                    }
            }
            ?>
       <div style="margin-left: 300px;" class="container borderadd" >
        <h2>Adding Product Form</h2>
        <p>Fill out the product information here:</p>
        <form>
        <div class="form-group">
        <label for="usr">Name:</label><br>
        <input type="text" name="proname" placeholder="Name"> 
        </div>
        <div class="form-group">
        <label for="pwd">Price:</label><br>
        <input type="text" name="price" placeholder="Price"> 
        </div>
        <div class="form-group">
        <label for="pwd">Description:</label><br>
        <input type="text" name="descrip" placeholder="Description"><br>
        <button type="submit" value="Add" name="submit">Add</button>
        </div>
        </form>
        <button><a href="/managing.php">Back</a></button>
        </div>
    </div>
</body>

</html>