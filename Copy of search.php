



<form action="search.php" method="post">
  <fieldset>
    <legend>Add Documents</legend>
     Library Id:<br>
    <input type="text" name="LibId" value=""><br>
	<input type="submit" value="Submit" name="submit">
  </fieldset>
</form>

<?php
include 'connection.php';


If(isset($_REQUEST['submit'])!='')
{
	$sql = "SELECT `DocId`, COUNT(`CopyNo`) AS NumberOfCopy FROM `copy` WHERE `LibId` = '".$_REQUEST['LibId']."' GROUP BY `DocId` ";
	$result = mysqli_query($conn, $sql);
	echo '<table style="width:100%">';
	echo '<tr>';
    echo '<th>Documents Id</th>';
    echo '<th>Number OfCopy</th>'; 
	echo'</tr>';
	while($row = mysqli_fetch_assoc($result)) {
    echo'<tr>';
	echo '<td>';printf(" %s ", $row["DocId"]);echo '</td>';
	echo '<td>';printf(" %s ", $row["NumberOfCopy"]);echo '</td>';
	echo '</tr>';
} 
echo '</table>';
}
?>