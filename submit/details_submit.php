<?php
//define('INCLUDE_CHECK',true);
require_once('../../dcont/include/connect.php');

?>
<?php

		
		$to = $_POST['to'];
		$uid = $_POST['uid'];
		$name = $_POST['visitorName'];
		$email = $_POST['visitorEmail'];
		$phone 	= $_POST['visitorPhone'];
		$subject 	= $_POST['visitorSubject'];
		$message 	= $_POST['visitorMessage'];

        			
			$sql1 = "INSERT INTO message (uid, name, email, phone, subject, message)	VALUES ('$uid', '$name', '$email', '$phone', '$subject', '$message')";
		
		$rs = mysql_query($sql1) or die("Error : ".mysql_error());	
		if($rs)
		{
			
		$subject = $subject;
	
	$msg = "
	===================== Email from meet visitor ======================
		<html>
		<body>
			<table border='2' cellpadding='1'>
			  <tr>
				<td> Name </td>
				<td> $name </td>
			  </tr>
			  <tr>
				<td> Contact No. </td>
				<td> $phone </td>
			  </tr>
			  <tr>
				<td> Email </td>
				<td> $email </td>
			  </tr>
			  <tr>
				<td> message </td>
				<td> $message </td>
			  </tr> 
			   
			</table>
		</body>
		</html>";

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$name.' <'.$email.">\r\n";
	
	if(mail($to,$subject,$msg,$headers)){
		
?>
<br><br>
<div class="alert"><div class="alert-success form_success">
message Sent
</div><div class="bclear"></div>
<div>
<script>
jQuery(".idsubmitData").show();
</script>
<?php    
}else{
echo 'error!!';
}       
			
		}			

?>