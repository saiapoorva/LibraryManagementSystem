<form action="borrow.php" method="post">
  <fieldset>
    <legend>Add Proceedings</legend>
	Documents Id:<br>
    <input type="text" name="DocId" value=""><br>
    Libarary Id:<br>
    <input type="date" name="LibId" value=""><br>
	Document Copy Number:<br>
    <input type="date" name="CopyNo" value=""><br>
	Reader Id:<br>
    <input type="date" name="ReaderId" value=""><br>
    <input type="submit" value="Submit" name="submit">
  </fieldset>
</form>
<?php

include 'connection.php';
$BorDateTime = date("Y-m-d");
$DueDate = date('Y-m-d', strtotime("+20 days"));
echo $BorDateTime;
echo $DueDate;
$a = strtotime("+20 days");
If(isset($_REQUEST['submit'])!='')
{
	//$BorDateTime = date('Y-m-d');
	//$RetDateTime = date('Y-m-d', strtotime("+20 days"));
	$sql1 = "SELECT * FROM `copy` WHERE `DocId` = '".$_REQUEST['DocId']."' AND `LibId` = '".$_REQUEST['LibId']."' AND `CopyNo` = '".$_REQUEST['CopyNo']."' ";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
         $Status = $row['Status'];
		 }
		 
		 if ($Status == 'Available')
	     {
			 $sql2 = "SELECT `ReaderId`, COUNT(`BorNumber`) AS Total_Borrowed FROM `bor_transaction` WHERE `ReaderId` = '".$_REQUEST['ReaderId']."' GROUP BY `ReaderId` ";
			 $result = mysqli_query($conn, $sql2);
			 while($row = mysqli_fetch_assoc($result)) {
			 $Total_Borrowed = $row["Total_Borrowed"];
			 }
			if ($Total_Borrowed < '11'){
		$sql5 = "SELECT * FROM `reader` WHERE `ReaderId` = '".$_REQUEST['ReaderId']."'";
		$result = mysqli_query($conn, $sql5);
		if (mysqli_num_rows($result) > 0) {
	
		$sql6 = "INSERT INTO bor_transaction (BorDateTime, DueDate, DocId, ReaderId, LibId, CopyNo)
		VALUES (STR_TO_DATE('$BorDateTime', '%Y-%m-%d'), STR_TO_DATE('$DueDate', '%Y-%m-%d'), '".$_REQUEST['DocId']."', '".$_REQUEST['ReaderId']."', '".$_REQUEST['LibId']."', '".$_REQUEST['CopyNo']."')";

		if (mysqli_query($conn, $sql6)) {
		echo "New record created successfully";
		} else {
		echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
		}

		$sql = "UPDATE `copy` SET `Status` = 'Borrowed' WHERE `DocId` = '".$_REQUEST['DocId']."' AND `LibId` = '".$_REQUEST['LibId']."' AND `CopyNo` = '".$_REQUEST['CopyNo']."' ";

		if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
		} else {
		echo "Error updating record: " . $conn->error;
		}
		}
		 }
		 else{
		 echo 'Reader Allready Borrowed or Reserved 10 Books.';
		 }
		 }
		else{
			echo 'Document is not Available Now..';
		}
		
}
}
?>