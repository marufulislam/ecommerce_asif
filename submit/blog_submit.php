<?php
//define('INCLUDE_CHECK',true);
require_once('../../dcont/include/connect.php');

if ( (!empty($_SESSION['INCLUDE_CHECK'])) && (!empty($_POST['random_number'])) ) {
	if ($_SESSION['INCLUDE_CHECK'] == $_POST['random_number']) {

		require_once('../include/functions.php');
		
		//print_r($_POST);exit();
		
		if(isset($_POST['temp']) == false) $temp = "";
		else if(isset($_POST['temp']) == true) $temp = $_POST['temp'];
		
		
		    $uid = $_POST['uid'];
		    $tittle = $_POST['tittle'];
			$detail = $_POST['detail'];
			$photo = escape(isset($_POST['photo'])) ?  $_POST['photo'] : '';


			$output_dir = "../../images/blog/".$photo;
			$output_dir_thumbs = "../../images/blog/thumbs/small".$photo;
			
			$img = 'temp/thumbs/'.$photo;
			$img_thumbs = 'temp/thumbs/small'.$photo;
		
		
		if($temp == "POST"){
		
			
			$sql_update = "INSERT INTO `myblog`(`uid`, `tittle`, `image`, `description`) VALUES ('".$uid."','".escape($tittle)."','".$photo."','".escape($detail)."')";
			
			
			//$sql_update = "UPDATE profile_edit SET `catId`='".escape($catId)."',`address`='".escape($address)."',`qualification`='".escape($qualification)."',`rate`='".escape($rate)."',wbaddress='".escape($wbaddress)."',phone='".escape($phone)."',description='".escape($description)."' WHERE uid='$Editid'";	
			
			
			$rs_update=mysql_query($sql_update) or die ("Error in update : ".mysql_error());
			if($rs_update){
			if($photo != ''){
			
			   rename($img, $output_dir);
			   rename($img_thumbs, $output_dir_thumbs);
			   }
			?>
				<div class="general_info_box success">
                        	<a href="#" class="close">Close</a> 
                    <p>Posted successfuly</p>
                </div>
				<script>
					setTimeout( function() {  
                       location.replace('<?php echo urlroute('myblog'); ?>'); 
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
		
		if($temp == "Update"){
	
	    $Editid = $_REQUEST['Editid'];
	
		$qry_category = mysql_query("SELECT * FROM `myblog` WHERE blog_id='".$Editid."'") or die ("Error in Slider selection : ".mysql_error());
		$rs_category = mysql_fetch_array($qry_category); 
		$db_category = $rs_category['tittle'];
		$db_photo = $rs_category['image'];
	   if($db_category != $tittle){

	
			
			if($photo == ''){
				$sql_update="UPDATE myblog SET tittle='".$tittle."',description='".$detail."' WHERE blog_id='".$Editid."'";	
			}else{
				$sql_update="UPDATE myblog SET tittle='".$tittle."',description='".$detail."',image='".$photo."' WHERE blog_id='".$Editid."'";	
				rename($img, $output_dir);
				rename($img_thumbs, $output_dir_thumbs);
				
				$path1 = '../../images/blog/'.$db_photo;
				$path2 = '../../images/blog/thumbs/small'.$db_photo;
				if(file_exists($path1) == true && $db_photo != "") unlink($path1);
				if(file_exists($path2) == true && $db_photo != "") unlink($path2);	

			}
			
			
			$rs_update=mysql_query($sql_update) or die ("Error in update : ".mysql_error());
			if($rs_update){
			?>
				<div class="general_info_box success">
                        	<a href="#" class="close">Close</a> 
                    <p>Post Updated successfuly</p>
                </div>
				<script>
					setTimeout( function() {  
                       location.replace('<?php echo urlroute('myblog'); ?>'); 
                    }, 1000 );
                    jQuery("#idsubmitData").hide();
                    jQuery("#loader").slideUp();
				</script> 
			<?php
			}else{
			?>
				<div class="general_info_box error">
                        	<a href="#" class="close">Close</a> 
                    <p>Post Update Error</p>
                </div>
                <script type="text/javascript">
			
							jQuery(".idsubmitData").show();
							jQuery("#loader").hide();	
                        </script> 
                        <div class="clearboth"></div> 
			<?php	
			}
		    ?>	
    	
    <?php  
		
	}else{
		
		if($photo == ''){
			$sql_update="UPDATE myblog SET tittle='".$tittle."',description='".$detail."' WHERE blog_id='".$Editid."'";	
		}else{
			$sql_update="UPDATE myblog SET tittle='".$tittle."',description='".$detail."',image='".$photo."' WHERE blog_id='".$Editid."'";	
			rename($img, $output_dir);
			rename($img_thumbs, $output_dir_thumbs);
			$path1 = '../../images/blog/'.$db_photo;
			$path2 = '../../images/blog/thumbs/small'.$db_photo;
			if(file_exists($path1) == true && $db_photo != "") unlink($path1);
			if(file_exists($path2) == true && $db_photo != "") unlink($path2);	
		}	
		$rs_update=mysql_query($sql_update) or die ("Error in update : ".mysql_error());
		if($rs_update){
		?>
			<div class="general_info_box success">
                        	<a href="#" class="close">Close</a> 
                    <p>Post Updated successfuly</p>
                </div>
				<script>
					setTimeout( function() {  
                       location.replace('<?php echo urlroute('myblog'); ?>'); 
                    }, 1000 );
                    jQuery("#idsubmitData").hide();
                    jQuery("#loader").slideUp();
				</script> 
		<?php
		}else{
		?>
			<div class="general_info_box error">
                        	<a href="#" class="close">Close</a> 
                    <p>Post Update Error</p>
                </div>
                <script type="text/javascript">
			
							jQuery(".idsubmitData").show();
							jQuery("#loader").hide();	
                        </script> 
                        <div class="clearboth"></div>
		<?php	
		}
		
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