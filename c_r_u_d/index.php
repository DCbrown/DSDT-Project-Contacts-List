<?php
$DB_SERVER = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'contacts';

$connect = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME);

$dangerNotice="hide";
$sucessNotice="hide";

/*  test connection
if($connect){
    echo "Conneted";
}
*/

if(isset($_POST['submit'])){
    
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            if($firstname === "" || $lastname === "" || $address === "" || $email === "" || $phone === "" ){
               
               // echo "please fill out all contact information";

                $dangerNotice = "";
                $sucessNotice="hide";

            } else {
                
                $sql = "INSERT INTO contactlist(firstname, lastname, address, email, phone)
                VALUES('$firstname','$lastname', '$address', '$email', '$phone')";

                
                if (mysqli_query($connect, $sql)) {
                   // echo "New record created successfully";
                    $dangerNotice = "hide";
                    $sucessNotice=""; 
                } else {
                    echo "Error:" . $sql . "<br>" . mysqli_error($connect); 
                }
                

        }
}

$sql2 = "SELECT * FROM contactlist";
$result = mysqli_query($connect, $sql2);

/*
if($result){
	echo "Reading from the database"; 
}else{
	echo "Error:" . $sql2 . "<br>" . mysqli_error($connect); 
}
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Contact's List</title>
</head>
<body>
<div class="conatiner">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <h1 class="text-center">Contacts Lists</h1>
        <ul id="myTab" class="nav nav-tabs">
   <li class = "active"><a href="#addContact" data-toggle = "tab">Add Contact</a></li>
   <li><a href="#myContact" data-toggle = "tab">My Contact</a></li>
</ul>
<div id="myTabContent" class="tab-content">
   <div class = "tab-pane fade in active" id = "addContact">
   <div class="alert alert-danger <?php echo $dangerNotice; ?>">
        <strong>Error!</strong> Please complete all fields before submitting.
   </div>
   <div class="alert alert-success <?php echo $sucessNotice; ?>">
         contact saved.
    </div>
   <form action="index.php" method="post">
        <label>First Name:</label>
        <input type="text" class="form-control" name="firstname">
        <br>
        <label>Last Name:</label>
        <input type="text" class="form-control" name="lastname">
        <br>
        <label>Address:</label>
        <input type="text" class="form-control" name="address">
        <br>
        <label>Email:</label>
        <input type="text" class="form-control" name="email">
        <br>
        <label>Phone:</label>
        <input type="text" class="form-control" name="phone">
        <br>
        <input type="Submit" class="btn btn-primary" value="submit" name="submit">   
    </form>
   </div>
   
   <div class="tab-pane fade" id="myContact">
   <?php
   if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo  " <hr><b>Name:</b> " . $row["firstname"] ." ". $row["lastname"]. "<br><b>Address:</b>" . $row["address"]. "<br><b>Email:</b>" .$row["email"]. "<br> <b>Phone:</b>" . $row["phone"]."";
        }
    }
    ?>
    </div>

        </div>
    </div>   
</div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $('#myTab a').click(function (e) {
         e.preventDefault()
            $(this).tab('show')
        });
    </script>
</body>
</html>