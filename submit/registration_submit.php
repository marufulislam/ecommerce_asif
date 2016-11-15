<?php
//define('INCLUDE_CHECK',true);

//print_r($_POST);exit();	
require_once('../back_pan/include/connect.php');

function dateConvert($date){
	$req_date = explode("/",$date);
	return @$dt = "$req_date[2]-$req_date[1]-$req_date[0]";
}

?>
<?php

	$error = "";
	
	if(isset($_POST['temp'])) // executes when user reg form submits.
	{	
	
	
		
		
		date_default_timezone_set('Asia/Dhaka');
		
		$query 	= mysql_query("SHOW TABLE STATUS LIKE 'users'");
		$uid 	= mysql_result($query, 0, 'Auto_increment'); // next id to be inserted
		
		$uid 	= $uid;
		
		$username = $_POST['username'];
		$organization = $_POST['organization'];
		$designation = $_POST['designation'];
		$cell_no = $_POST['cell_no'];
		$email 	= $_POST['email'];
		$pass 	= md5($_POST['password']);
				
		$s_date = date('Y-m-d');
		
		$active = '0';
				
		$query 	= mysql_query("SELECT email FROM users WHERE email = '$email'");
		mysql_num_rows($query);

		if(mysql_num_rows($query) > 0)
		 echo "This Email Address is already registered.";
		
		else
		{			
			$sql1 = "INSERT INTO users (uid, name, organization, designation, email, cell_no, password, active, date)	VALUES ('$uid','$username','$organization', '$designation', '$email', '$cell_no', '$pass','$active','$s_date')";
		
		$rs = mysql_query($sql1) or die("Error : ".mysql_error());	
		if($rs)
		{				
			?>
			<div class="alert alert-success form_success">
Registration succesfull, Please contact with admin to activate your account.
</div>

				<script type="text/javascript">
							location.reload();
                        </script>
           		<?php             
			
		}else{
		?>
			<div class="alert alert-danger">
        Error Occured!
        </div>
        <?php			
			
		}
		}
	} // end of submit
?>