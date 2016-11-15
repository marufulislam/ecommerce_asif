<?php
//define('INCLUDE_CHECK',true);
require_once('../../dcont/include/connect.php');

if ( (!empty($_SESSION['INCLUDE_CHECK'])) && (!empty($_POST['random_number'])) ) {
	if ($_SESSION['INCLUDE_CHECK'] == $_POST['random_number']) {

		require_once('../include/functions.php');
		
		//print_r($_POST);exit();
		
		if(isset($_POST['temp']) == false) $temp = "";
		else if(isset($_POST['temp']) == true) $temp = $_POST['temp'];
		
		
		 if($temp == "POST"){
		$uid = $_POST['uid'];
		$video = $_POST['video'];
			
			$sql_update = "UPDATE users SET video='".escape($video)."' WHERE uid='$uid'";	
			
			
			$rs_update=mysql_query($sql_update) or die ("Error in update : ".mysql_error());
			if($rs_update){

			?>
				<div class="general_info_box success">
                        	<a href="#" class="close">Close</a> 
                    <p>Video Updated successfuly</p>
                </div>
				<script>
					setTimeout( function() {  
                       location.replace('<?php echo urlroute('profile_details'); ?>'); 
                    }, 1000 );
                    jQuery("#idsubmitData").hide();
                    jQuery("#loader").slideUp();
				</script> 
                <div class="clearboth"></div>
			<?php
			}else{
			?>
                <div class="general_info_box error">
                        	<a href="#" class="close">Close</a> 
                    <p>Posted Error</p>
                </div>
                <script type="text/javascript">

							jQuery(".idsubmitData").show();
							jQuery("#loader").hide();	
                        </script> 
                        <div class="clearboth"></div>
			<?php	
			}
		
			
		}
		
		
	
	}else{
		echo 'You are not allowed to execute this file directly';   
	}
}
else{
	echo '<script type="text/javascript">window.location.href = ("../");</script>';   
}
?>