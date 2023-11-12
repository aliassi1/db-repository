<?php
if (isset($_POST["tripID"])) {
  $selectedTripID = $_POST["tripID"];
  setcookie("tripID", $selectedTripID, time() + 600, "/");
  header("Location: index.php");
  
}
// this code is to check if the image was pressed
//if it was the code will set the tripID as a cookie to be further used in the code
//and will take us to the index.php file
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="format.css">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>
<?php
include('database.php');
$sql = "SELECT picture, tripID FROM trip";
$result = mysqli_query($conn, $sql);
// includes the db and sends a query to get the pictures and tripID from table trip

while ($row = mysqli_fetch_assoc($result)) {
    $image = $row['picture'];
    $tripID = $row['tripID'];
   

    echo '<form action="front.php" method="post">
    <input type="hidden" name="tripID" value="' . $tripID . '">
    <input type="image" alt="Clickable Image"" src="data:image/jpg;base64,' . base64_encode($image) . '"
     class="images">
     
  </form>
  <form action="front.php" method="post">
  <input type="submit"  class="button" value="delete" name="delete">
  <input type="hidden" 
  name="delete_tripID" value="' . $tripID . '"
  >
    </form>';
  

}
//creates images and delete buttons for each row found in the db 

if(isset($_POST["delete"])){
  $triptodelete=$_POST['delete_tripID'];
  $sql_delete_review = "DELETE FROM review WHERE fk_tripID = {$triptodelete}";
  mysqli_query($conn, $sql_delete_review);
  $sql="DELETE FROM trip
  WHERE tripID={$triptodelete}";
 mysqli_query($conn,$sql);
 
}
// if the delete button is pressed the trip will be deleted from the db
?>




<?php

var_dump($_POST); // Debugging statement

/*elseif(isset($_POST["image2"])){
  $tripID=2;
  setcookie("tripID",$tripID, time() + 600,"/");
  header("Location: index.php");
  
}
elseif(isset($_POST["image3"])){
  $tripID=3;
  setcookie("tripID",$tripID, time() + 600,"/");
  header("Location: index.php");
  
}
elseif(isset($_POST["image4"])){
  $tripID=4;
  setcookie("tripID",$tripID, time() + 600,"/");
  header("Location: index.php");
  
}
elseif(isset($_POST["image5"])){
  $tripID=5;
  setcookie("tripID",$tripID, time() + 600,"/");
  header("Location: index.php");
  
}*/




?>