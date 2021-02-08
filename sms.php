<?php
	
	include('connectdb.php');
	
	
	

    $number= $contact;
    //$text="Your Ward Is Absent";
	$cardno = $card;
 	 
	 
	 $url = "http://smspatna.com/API/WebSMS/Http/v1.0a/index.php?username=UMDASERVICES&password=UMDASERVICES&sender=WSHXPR&to=$number&message=Welcome+To+Washing+Xpress+Customer+Privilege+Program.+Your+Card+Number+Is+$cardno+Washing+Xpress+A+One+Stop+Solution+For+All+Your+Laundry+Needs.+Washing+Matlab+Washing+Xpress.&reqid=1&format={json|text}&route_id=328&sendondate=11-12-2019T11:54:35";
 
	file_get_contents($url);