<?php
//define('INCLUDE_CHECK',true);
require_once('../../dcont/include/connect.php');

if ( (!empty($_SESSION['INCLUDE_CHECK'])) && (!empty($_POST['random_number'])) ) {
	if ($_SESSION['INCLUDE_CHECK'] == $_POST['random_number']) {

		require_once('../include/functions.php');
		
		
		
		if(isset($_POST['temp']) == false) $temp = "";
		else if(isset($_POST['temp']) == true) $temp = $_POST['temp'];
		
		
		if($temp == "EDIT"){
		
			$Editid = $_REQUEST['uid'];
			
			$uid = $_REQUEST['uid'];
			
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
		 	$email = $_POST['email'];
		        $catId = $_POST['catId'];
			$special = $_POST['special_id'];
			$area = $_POST['area'];
			$address = $_POST['address'];
			$qualification = $_POST['vQualifications'];
			$rate = $_POST['rate'];
			$wbaddress = $_POST['wbaddress'];
			$phone = $_POST['phone'];
			$description = $_POST['description'];
			$fullname = $_POST['fname'].' '.$_POST['lname'];
			$image = $_POST['image'];
			
			
			$del_spcl = mysql_query("DELETE FROM `usr_specialities` WHERE uid=$uid");
			
			$qry_spcl = "INSERT INTO usr_specialities (uid, special_id) VALUES ";
			foreach($special as $sk => $sv){
				$qry_spcl .= "('$Editid','".$sv."'),"; 			
			}
			$qry_spcl = substr_replace($qry_spcl, "", -1);
			$rs_spcl = mysql_query($qry_spcl);
			
			
			$del_spcl = mysql_query("DELETE FROM `usr_qualifications` WHERE uid=$uid");
			
			if(!empty($qualification)){
			
				$qry_qualifications = "INSERT INTO usr_qualifications (uid, qualifications_name) VALUES ";
				foreach($qualification as $sk => $sv){
					$qry_qualifications .= "('$Editid','".$sv."'),"; 			
				}
				$qry_qualifications = substr_replace($qry_qualifications, "", -1);
				$rs_spclqualifications = mysql_query($qry_qualifications);
			
			}
			
			
			$del_area = mysql_query("DELETE FROM `usr_area` WHERE uid=$uid");
			
			$qry_area = "INSERT INTO usr_area (uid, area_id) VALUES ";
			foreach($area as $sk => $sv){
				$qry_area .= "('$Editid','".$sv."'),"; 			
			}
			$qry_area = substr_replace($qry_area, "", -1);
			$rs_area = mysql_query($qry_area);
			
			
			$sql_usr_update = "UPDATE users SET `first_name`='".escape($fname)."',`last_name`='".escape($lname)."',`fullname`='".escape($fullname)."' WHERE uid='$Editid'";
			$rs_usr_update=mysql_query($sql_usr_update) or die ("Error in update : ".mysql_error());
			
			$del_spcl = mysql_query("DELETE FROM `profile_edit` WHERE uid=$uid");
			
			$sql_update = "INSERT INTO `profile_edit`(`uid`, `catId`, `address`, `rate`, `wbaddress`, `phone`, `description`) VALUES ('$Editid','".escape($catId)."','".escape($address)."','".escape($rate)."','".escape($wbaddress)."','".escape($phone)."','".escape($description)."')";
			
			

			
			
			$rs_update=mysql_query($sql_update) or die ("Error in update : ".mysql_error());
			
	
			if($rs_update){
			?>
				<div class="general_info_box success">
                        	<a href="#" class="close">Close</a> 
                    <p>Updated successfuly</p>
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
                  
                    <p>Update Error</p>
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