<!-- Query to create a database
CREATE TABLE `upload`.`up` ( `id` INT(20) NOT NULL AUTO_INCREMENT , `filename` VARCHAR(50) NOT NULL , `image` LONGBLOB NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
 -->


<?php
error_reporting(0);
 $conn = mysqli_connect("localhost","root","","upload");
 $like=0;
if(isset($_POST['submit']))
{
    $check = getimagesize($_FILES["myimage"]["tmp_name"]);
    if($check !== false)
    {

	$filename=$_FILES['myimage']['name'];
	$filetype=$_FILES['myimage']['type'];
	$filetemp=$_FILES['myimage']['tmp_name'];
	//echo $filetemp;
	        $imgcontent = addslashes(file_get_contents($filetemp));

	$image=move_uploaded_file($filetemp, "uploads/$filename");
//echo $imgContent;
	$query7 ="INSERT INTO up (id,filename,image) values (' ','$filename','$imgcontent')";
      $result6 = $conn->query($query7);
      if($result6)
    {
      echo '<script language="javascript">';
     echo 'alert("Image Uploaded");';  
    echo '</script>';
     
      }
    else
    {
      echo '<script language="javascript">';
          echo 'alert("Error in uploading image");';
           echo '</script>';
      
      
    }
    
}
else{
echo '<script language="javascript">';
          echo 'alert("Image size exceeded");';
           echo '</script>';    }
}
?>


<!DOCTYPE html>


<html lang="en">

<head>

	<meta charset="utf-8">

	<title>Crayon'd</title>

	<!-- Stylesheets -->
	      <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">

	<link rel="stylesheet" href="css/style.css" media="screen">

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="js/plupload.full.js"></script>
	<script src="js/jquery-progressbar.min.js"></script>
	<script>
		$(document).ready(function(){
		$('#myimage').click(function(){

			var image_name= $('#submit').val();
			if(image_name==' ')
			{
				alert("Please select image");
				return false;
			}
			else
			{
				var extension= $('#submit').val().split('.').pop().toLowerCase();
				if(jQuery.inArray(extension,['gif','png','jpg','jpeg'])==-1)
				{
					alert("Invalid iamge file");
					$('#submit').val('');
					return false;
				}
			}
		});




	});
		function dataUri($file, $mime) 
{  
    $contents = file_get_contents($file);
    $base64   = base64_encode($contents);

    return 'data:' . $mime . ';base64,' . $base64;
}
		// Upload Form
		// $(function() {
		// 	// Settings ////////////////////////////////////////////////
		// 	var uploader = new plupload.Uploader({
		// 		runtimes : 'html5,flash,silverlight', // Set runtimes, here it will use HTML5, if not supported will use flash, etc.
		// 		browse_button : 'pickfiles', // The id on the select files button
		// 		multi_selection: false, // Allow to select one file each time
		// 		container : 'uploader', // The id of the upload form container
		// 		max_file_size : '8000kb', // Maximum file size allowed
		// 		//url : 'upload.php', // The url to the upload.php file
		// 		flash_swf_url : 'js/plupload.flash.swf', // The url to thye flash file
		// 		silverlight_xap_url : 'js/plupload.silverlight.xap', // The url to the silverlight file
		// 		filters : [ {title : "Image files", extensions : "jpg,gif,png"} ] // Filter the files that will be showed on the select files window
		// 	});

		// 	// RUNTIME
		// 	uploader.bind('Init', function(up, params) {
		// 		$('#runtime').text(params.runtime);
		// 	});

		// 	// Start Upload ////////////////////////////////////////////
		// 	// When the button with the id "#uploadfiles" is clicked the upload will start
		// 	$('#uploadfiles').click(function(e) {
		// 		uploader.start();
		// 		e.preventDefault();
		// 		//e.text("Image uploaded");
		// 	});

		// 	uploader.init(); // Initializes the Uploader instance and adds internal event listeners.

		// 	// Selected Files //////////////////////////////////////////
		// 	// When the user select a file it wiil append one div with the class "addedFile" and a unique id to the "#filelist" div.
		// 	// This appended div will contain the file name and a remove button
		// 	uploader.bind('FilesAdded', function(up, files) {
		// 		$.each(files, function(i, file) {
		// 			$('#filelist').append('<div class="addedFile" id="' + file.id + '">' + file.name + '<a href="#" id="' + file.id + '" class="removeFile"></a>' + '</div>');
		// 		});
		// 		up.refresh(); // Reposition Flash/Silverlight
		// 	});

		// 	// Error Alert /////////////////////////////////////////////
		// 	// If an error occurs an alert window will popup with the error code and error message.
		// 	// Ex: when a user adds a file with now allowed extension
		// 	uploader.bind('Error', function(up, err) {
		// 		alert("Error: " + err.code + ", Message: " + err.message + (err.file ? ", File: " + err.file.name : "") + "");
		// 		up.refresh(); // Reposition Flash/Silverlight
		// 	});

		// 	// Remove file button //////////////////////////////////////
		// 	// On click remove the file from the queue
		// 	$('a.removeFile').live('click', function(e) {
		// 		uploader.removeFile(uploader.getFile(this.id));
		// 		$('#'+this.id).remove();
		// 		e.preventDefault();
		// 	});

		// 	// Progress bar ////////////////////////////////////////////
		// 	// Add the progress bar when the upload starts
		// 	// Append the tooltip with the current percentage
		// 	uploader.bind('UploadProgress', function(up, file) {
		// 		var progressBarValue = up.total.percent;
		// 		$('#progressbar').fadeIn().progressbar({
		// 			value: progressBarValue
		// 		});
		// 		$('#progressbar .ui-progressbar-value').html('<span class="progressTooltip">' + up.total.percent + '%</span>');
		// 	});

		// 	// Close window after upload ///////////////////////////////
		// 	// If checkbox is checked when the upload is complete it will close the window
		// 	uploader.bind('UploadComplete', function() {
		// 		if ($('.upload-form #checkbox').attr('checked')) {
		// 			$('.upload-form').fadeOut('slow');
		// 		}
		// 	});

		// 	// Close window ////////////////////////////////////////////
		// 	// When the close button is clicked close the window
		// 	$('.upload-form .close').on('click', function(e) {
		// 		$('.upload-form').fadeOut('slow');
		// 		e.preventDefault();
		// 	});

		// }); // end of the upload form configuration

		// // Check Box Styling
		// $(document).ready(function() {

		// 	var checkbox = $('.upload-form span.checkbox');

		// 	// Check if JavaScript is enabled
		// 	$('body').addClass('js');

		// 	// Make the checkbox checked on load
		// 	checkbox.addClass('checked').children('input').attr('checked', true);

		// 	// Click function
		// 	checkbox.on('click', function() {

		// 		if ($(this).children('input').attr('checked')) {
		// 			$(this).children('input').attr('checked', false);
		// 			$(this).removeClass('checked');
		// 		}

		// 		else {
		// 			$(this).children('input').attr('checked', true);
		// 			$(this).addClass('checked');
		// 		}
			
		// 	});

		// });
	</script>

	<!-- Preview Styles -->
	<style type="text/css">
		html, body { margin: 0;	padding: 0; }
		body { background: #f2f2f2 url(img/bg1.png) no-repeat top center ; padding-top: 330px; }
		#uploader { margin: 0 auto; }
		.info { text-align: center; padding: 50px 0; color: #666; font-family: Helvetica, Arial, sans-serif; }
		#runtime { text-transform: uppercase; }
		.info span { color: #81c468; }
	</style>
<meta name="robots" content="noindex,follow" />
</head>

<body>

<div class="upload-form" id="uploader" style=width:300px height:300px>
	
	<!-- Form Heading -->
	<h1 class="replace-text">Crayon'd Social Website</h1>
		<a href="#" class="close" title="Close Window"><img src="img/close-button.png" alt="Close"></a>

	<br><br>
	<div>
		<form method="post" action="index.php" enctype="multipart/form-data">
<input type="file" name="myimage" accept="image/x-png,image/gif,image/jpeg" />
<br><br>
		<input type="text" name="text" style="width:300px; height:50px; font-style: italic;" value="" placeholder="Write about something interesting... ">
		<br><br>
		<center>
				<button type="submit" name="submit"> upload </button>
		</center>
	</div>

	<!-- File List -->
	<div id="filelist" class="cb"></div>

	<!-- Progress Bar -->
	<div id="progressbar"></div>

	<!-- Close After Upload -->
	<!-- <div id="closeAfter">
		<span class="checkbox">
			<input type="checkbox" name="checkbox" id="checkbox">
			<label for="checkbox">Close window after upload</label>
		</span>
	</div> -->

</div>



<div class="info">Max File Size Less Than <span>1MB</span> | Only <span>Images</span> Allowed </div>
<br><br>
<?php
	      if(isset($_POST['submit'])&&$result6==1)
	      {
	      	?>
<table class = "table table-condensed">
	<thead>
		<div>
	<tr>
		<th><h1 style="color:blue;"> CURRENT POST</h1> </th>
	</tr>
</div>
</thead>
	<?php
}
?>

	<?php
	      if(isset($_POST['submit'])&&$result6==1)
	      {
	      	//echo "helo";
	      	$text=$_POST['text'];
	      	$sql = "SELECT distinct(image) FROM up where filename='".$filename."'";
	 $result1=$conn->query($sql);
        $row=$result1->fetch_assoc();
        // while($row=mysqli_fetch_array($result1))
        // {
       	// //echo $row[$k];
        	//echo "$text";
        echo "<tbody>";
        echo "<tr><td><h2 style=\"font-style: italic;\">".$text."</h2></td></tr>";
echo '<tr><td><img style=" width:500px; height:500px;" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" /></td></tr>';
// echo "<form method=\"post\"  >";
// 			echo"	<button type=\"submit\" name=\"like\" > LIKE </button>";
// 			echo"	<button type=\"submit\" name=\"dislike\" > DISLIKE </button>";
// 			echo"</form>";
			
//echo "</tbody>";
//}

}

	?>
	<button type="button" name="like" onclick="<?php $like=$like+1; echo $like;?>"> LIKE </button>


</body>

</html>