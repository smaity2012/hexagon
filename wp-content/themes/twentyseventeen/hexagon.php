<?php

/* Template Name: Hexagon */
get_header();
?>
<style>  
	.file_drag_area  
	{  
		width:600px;  
		height:400px;  
		border:2px dashed #ccc;  
		line-height:400px;  
		text-align:center;  
		font-size:24px;  
	}  
	.file_drag_over{  
		color:#000;  
		border-color:#000;  
	}  
</style> 
<h3 class="text-center">Drag and drop file upload using JQuery Ajax and PHP</h3>
<br/>
<form id="img_frame" method="POST" enctype="multipart/form-data">  
	<div class="file_drag_area">  
		Drop Files Here  
	</div>
</form>  


<div id="uploaded_file"></div>
<script type="text/javascript">
	jQuery(document).ready(function(){


		jQuery('.file_drag_area').on('dragover', function(){  
			jQuery(this).addClass('file_drag_over');  
			return false;  
		});  
		jQuery('.file_drag_area').on('dragleave', function(){  
			jQuery(this).removeClass('file_drag_over');  
			return false;  
		}); 

		jQuery('.file_drag_area').on('drop', function(e){
		 	  
		 	e.preventDefault(); 
		 	e.stopPropagation(); 
		 	jQuery(this).removeClass('file_drag_over');  
		 	
		 	/**
			 * Step 1 : Get the form id and store in a 
			 * variable
		 	 */
		 	var form = document.getElementById('img_frame');
			

		 	/**
			 * Step 2 : Create a new form instant with the 
			 * form variable 
		 	 */
			var formData = new FormData(form);  


		 	/**
			 * Step 3 : Get the files list  
		 	 */
			var files_list = e.originalEvent.dataTransfer.files;  

			/**
			 * Step 4 : Form files store and append with form
			 * data object 
		 	 */
			for(var i=0; i<files_list.length; i++)  
			{
				formData.append('file', files_list[i]);  
			}  
            /**
			 * Step 5 : Create the action name to call a function  
		 	 */ 
           formData.append( "action", 'seebreeze_img_frame_upload');

           	/**
			 * Step 6 : Make ajax call and get the response back 
			 * from server  
		 	 */
           jQuery.ajax({  
           	url:"<?php echo admin_url('admin-ajax.php'); ?>",  
           	method:"POST",
           	data: formData,
           	contentType:false,  
           	cache: false,  
           	processData: false,  
           	success: function(data, textStatus, XMLHttpRequest) {
           		console.log(data);
           	},

           	error: function(MLHttpRequest, textStatus, errorThrown) {
           		alert(errorThrown);
           	} 
           });  
       });

	});
</script>
<?php get_footer(); ?>
