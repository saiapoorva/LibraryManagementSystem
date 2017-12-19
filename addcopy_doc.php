<?php
include 'connection.php';


If(isset($_REQUEST['submit'])!='')
{
	$sql1 = "SELECT * FROM `document` WHERE `DocId` = '".$_REQUEST['DocId']."' ";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         $DocId = $row['DocId'];
		 $CopyNo = $row['NumberOfCopies']+1;
    }
	
 $sql5 = "SELECT * FROM `branch` WHERE `LibId` = '".$_REQUEST['LibId']."'";
$result = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result) > 0) {
	
	$sql6 = "INSERT INTO copy (CopyNo, DocId, LibId, Position)
VALUES ($CopyNo, $DocId, '".$_REQUEST['LibId']."', '".$_REQUEST['Position']."')";

if (mysqli_query($conn, $sql6)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "UPDATE `document` SET `NumberOfCopies` = $CopyNo WHERE `DocId` = '".$_REQUEST['DocId']."'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

}
}
}
?>

<form action="addcopy_doc.php" method="post">
  <fieldset>
    <legend>Add Proceedings</legend>
	Documents Id:<br>
    <input type="text" name="DocId" value=""><br>
    Libarary Id:<br>
    <input type="date" name="LibId" value=""><br>
	Position in Libarary:<br>
	<input type="text" name="Position" value=""><br>
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>