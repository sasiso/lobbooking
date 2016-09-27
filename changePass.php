<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: index.html");
exit;
}
?>
<html>
<head>
<script type="text/javascript">
function checkFields()
{
	if(document.addempform.oldpasswd.value=="")
	{
		alert("Please enter a valid old Password");
		return false;
	}
	else if(document.addempform.newpasswd.value=="")
	{
		alert("Please enter a valid new Password");
		return false;
	}
	else
	{
	document.addempform.action="updatePassword.php"
	return true;
	}
}
</script>	
<meta name="GENERATOR" content="PageBreeze Free HTML Editor (http://www.pagebreeze.com)">
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" >
<title>Change Password</title>
</head>
<body bgcolor="#ffffff">
<p align="center"><strong><font color="#004080" size="7" face="GE Inspira Pitch"><u>Update&nbsp;Password 
Page</u>  
</font></strong></p>
<p align="center"><strong><font face="GE Inspira Pitch" color="#004080" size="7"><font size="4"> 
</font> </font></strong>&nbsp;</p>
<form name="addempform" onSubmit="return checkFields()" method="post"><strong><font face="GE Inspira Pitch" color="#004080" size="7"><font face="GE Inspira Pitch" size="4">
<p align="center"><strong><font face="GE Inspira Pitch" color="#004080" size="7"><font face="GE Inspira Pitch" size="4">Old Password&nbsp;</font>&nbsp;&nbsp;</font><input 
style="WIDTH: 153px; HEIGHT: 22px" name="oldpasswd" type=password></strong></p>
<p align="center">New Password 
:</font>&nbsp;&nbsp; </font><input 
style="WIDTH: 153px; HEIGHT: 22px" name="newpasswd" type=password>
<p align="center"><input type="submit" value="Update" name="submit">&nbsp;&nbsp;&nbsp;<input type="reset" value=" Reset" name="reset">
<?php
$sso=$_GET['ssoid'];
$date=$_GET['date'];
$incre=$_GET['incre'];
echo "<input type='hidden' name='ssoid' value=\"".$sso."\">";
?>
</form></p></font></strong>
<?php
$sso=$_GET['ssoid'];
echo "<a href=\"BookingPage.php?ssoid=".$sso."&booking=notdone&incre=".$incre."&date=".$date."\">";
?>
<center><font face="ge inspira pitch" color=black size=5>
<<--Back
</center></a></font>
</body>
</html>