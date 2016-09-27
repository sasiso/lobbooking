<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: administratorLogin.html");
exit;
}
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$equipid=$_POST['equipid'];
$equipname=$_POST['equipname'];
$desc=$_POST['desc'];
$query="update equipment set equipname='".$equipname."',description='".$desc."' where equipId='".$equipid."'";
echo $query;
$result=mysql_query($query) or die(mysql_error());
if($result == TRUE)
{
	header("Location: updEquipment.html?done=true");
	exit;
}
else
{
	header("Location: updEquipment.html?done=false");
	exit;
}
?>