<?php
include 'connection.php';

If(isset($_REQUEST['submit'])!='')
{
$sql1 = "SELECT * FROM `author` WHERE `AName` LIKE '".$_REQUEST['AName']."'";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         $AuthorId = $row['AuthorId']; 
    }
	
 $sql5 = "SELECT * FROM `branch` WHERE `LibId` = '".$_REQUEST['LibId']."'";
$result = mysqli_query($conn, $sql5);
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
	$sql3 = "INSERT INTO book (ISBN, DocId)
VALUES ('".$_REQUEST['ISBN']."', $DocId)";

if (mysqli_query($conn, $sql3)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


$sql4 = "INSERT INTO writes (AuthorId, DocId)
VALUES ($AuthorId, $DocId)";

if (mysqli_query($conn, $sql4)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql6 = "INSERT INTO copy (CopyNo, DocId, LibId, Position)
VALUES ('1', $DocId, '".$_REQUEST['LibId']."', '".$_REQUEST['Position']."')";

if (mysqli_query($conn, $sql6)) {
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
<form action="addbook.php" method="post">
  <fieldset>
    <legend>Add Documents</legend>
    Documents Title:<br>
    <input type="text" name="Title" value="Title"><br>
	Author Name:<br>
    <input type="text" name="AName" value=""><br>
	Book ISBN Number:<br>
    <input type="text" name="ISBN" value=""><br>
    Publisher Id:<br>
    <input type="text" name="PublisherId" value=""><br>
	Publishing Date:<br>
	<input type="date" name="PDate" value=""><br>
	Libarary Id:<br>
	<input type="text" name="LibId" value=""><br>
	Position in Libarary:<br>
	<input type="text" name="Position" value=""><br>
	<br>
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>