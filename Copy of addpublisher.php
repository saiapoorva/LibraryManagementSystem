<?php
include 'connection.php';


If(isset($_REQUEST['submit'])!='')
{
$sql = "INSERT INTO publisher (PubName, Address)
VALUES ('".$_REQUEST['PubName']."', '".$_REQUEST['Address']."')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

mysqli_close($conn);
?>
<form action="addpublisher.php" method="post">
  <fieldset>
    <legend>Add Publisher</legend>
    Publisher Name:<br>
    <input type="text" name="PubName" value=""><br>
    Publisher Address:<br>
    <input type="text" name="Address" value=""><br>
	
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>