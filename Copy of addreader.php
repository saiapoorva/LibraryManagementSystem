<?php
include 'connection.php';

/*$Title = echo $_POST["Title"];
$PublisherId = echo $_POST["PublisherId"];
$PDate = echo $_POST["PDate"]; */
If(isset($_REQUEST['submit'])!='')
{
$sql = "INSERT INTO reader (ReaderName, Type, Address, PhoneNum)
VALUES ('".$_REQUEST['ReaderName']."', '".$_REQUEST['Type']."', '".$_REQUEST['Address']."', '".$_REQUEST['PhoneNum']."')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

mysqli_close($conn);
?>
<form action="addreader.php" method="post">
  <fieldset>
    <legend>Add Documents</legend>
    Reader Name:<br>
    <input type="text" name="ReaderName" value=""><br>
	Reader Type:<br>
	<select name="Type">
  <option value="student">student</option>
  <option value="lecturer">lecturer</option>
  <option value="staff">staff</option>
  <option value="senior citizen">senior citizen</option>
  <option value="other">other</option>
   </select>
    Address:<br>
    <input type="text" name="Address" value=""><br>
	Phone Number:<br>
	<input type="number" name="PhoneNum" value=""><br>
	<br>
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>