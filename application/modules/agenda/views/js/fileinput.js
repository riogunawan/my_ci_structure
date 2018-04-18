$(document).ready(function() {
	fileInputInit();
});

function fileInputInit () {
	var file = $(".cover").data("cover");
	var imageLink = "<?php echo base_url() ?>assets/themes/e-disi-admin/images/logo-dummy.jpg";
	if (file != "") {
		imageLink = "<?php echo base_url() ?>assets/upload/agenda/" + file;
	}
	
	var fileInput = {
	   theme 		   : "fa",
	   autoReplace     : true,
	   showUpload      : false,
	   showCaption     : false,
	   showBrowse      : true,
	   showCancel      : false,
	   browseLabel     : "Browse",
	   allowedFileExtensions: ["jpg", "bmp", "jpeg", "png", "gif"],
	   previewSettings : {
		   image: { width: "98.5%", height: "auto" },
		   pdf: { width: "98.5%", height: "auto" },
	   },
	   initialPreview: [
		   "<img src='"+ imageLink +"' class='file-preview-image' style='width: 100%; height: 130%' alt='Default Image' title='Default Image'>",
	   ]
   };
   
   $("#cover").fileinput(fileInput);
}