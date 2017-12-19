<form action="return.php" method="post">
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
If(isset($_REQUEST['submit'])!='')
{
	$DueDate = date("Y-m-d");
	$sql1 = "SELECT * FROM `bor_transaction` WHERE `DocId` = '".$_REQUEST['DocId']."' AND `LibId` = '".$_REQUEST['LibId']."' AND `CopyNo` = '".$_REQUEST['CopyNo']."' AND `ReaderId` = '".$_REQUEST['ReaderId']."' ";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
         $BorDateTime = $row["BorDateTime"];
		 $DueDate = $row["DueDate"];
		 echo $row["DueDate"];
		 echo  $row["BorDateTime"];
    }
	
	$date1=date_create("$DueDate");
	$date2=date_create(date("Y-m-d"));
	$diff=date_diff($date1,$date2);
	$a = $diff->format("%a");
	
	if($BorDateTime != date("Y-m-d") )
	{
		
	$RetDateTime  = date("Y-m-d");
     if($DueDate <  $RetDateTime )
	 {
		 echo 'yes';
		 echo $a.'</br>';
		 $fine = $a * 0.30;
		 echo $fine;
		 
		$sql = "UPDATE `bor_transaction` SET `FineAmount` = $fine, RetDateTime  = STR_TO_DATE('$RetDateTime ', '%Y-%m-%d') WHERE `DocId` = '".$_REQUEST['DocId']."' AND LibId = '".$_REQUEST['LibId']."' AND `CopyNo` = '".$_REQUEST['CopyNo']."' AND `ReaderId` = '".$_REQUEST['ReaderId']."'";

		if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
		} else {
		echo "Error updating record: " . $conn->error;
		}
	 }
	 else{
		 echo 'no';
		 $sql = "UPDATE `bor_transaction` SET `FineAmount` = '0', RetDateTime  = STR_TO_DATE('$RetDateTime ', '%Y-%m-%d') WHERE `DocId` = '".$_REQUEST['DocId']."' AND LibId = '".$_REQUEST['LibId']."' AND `CopyNo` = '".$_REQUEST['CopyNo']."' AND `ReaderId` = '".$_REQUEST['ReaderId']."'";

		 if ($conn->query($sql) === TRUE) {
		 echo "Record updated successfully";
		 } else {
         echo "Error updating record: " . $conn->error;
		 }
		 
	 }
	$sql = "UPDATE `copy` SET `Status` = 'Available' WHERE `DocId` = '".$_REQUEST['DocId']."' AND `LibId` = '".$_REQUEST['LibId']."' AND `CopyNo` = '".$_REQUEST['CopyNo']."' ";

		if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
		} else {
		echo "Error updating record: " . $conn->error;
		}
	}
	
	else {
		echo 'cannot returned';
	}
	}
}


?>