<?php
include 'connection.php';


If(isset($_REQUEST['submit'])!='')
{
	$sql1 = "SELECT * FROM `journal_issue` WHERE `DocId` = '".$_REQUEST['DocId']."' AND `VolumeNo` = '".$_REQUEST['VolumeNo']."' AND `IssueNo` = '".$_REQUEST['IssueNo']."' ";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         $DocId = $row['DocId'];
		 $VolumeNo = $row['VolumeNo'];
		 $IssueNo = $row['IssueNo'];
		 $CopyNo = $row['NumberOfCopy']+1;
    }
	
 $sql5 = "SELECT * FROM `branch` WHERE `LibId` = '".$_REQUEST['LibId']."'";
$result = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result) > 0) {
	
	$sql6 = "INSERT INTO journal_copy (CopyNo, DocId, VolumeNo, IssueNo, LibId, Position)
VALUES ($CopyNo, $DocId, $VolumeNo, $IssueNo, '".$_REQUEST['LibId']."', '".$_REQUEST['Position']."')";

if (mysqli_query($conn, $sql6)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
}

$sql = "UPDATE `journal_issue` SET `NumberOfCopy` = $CopyNo WHERE `DocId` = '".$_REQUEST['DocId']."'  AND `VolumeNo` = '".$_REQUEST['VolumeNo']."' AND `IssueNo` = '".$_REQUEST['IssueNo']."' ";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

}
}
}
?>

<form action="addjournal_copy.php" method="post">
  <fieldset>
    <legend>Add Proceedings</legend>
	Documents Id:<br>
    <input type="text" name="DocId" value=""><br>
	Journal Volume Number:<br>
    <input type="text" name="VolumeNo" value=""><br>
	Journal Issue Number:<br>
    <input type="text" name="IssueNo" value=""><br>
    Libarary Id:<br>
    <input type="date" name="LibId" value=""><br>
	Position in Libarary:<br>
	<input type="text" name="Position" value=""><br>
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>