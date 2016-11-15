<?php
//define('INCLUDE_CHECK',true);
require_once('../../dcont/include/connect.php');

?>
<?php

	$domain = "";
	$error = "";
	
	if(isset($_POST['temp'])) // executes when user reg form submits.
	{		
		

		$from = 'info@meet.com';
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone 	= $_POST['phone'];
		$message 	= $_POST['message'];

        			
			$sql1 = "INSERT INTO contact_form (name, email, phone, message)	VALUES ('$name', '$email', '$phone', '$message')";
		
		$rs = mysql_query($sql1) or die("Error : ".mysql_error());	
		if($rs)
		{
			$sqlcomName = "SELECT * FROM company_info ";
			$qrycomName =mysql_query($sqlcomName) or die("Error : ".mysql_error() );
			$rescomName = mysql_fetch_array($qrycomName);
			$comName = $rescomName['company_name'];
			
				$subject = 'Thanks for contacting with us.';
	
	$msg = "<html>
<body>
<div style = 'padding:10px'>
<div style = 'padding:14px;margin-bottom:4px;background-color:#E63C03'>
    <a target = '_blank' href='http://www.pratidinsokal.com' style = 'color:#FFF; text-decoration:none'><span width='130' height='24' style='display:block;border:0'>".$comName."</span></a>
  </div>
  
  <div style = 'font-size:13px;margin:14px'>
    <h2 style = 'margin:0 0 16px;font-size:18px;font-weight:normal'>Dear ".$name."</h2>

<p>
Thank you for contact. We will reply you as soon as possibloe.<br>
</p>
<br>
<p>
With Regards-</p>
<p style='font-size:13px;line-height:18px;border-bottom:1px solid rgb(238, 238, 238);padding-bottom:10px;margin:0 0 10px'>
    <span style='font:italic 13px Georgia,serif;color:rgb(102, 102, 102)'>".$comName."</span>
  
</p>

  <p style='margin-top:5px;font-size:10px;color:#888888'>
    
    Please do not reply to this message; it was sent from an unmonitored email address.  This message is a service email related to your use of ".$comName.".
  </p>
 

</div>
</div>
</body>
</html>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$comName.' <'.$from.">\r\n";
				
				mail($email, $subject, $msg, $headers);
				
			?>
            <br><br>
            <div class="alert"><div class="alert-success form_success">
            Email Sent.
            </div><div class="bclear"></div>
            <script type="text/javascript">
				location.reload();
			</script>
            <div>
           <?php             
			
		}			
			
		}
	 // end of submit
?>