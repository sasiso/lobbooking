<html>
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
			//alert("Thanks For the Booking. An Email has been sent to you with all details");
			alert("Your Booking/Cancellation has Been Done");
		}
	}
}
</script>
<?php
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$sso=$_GET['ssoid'];
$date=$_GET['date'];
$incre=$_GET['incre'];
$query="select name from employee where ssoid='".$sso."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
echo "<title>Welcome ".$answer[0]."</title>";
echo "<table align=center width=100%><tr><td><p align=left><font face='ge inspira pitch' size=5 color=grey>Welcome <font face='ge inspira pitch' size=6 color=green>".$answer[0]."</font></p></td>";
echo "<td><p align=right><font face='ge inspira pitch' size=4 color=blue><a href=\"changePh.php?ssoid=".$sso."&incre=".$incre."&updated=notdone&date=".$date."\">Change Mobile Number</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"changePass.php?ssoid=".$sso."&incre=".$incre."&date=".$date."\">Change Password</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='logout.php'>Logout</a></font></p></table>";

echo "<p align=center><font face='ge inspira pitch' size=4 color=red>Please re-try if booking is not effective, since this tool is used simultaneously by many users.</font></p>";
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: index.html");
exit;
}
$prevDisabled=false;
$prevWeekDisabled=false;
$nextDisabled=false;
$nextWeekDisabled=false;
if($incre<7)
{
	$prevWeekDisabled=true;
}
if($incre==0)
{
	$prevDisabled=true;
}
if($incre==28)
{
	$nextDisabled=true;
}
if($incre>21)
{
	$nextWeekDisabled=true;
}
$nextDate=date('Y-m-d',strtotime('+'.($incre+1).' Day'));
$prevDate=date('Y-m-d',strtotime('+'.($incre-1).' Day'));
$nextWeekDate=date('Y-m-d',strtotime('+'.($incre+7).' Day'));
$prevWeekDate=date('Y-m-d',strtotime('+'.($incre-7).' Day'));
$dateformatted=$date;
$t=strtotime($date);
$date=date('d-F-y',$t);
$wkNo = getFiscalWeek(date('Y',$t),date('m',$t),date('d',$t));
$day = date('l',$t);
echo "<table border=0 align=center cellspacing=20 width=100%><tr>";

echo "<form name=prevweekform action=BookingPage.php><input type=hidden name=ssoid value='".$sso."'/><input type=hidden name=booking value='notdone'/><input type=hidden name=date value='".$prevWeekDate."'/><input type=hidden name=incre value='".($incre-7)."'/>";
if($prevWeekDisabled==true)
{
	echo"<td><input type=submit value='Previous Week' disabled=disabled/></td>";
}
else
{
	echo "<td><input type=submit value='Previous Week'/></td>";
}
echo "</form>";
echo "<form name=prevdateform action=BookingPage.php><input type=hidden name=ssoid value='".$sso."'/><input type=hidden name=booking value='notdone'/><input type=hidden name=date value='".$prevDate."'/><input type=hidden name=incre value='".($incre-1)."'/>";
if($prevDisabled==true)
{
	echo"<td><input type=submit value='Previous Date' disabled=disabled/></td>";
}
else
{
	echo "<td><input type=submit value='Previous Date'/></td>";
}
echo "<td></form><font face='ge inspira pitch' size=5 color=blue align=center>".$date."&nbsp;&nbsp;&nbsp;".$day."&nbsp;&nbsp;&nbsp;Week-<b>".$wkNo."</b></font></td>";

echo "<form name=nextdateform action=BookingPage.php><input type=hidden name=ssoid value='".$sso."'/><input type=hidden name=booking value='notdone'/><input type=hidden name=date value='".$nextDate."'/><input type=hidden name=incre value='".($incre+1)."'/>";
if($nextDisabled==true)
{
	echo"<td><input type=submit value='Next Date' disabled=disabled/>";
}
else
{
echo "<td><input type=submit value='Next Date'/>";
}
echo"</form></td>";

