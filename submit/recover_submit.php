<?php
//define('INCLUDE_CHECK',true);
require_once('../../dcont/include/connect.php');
require_once('../../dcont/include/view.php');
?>
<?php

	$domain = "";
	$error = "";
	
	
		
        function gen_random()
		{	
			$length = 10;
			$validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ+-*#&@!?";
			$validCharNumber = strlen($validCharacters);
		 
			$result = "";
		 
			for ($i = 0; $i < $length; $i++) 
			{
				$index 	= mt_rand(0, $validCharNumber - 1);
				$result .= $validCharacters[$index];
			}	 
			return $result;
		}

        $user_email = $_POST['usr_email'];
		$from = 'info@meet.com';
	
		$sql = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
		$qry = mysql_query($sql) or die('error in '.mysql_error());
		@$first_name = mysql_result($sql, 0, "first_name");
		@$last_name = mysql_result($sql, 0, "last_name");
		
		if(mysql_num_rows($qry ) == 0){
		 $error = 'This email does not exist.';
		 ?>

        <br>
        <br>
        <div class="alert">
        <div class="alert-danger form_success"> This email does not exist. </div>
        <div class="bclear"></div>
        <script type="text/javascript">
                        $('.idsubmitData').show();
                    </script>
        <?php
		}
		
		else
          {
        	$new_pass 	= gen_random();
	        $pass 		= ($new_pass);
	
	
	        $query = "UPDATE users SET user_pass = '$pass' WHERE user_email = '$user_email'";		
			
		
		$rs = mysql_query($query) or die("Error : ".mysql_error());	
		if($rs)
		{
			$sqlcomName = "SELECT * FROM company_info ";
			$qrycomName =mysql_query($sqlcomName) or die("Error : ".mysql_error() );
			$rescomName = mysql_fetch_array($qrycomName);
			$comName = $rescomName['company_name'];
			

			
				$subject = 'New Password request.';
	
	$msg = "<html>
<body>
<div style = 'padding:10px'>
<div style = 'padding:14px;margin-bottom:4px;background-color:#E63C03'>
    <a target = '_blank' href='' style = 'color:#FFF; text-decoration:none'><span width='130' height='24' style='display:block;border:0'>".$comName."</span></a>
  </div>
  
  <div style = 'font-size:13px;margin:14px'>
    <h2 style = 'margin:0 0 16px;font-size:18px;font-weight:normal'>Dear ".$first_name." ".$last_name."</h2>

<p>
You requested for a new password and your login information are given as follow:-<br>
</p>
<p>Email :  $user_email</p>
<p>Password:  $new_pass</p>
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
				
				mail($user_email, $subject, $msg, $headers);
				
			?>
<br>
<br>
<div class="alert">
<div class="alert-success form_success"> Password request sent. </div>
<div class="bclear"></div>
<script type="text/javascript">
	location.replace('login');			
</script>

<?php             
			
		}
		
	     }

?>