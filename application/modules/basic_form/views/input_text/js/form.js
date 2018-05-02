$(document).ready(function() {

	$(".btn-proses").click(function(e) {
        e.preventDefault();
        $(".form").submit();
    });
    
	$('form').validate({
		// debug: true,
		ignore: [],
		errorClass: 'error',
		// showErrors: function(errorMap, errorList) {},
		invalidHandler: function(form, validator) {
			var errors = validator.numberOfInvalids();

			if (errors) {
				var errors = "";

				if (validator.errorList.length > 0) {
					for (x = 0; x < validator.errorList.length; x++) {
						errors += "<div class='text-danger'>" + validator.errorList[x].message + "</div>";
					}
				}
				swal({
					title: "Error Messages",
					text: errors,
					// animation: "slide-from-top",
					type: "error",
					confirmButtonColor: "#fb483a",
					html: true
				});
			}
			validator.focusInvalid();
		},
		rules: {
			input_text: { required: true },
		},
		messages: {
			input_text: { required: "Input Text tidak boleh kosong" },
		},
   	});

});