echo "<form name=nextweekform action=BookingPage.php><input type=hidden name=ssoid value='".$sso."'/><input type=hidden name=booking value='notdone'/><input type=hidden name=date value='".$nextWeekDate."'/><input type=hidden name=incre value='".($incre+7)."'/>";
if($nextWeekDisabled==true)
{
	echo"<td><input type=submit value='Next Week' disabled=disabled/></td>";
}
else
{
	echo "<td><input type=submit value='Next Week'/></td>";
}
echo "</form></table>";
echo"<br><br><table align=center border=2 cellpadding=10 cellspacing=10 ><tr>";
echo "<th><font face='ge inspira pitch' size=4>Equipment\Slots</th>";
$query="select equipname,description from equipment";
$result=mysql_query($query) or die(mysql_error());
$equipmentName=mysql_fetch_row($result);
$equip=array();
$equipDesc=array();
$i=0;
$arrayOfSlots=array("9am-11am","11am-1pm","1pm-3pm","3pm-5pm","5pm-7pm","7pm-9pm","9pm-9am");
while($equipmentName!=NULL)
{
	$equip[$i]=$equipmentName[0];
	$equipDesc[$i]=$equipmentName[1];
	$equipmentName=mysql_fetch_row($result);
	$i++;
}
foreach($arrayOfSlots as $slot)
{
	echo "<th><font face='ge inspira pitch' size=4>".$slot."</th>";
}
echo "</tr>";
echo "<form name=bookingform action=bookReq.php>";
echo "<input type=hidden name=ssoid value='".$sso."'/><input type=hidden name=date value='".$dateformatted."'/><input type=hidden name=incre value='".$incre."'/>";
$descI=0;
foreach ($equip as $equipInArray)
{
	$i=0;
	echo "<tr><th><font face='ge inspira pitch' size=4>".$equipInArray."-".$equipDesc[$descI]."</th>";
	foreach($arrayOfSlots as $slot)
	{
		echo "<td>";
		$query="select equipId from equipment where equipname='".$equipInArray."'";
		$result=mysql_query($query) or die(mysql_error());
		$equipid=mysql_fetch_row($result);
		$query="select ssoid from booking where dateofbooking='".$dateformatted."' and equipId='".$equipid[0]."' and timeslot='".$i."'";
		$result=mysql_query($query) or die(mysql_error());
		$answer=mysql_fetch_row($result);
		echo "<table align=center border=1 cellpadding=5 width=100% bgcolor=white><tr><th bgcolor=white>Booked By</th><th bgcolor=white>Book</th><th bgcolor=white>Cancel</th></tr><tr>";
		$flag=0;
		if($answer[0]!=NULL)
		{
			$query="select name,mobno from employee where ssoid='".$answer[0]."'";
			$result=mysql_query($query) or die(mysql_error());
			$name=mysql_fetch_row($result);
			echo "<td align=center bgcolor=red><font face='ge inspira pitch' size=3 color=black>".$name[0]."-".$answer[0]."-".$name[1]."</font>";
			$flag=1;
		}
		else
		{
			echo "<td align=center bgcolor=green><font face='ge inspira pitch' size=3 color=white>-</font>";
		}
		echo "</td>";
		echo "<td align=center>";
		if($flag==1)
		{
			echo "<input disabled=true type=checkbox name=".$equipid[0]."-".($i+1).">";
		}
		else
		{
			echo "<input type=checkbox name=".$equipid[0]."-".($i+1).">";
		}
		echo"</td><td align=center>";
		if($flag==1 && $sso==$answer[0])
		{
			echo "<input type=checkbox name=".$equipid[0]."-".($i+8).">";
		}
		else
		{
			echo "<input disabled=true type=checkbox name=".$equipid[0]."-".($i+8).">";
		}
		echo "</td></tr></table>";
		echo "</td>";
		$i++;
	}
	echo "</tr>";
	$descI=$descI+1;
}
echo "</table>";
echo "<br><center><input type=submit value='Submit Request'/>&nbsp;&nbsp;<input type=reset value='Reset Request'/></form>";

function getFiscalWeek($year,$month,$day)
{
	$a = floor((14-($month))/12);
    $y = $year+4800-$a;
    $m = ($month)+(12*$a)-3;
    $jd = $day + floor(((153*$m)+2)/5) +
                 (365*$y) + floor($y/4) - floor($y/100) +
                 floor($y/400) - 32045;      // (gregorian calendar)

    //var jd = (day+1)+Round(((153*m)+2)/5)+(365+y) +

    //                 round(y/4)-32083;    // (julian calendar)


    //now calc weeknumber according to JD

    $d4 = ($jd+31741-($jd%7))%146097%36524%1461;
    $L = floor($d4/1460);
    $d1 = (($d4-$L)%365)+$L;
    $NumberOfWeek = floor($d1/7) + 1;
	return $NumberOfWeek;
}
?>