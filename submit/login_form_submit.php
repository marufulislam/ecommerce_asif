<?php
//define('INCLUDE_CHECK',true);
require_once('../back_pan/include/connect.php');
require_once('../include/functions.php');

if(isset($_POST['temp']) == false) $temp = "";
else if(isset($_POST['temp']) == true) $temp = $_POST['temp'];

	$error = "";
	if($temp=="LOGIN"){
			
	$email = escape(isset($_POST['email'])) ?  $_POST['email'] : '';
	$password = (isset($_POST['password'])) ?  $_POST['password'] : '';
	//print_r($_POST);exit();
		
	$query = mysql_query("SELECT * FROM `users` WHERE email = '".$email."'") or die(mysql_error());
	$numrows = mysql_num_rows($query);
	if($numrows != 0){
		
		while($row = mysql_fetch_assoc($query)){
			$dbusr_email = $row['email'];
			$uid = $row['uid'];
			$dbusr_password = $row['password'];
			$active = $row['active'];
		}
		
		if($email==$dbusr_email && md5($password)==$dbusr_password){
			if($active == 1){

						
				$_SESSION['com_maruf_shikkhangon_usr_eml']=$email;
				$_SESSION['com_maruf_shikkhangon_usr_eml_session_id']=session_id();
				$_SESSION['uid']=$uid;
				if(isset($_SESSION["com_maruf_shikkhangon_usr_eml"])){
					?>
					<div class="alert alert-info">
						<h6>Login Successfull!</h6>
						
					</div>
					<script>
						 location.reload();
						jQuery(".idsubmitDataCvEditLogin").show();
						jQuery("#loaderCvEditLogin").slideUp();
					  </script>
					<?php
				}else{
					?>
					<div class="alert alert-error">
						<h6>Please contact with admin to activate your account.</h6>
						
					</div>
					<script>
					jQuery(".idsubmitData").show();
					jQuery("#loader").slideUp();
					</script>
					<?php	
				}
			}else{
				?>
                <div class="alert alert-error">
                    <h6>User Not Active.</h6>
                    
                </div>
                <script>
                jQuery(".idsubmitData").show();
                jQuery("#loader").slideUp();
                </script>
                <?php	
			}
		}else{	
		?>
        <div class="alert alert-error">
        	<h6>invalid credentials</h6>
        	
        </div>
        <script>
        jQuery(".idsubmitData").show();
        jQuery("#loader").slideUp();
        </script>
		<?php	
		}

	}else{
	?>
    <div class="alert alert-error">
        <h6>User does not exists</h6>
        
    </div>
    <script type="text/javascript">
        jQuery(".idsubmitData").show();
        jQuery("#loader").slideUp();
    </script>
    <?php
	}
			}
	
?>
