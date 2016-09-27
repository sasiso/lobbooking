<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: administratorLogin.html");
exit;
}
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$ssoid=$_POST['ssoid'];
$name=$_POST['empname'];
$email=$_POST['email'];
$passwd=$_POST['passwd'];
$query="select name from employee where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
if($answer[0]!=NULL)
{
	header("Location: addEmployee.html?done=false");
	exit;
}
$query="insert into employee values('".$ssoid."','".$name."','".$email."','".$passwd."','')";
$result=mysql_query($query) or die(mysql_error());
if($result == TRUE)
{
	ini_set("SMTP","localhost");
	ini_set("sendmail_from","satbirsoni@gmail.com");
	$header  = "'MIME-Version: 1.0'\r\n";
	$header = $header."From: satbirsoni@gmail.com\r\nReply-To: satbirsoni@gmail.com";
	$to = $email;
	$message = " <html>
					<head>
						<title> Registered For E-Lab Booking Facility</title>
					</head>
					<body>
					Hi <b>".$name." </b>, <br><br>".
					"&nbsp;&nbsp;&nbsp;&nbsp;You Have Been Registered to book lab equipments for yourself. You can use the following details to make a booking:<br><br>".
					"&nbsp;&nbsp;&nbsp;&nbsp;Username : <b>".$ssoid.
					"</b><br>&nbsp;&nbsp;&nbsp;&nbsp;Password : <b>".$passwd.
					"</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;Please change your password when you login for the first time. Visit <a href='http://3.235.118.106/LabBooking'>Book Lab</a> to make a booking.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;Thanks and Regards,<br>&nbsp;&nbsp;&nbsp;&nbsp;Administrator<br><br><br><b>PLEASE DO NOT REPLY - THIS IS AN UNMONITORED MAILBOX</b></body></html>";
	$subject = "Registered For Lab Booking";
	//$send_result = mail( $to, $subject, $message, $header );
	//echo $send_result ? "Mail sent" : "Mail failed";
	header("Location: addEmployee.html?done=true");
	exit;
}
else
{
	header("Location: addEmployee.html?done=false");
	exit;
}
?>