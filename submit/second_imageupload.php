<?php
require_once('../include/functions.php');

// Create uploads directory if necessary
if(!file_exists('temp')) mkdir('temp');
if(!file_exists('temp/thumbs')) mkdir('temp/thumbs');

$image = $_FILES["image"]["name"];
$uploadedfile = $_FILES['image']['tmp_name'];
$random_number = $_REQUEST['random_number'];
$userfile_size = $_FILES['image']['size'];
$userfile_type = $_FILES['image']['type'];

$image_width = $_REQUEST['image_width'];
$image_height = $_REQUEST['image_height'];

$thumb_image_height = 300;
$thumb_image_width = 300;

$path = "temp/";

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");

$extension = getExtension($image);
$uf = date('Ymd').$random_number.'.'.$extension;;//File name eg. 200507119.ext

if(in_array($extension,$valid_formats)){
	if(move_uploaded_file($uploadedfile, $path.$uf)){
		resize($path,$uf,$image_width,$image_height,$userfile_size,$userfile_type,'',$image_width);
		resize($path,$uf,$image_width,$image_height,$userfile_size,$userfile_type,'small',$thumb_image_width);
		echo "File Uploaded";
		unlink($path.$uf);
		?>
        <input type="hidden" name="photo" id="photo" value="<?php echo $uf;?>" />
        <?php
	}else{
	  	echo "Fail upload folder with read access.";
	}
}else{
  	echo "Invalid file format..";
}

?>