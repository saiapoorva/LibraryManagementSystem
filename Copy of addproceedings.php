<?php
include 'connection.php';


If(isset($_REQUEST['submit'])!='')
{
	$sql4 = "SELECT * FROM `branch` WHERE `LibId` = '".$_REQUEST['LibId']."'";
$result = mysqli_query($conn, $sql4);
if (mysqli_num_rows($result) > 0) {
	
	$sql = "INSERT INTO document (Title, PublisherId, PDate)
		VALUES ('".$_REQUEST['Title']."', '".$_REQUEST['PublisherId']."', '".$_REQUEST['PDate']."')";
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		$sql2 = "SELECT * FROM `document` WHERE `Title` LIKE '".$_REQUEST['Title']."'";
		$result = mysqli_query($conn, $sql2);
		if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
         $DocId = $row["DocId"]; 
		}
	
$sql1 = "INSERT INTO proceedings (CDate, CLocation, CEditor, DocId )
VALUES ('".$_REQUEST['CDate']."', '".$_REQUEST['CLocation']."', '".$_REQUEST['CEditor']."', $DocId)";

if (mysqli_query($conn, $sql1)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql3 = "INSERT INTO copy (CopyNo, DocId, LibId, Position)
VALUES ('1', $DocId, '".$_REQUEST['LibId']."', '".$_REQUEST['Position']."')";

if (mysqli_query($conn, $sql3)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
}
}
mysqli_close($conn);
?>
<form action="addproceedings.php" method="post">
  <fieldset>
    <legend>Add Proceedings</legend>
	Documents Title:<br>
    <input type="text" name="Title" value="Title"><br>
    Proceedings Date:<br>
    <input type="date" name="CDate" value=""><br>
    Proceedings Location:<br>
    <input type="text" name="CLocation" value=""><br>
	Proceedings Editor:<br>
    <input type="text" name="CEditor" value=""><br>
	Publisher Id:<br>
    <input type="text" name="PublisherId" value=""><br>
	Publishing Date:<br>
	<input type="date" name="PDate" value=""><br>
	Libarary Id:<br>
	<input type="text" name="LibId" value=""><br>
	Position in Libarary:<br>
	<input type="text" name="Position" value=""><br>
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>