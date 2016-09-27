<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: administratorLogin.html");
exit;
}
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$oldsso=$_POST['oldsso'];
$newsso=$_POST['ssoid'];
$newname=$_POST['empname'];
$newmail=$_POST['email'];
$query="update employee set ssoid='".$newsso."',name='".$newname."',email='".$newmail."' where ssoid='".$oldsso."'";
echo $query;
$result=mysql_query($query) or die(mysql_error());
$query="update booking set ssoid='".$newsso."' where ssoid='".$oldsso."'";
$result=mysql_query($query) or die(mysql_error());
if($result == TRUE)
{
	header("Location: updEmployee.html?done=true");
	exit;
}
else
{
	header("Location: updEmployee.html?done=false");
	exit;
}
?>