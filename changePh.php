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
window.onload = function()
{
	if (location.search != "")
	{
		var x = location.search.substr(1).split(";")
		var y = x[0].split("&");
		var z=y[1].split("=");
		if(z[1]=="done")
		{
			alert("Your Mobile No. Has Been Updated");
		}
	}
}
function checkFields()
{
	var phno=document.addempform.newph.value;
	if(phno!="")
	{
		if(phno.length!=10 || parseFloat(phno)<0 || isNaN(parseFloat(phno)))
		{
			alert("Please Enter a Valid 10 digit Mobile Number");
			return false;
		}
		else
		{
		document.addempform.action="updatePh.php"
		return true;
		}
	}
	else
	{
		document.addempform.action="updatePh.php"
		return true;
	}
}

</script>
<meta name="GENERATOR" content="PageBreeze Free HTML Editor (http://www.pagebreeze.com)">
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" >
<title>Change Phone</title>
</head>
<body bgcolor="#ffffff">
<p align="center"><strong><font color="#004080" size="7" face="GE Inspira Pitch"><u>Update&nbsp;Phone
Page</u>
</font></strong></p>
<p align="center"><strong><font face="GE Inspira Pitch" color="#004080" size="7"><font size="4">
</font> </font></strong>&nbsp;</p>
<form name="addempform" onSubmit="return checkFields()" method=get><strong>
<p align="center">New Mobile Number
:</font>&nbsp;&nbsp; </font><input
style="WIDTH: 153px; HEIGHT: 22px" name="newph">
<p align="center"><input type="submit" value="Update" name="submit">&nbsp;&nbsp;&nbsp;<input type="reset" value=" Reset" name="reset">
<?php
$sso=$_GET['ssoid'];
$date=$_GET['date'];
$incre=$_GET['incre'];
echo "<input type='hidden' name='ssoid' value=\"".$sso."\">";
echo "<input type='hidden' name='date' value=\"".$date."\">";
echo "<input type='hidden' name='incre' value=\"".$incre."\">";
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