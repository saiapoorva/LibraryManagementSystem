<!DOCTYPE html>

<?php
If(isset($_REQUEST['submit'])!='')
{
$a = $_REQUEST['y'];
for($i=2;$i<=0;$i--)
{
	echo $i;
	
}
}
?>
<script>
var y = 0;
function myFunction() {
    var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("name", 'y');
    document.body.appendChild(x);
	y++
	
}
function call(){
window.location.href = "ex.php?y=" + y;
}

</script>
<html>
<body>

<p>Click the button to create a Text Field.</p>
<form action="ex.php" method="post">
<input type="button" onclick="myFunction()">Try it</button></br>



<input type="submit" value="Submit" name="submit">
</form>
</body>
</html>
