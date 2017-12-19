<?php
include 'connection.php';

/*$Title = echo $_POST["Title"];
$PublisherId = echo $_POST["PublisherId"];
$PDate = echo $_POST["PDate"]; */
If(isset($_REQUEST['submit'])!='')
{
	
	$sql1 = "SELECT * FROM `chief_editor` WHERE `Ename` LIKE '".$_REQUEST['Ename']."'";
	$result = mysqli_query($conn, $sql1);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
         $EditorId = $row['EditorId']; 
		}
		$sql2 = "SELECT * FROM `branch` WHERE `LibId` = '".$_REQUEST['LibId']."'";
$result = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result) > 0) {
 
		$sql = "INSERT INTO document (Title, PublisherId, PDate) 
		VALUES ('".$_REQUEST['Title']."', '".$_REQUEST['PublisherId']."', '".$_REQUEST['PDate']."')";
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		$sql3 = "SELECT * FROM `document` WHERE `Title` LIKE '".$_REQUEST['Title']."'";
		$result = mysqli_query($conn, $sql3);
		if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
         $DocId = $row["DocId"]; 
		}
	
		$sql4 = "INSERT INTO journal_volume (VolumeNo, DocId, EditorId)
		VALUES ('".$_REQUEST['VolumeNo']."', $DocId, $EditorId)";

			if (mysqli_query($conn, $sql4)) {
			echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}

		$sql5 = "INSERT INTO journal_issue (IssueNo, VolumeNo, DocId, Scope)
		VALUES ('".$_REQUEST['IssueNo']."', '".$_REQUEST['VolumeNo']."', $DocId, '".$_REQUEST['Scope']."')";

		if (mysqli_query($conn, $sql5)) {
		echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}

		$sql6 = "INSERT INTO ieditors (IEName, IssueNo, VolumeNo, DocId)
		VALUES ('".$_REQUEST['IEName']."', '".$_REQUEST['IssueNo']."', '".$_REQUEST['VolumeNo']."', $DocId)";

		if (mysqli_query($conn, $sql6)) {
		echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
		
		$sql7 = "INSERT INTO journal_copy (CopyNo, DocId, VolumeNo, IssueNo, LibId, Position)
		VALUES ('1', $DocId, '".$_REQUEST['VolumeNo']."', '".$_REQUEST['IssueNo']."', '".$_REQUEST['LibId']."', '".$_REQUEST['Position']."')";
		if (mysqli_query($conn, $sql7)) {
		echo "New record created successfully";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
				

}
}	
}
}
mysqli_close($conn);
?>
<form action="addjournal.php" method="post">
  <fieldset>
    <legend>Add Documents</legend>
    Journal Title:<br>
    <input type="text" name="Title" value=""><br>
	Journal Volume Number:<br>
    <input type="number" name="VolumeNo" value=""><br>
	Journal Editor:<br>
    <input type="text" name="Ename" value=""><br>
	Journal Volume Issue Number:<br>
    <input type="number" name="IssueNo" value=""><br>
	Journal Issue Scope:<br>
    <input type="number" name="Scope" value=""><br>
	Journal IEditor:<br>
    <input type="text" name="IEName" value=""><br>
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