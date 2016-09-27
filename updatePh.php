<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: index.html");
exit;
}
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$ssoid=$_GET['ssoid'];
echo $ssoid;
$newph=$_GET['newph'];
$date=$_GET['date'];
$incre=$_GET['incre'];
$query="update employee set mobno = '".$newph."' where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
header("Location: changePh.php?ssoid=".$ssoid."&updated=done&incre=".$incre."&date=".$date);
//exit;
?>