<?php
	
	include('connectdb.php');
	
	
	

    $number= $contact;
    //$text="Your Ward Is Absent";
	$billno = $bill;
	$pointno = $point;
	$billid = $billid;
 	 
	 
	 $url = "http://smspatna.com/API/WebSMS/Http/v1.0a/index.php?username=UMDASERVICES&password=UMDASERVICES&sender=WSHXPR&to=$number&message=Thank+You+For+Visiting+Washing+Express+Your+Wallet+Is+Added+With+$point+Point+From+Total+Bill+Of+Rs+$billno+Having+Bill+No+-+$billid.&reqid=1&format={json|text}&route_id=328&sendondate=11-12-2019T11:54:35";
 
	file_get_contents($url);