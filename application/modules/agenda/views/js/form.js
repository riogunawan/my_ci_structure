$(document).ready(function() {
    $(".mn-agenda").addClass("active");

	$('.date').datetimepicker({
        format: 'YYYY-MM-DD',
    });

    $(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});

    $(".deskripsi").ckeditor({
		filebrowserBrowseUrl: '<?php echo base_url("media/editor") ?>',
		height: 200,
		wordcount:{
			showParagraphs: false,
			showCharCount: true
		}
	}).on( 'dialogDefinition', function( ev ) {
		ev.data.definition.resizable = CKEDITOR.DIALOG_RESIZE_NONE;
	});

	$('form').validate({
		// debug: true,
		ignore: [],
		errorClass: 'error',
		// showErrors: function(errorMap, errorList) {},
		invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();

			if (errors) {
				var msg = "";

				if (validator.errorList.length > 0) {
					for (x = 0; x < validator.errorList.length; x++) {
						msg += "<div class='text-danger'>" + validator.errorList[x].message + "</div>";
					}
				}

				swal({
					title: "Error Messages",
					html: msg,
					type: "error",
					animation: "slide-from-top",
					confirmButtonColor: "#D9534F"
				});
			}
			validator.focusInvalid();
		},
		rules: {
			title: { required: true },
			date_agenda: { required: true },
			deskripsi: { required: true },
			city: { required: true },
			publish: { required: true },
		},
		messages: {
			title: { required: "Title can not be empty!" },
			date_agenda: { required: "Date Agenda can not be empty!" },
			deskripsi: { required: "Description can not be empty!" },
			city: { required: "City can not be empty!" },
			publish: { required: "Publish can not be empty!" },	
	   	},
   	});

});
