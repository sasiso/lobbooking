<?php
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");

/*clean DB part*/
$date=date('Y-m-d');
$query="delete from booking where dateofbooking<'".$date."'";
$result=mysql_query($query) or die(mysql_error());

$loginId=$_POST['loginid'];
$passwrd=$_POST['passwd'];
session_start();
$query="select password from employee where ssoid='".$loginId."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
if($answer[0]==NULL)
{
	header("Location: index.html?validated=false");
	exit;
}
else if($answer[0]==$passwrd) 
{
	$_SESSION["loggedin"] = "An invader from another planet.";
	header("Location: BookingPage.php?ssoid=".$loginId."&booking=notdone&incre=0"."&date=".$date);
	exit;
}
else
{
	header("Location: index.html?validated=false");
	exit;
}
?>