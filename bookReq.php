<?php
ini_set("SMTP","localhost");
ini_set("sendmail_from","satbirsoni@gmail.com");
$header  = "'MIME-Version: 1.0'\r\n";
$header = $header."From: satbirsoni@gmail.com\r\nReply-To: satbirsoni@gmail.com";
$subject = "Lab Booking Status";
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$ssoid=$_GET['ssoid'];

$query="select name,email from employee where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
$name=$answer[0];
$to=$answer[1];


$incre=$_GET['incre'];
$date=$_GET['date'];
$url = $_SERVER['REQUEST_URI'];
$processed_url = parse_url( $url );
$query_string = $processed_url[ 'query' ];
$query_string = explode( '&', $query_string );
$i=1;
$bookedEquipmentArray=array();
$bookedSlotArray=array();
$cancelledEquipmentArray=array();
$cancelledSlotArray=array();
$arrayOfSlots=array("9am-11am","11am-1pm","1pm-3pm","3pm-5pm","5pm-7pm","7pm-9pm","9pm-9am");

foreach( $query_string as $chunk )
{
	$chunk = explode( '=', $chunk );
	//echo $chunk[1];
	if ( count( $chunk ) == 2 and $i>3)
	{
		list( $key1, $val1 ) = $chunk;
		//echo $key."=".$val."<br>";
		$equipIDandSlot = explode( '-', $key1 );
		list( $key, $val ) = $equipIDandSlot;
		//echo $key."=".$val."<br>";
		$equipid=$key;		
		$timeslot=intval($val);
		$query = "select equipname from equipment where equipId = '".$equipid."'";
		$result=mysql_query($query) or die(mysql_error());
		$answer=mysql_fetch_row($result);
		if($timeslot!=0)
		{
			if($timeslot > 7 )
			{
				$timeslot=$timeslot-8;
				if($val1 == "on")
				{
					$query="delete from booking where equipId = '".$equipid."' and ssoid = '".$ssoid."'and timeslot='".$timeslot."' and dateofbooking='".$date."'";
					$result=mysql_query($query) or die(mysql_error());
					$cancelledEquipmentArray[]=$answer[0];
					$cancelledSlotArray[]=$arrayOfSlots[$timeslot];
				}
			}
			else
			{
				$timeslot=$timeslot-1;
				if($val1 == "on")
				{
					$query = "select ssoid from booking where dateofbooking='".$date."' and equipId='".$equipid."' and timeslot='".$timeslot."'";
					$result=mysql_query($query) or die(mysql_error());
					$answer=mysql_fetch_row($result);
					if($answer[0]==NULL)
					{
						$query="insert into booking values('".$equipid."','".$ssoid."','".$date."','".$timeslot."')";
						$result=mysql_query($query) or die(mysql_error());
						$bookedEquipmentArray[]=$answer[0];
						$bookedSlotArray[]=$arrayOfSlots[$timeslot];
					}
				}
			}
		}
	}
	$i++;
}
$t=strtotime($date);
$newDate=date('d-F-y',$t);
$message = " <html>
					<head>
						<title> Booking Status</title>
					</head>
					<body><font face='ge inspira pitch' size=4>
					Hi <b>".$name." </b>, <br><br>".
					"&nbsp;&nbsp;&nbsp;&nbsp;You Have made following bookings and cancellations for <b>".$newDate."</b>:<br><br>".
					"<table align=center border=2 bgcolor=white cellspacing=10 cellpadding=10><tr><th>Bookings</th><th>Cancellations</th></tr><tr><td><table border=1 cellspacing=5 cellpadding=5><tr><th>Equipment</th><th>Slot</th></tr>";
					for($i=0;$i<count($bookedSlotArray);$i++)
					{
						$message=$message."<tr><td align=center>".$bookedEquipmentArray[$i]."</td><td align=center>".$bookedSlotArray[$i]."</td></tr>";
					}
					$message=$message."</table></td><td><table border=1 cellpadding=5 cellspacing=5><tr><th>Equipment</th><th>Slot</th></tr>";
					for($i=0;$i<count($cancelledSlotArray);$i++)
					{
						$message=$message."<tr><td align=center>".$cancelledEquipmentArray[$i]."</td><td align=center>".$cancelledSlotArray[$i]."</td></tr>";
					}
					$message=$message."</table></td></tr></table><br>&nbsp;&nbsp;&nbsp;&nbsp;Visit <a href='http://3.235.118.106/LabBooking'>Book Lab</a> to make a booking or check status.".
					"<br><br>&nbsp;&nbsp;&nbsp;&nbsp;Thanks and Regards,<br>&nbsp;&nbsp;&nbsp;&nbsp;Administrator<br><br><br><b>PLEASE DO NOT REPLY - THIS IS AN UNMONITORED MAILBOX</b></body></html>";
//$send_result = mail( $to, $subject, $message, $header );
//echo $message;
header("Location: BookingPage.php?ssoid=".$ssoid."&booking=done&incre=".$incre."&date=".$date);
exit;
?>