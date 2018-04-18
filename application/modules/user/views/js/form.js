$(document).ready(function() {
	$(".mn-users").addClass("active");

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
			nama_lengkap: { required: true },
			username: {
                remote: {
                    url: "<?php echo base_url();?>user/check",
                    type: "post",
                    data: {
                        id_user : function() {
                            return $( ".id_user" ).val()
                        },
                        username : function() {
                            return $( ".username" ).val()
                        }
                    }
                }
            },
            password_confirm: { equalTo: ".password" },
		},
		messages: {
			nama_lengkap: { required: "Full Name can not be empty!" },
			username: {
                remote: "Username already used"
            },
            password_confirm:{ equalTo:"Confirm Password is not the same as Password" },
	   	},
   	});

});
