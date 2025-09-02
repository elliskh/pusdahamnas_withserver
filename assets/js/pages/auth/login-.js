let show_password = false;
$('#show-password').on('click', function () {
	if (!show_password) {
		$('#password').prop('type', 'text');
		show_password = true;
	} else {
		$('#password').prop('type', 'password');
		show_password = false;
	}
})

let show_password2 = false;
$('#show-password2').on('click', function () {
	if (!show_password2) {
		$('#password2').prop('type', 'text');
		show_password2 = true;
	} else {
		$('#password2').prop('type', 'password');
		show_password2 = false;
	}
})

let width = $('.g-recaptcha').parent().width();
if (width < 302) {
	let scale = width / 302;
	$('.g-recaptcha').css('transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
	$('.g-recaptcha').css('transform-origin', '0 0');
	$('.g-recaptcha').css('-webkit-transform-origin', '0 0');
}

let validator = $('#form-login').validate({
	errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
	errorElement: 'div',
	errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
	highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
	unhighlight: (element) => $(element).removeClass('is-invalid').addClass('is-valid'),
	success: (element) => $(element).remove(),
	rules: {
		username: "required",
		password: {
			required: true,
			minlength: 8
		},
	},
	messages: {
		username: "Username tidak boleh kosong",
		password: {
			required: 'Kata sandi tidak boleh kosong',
			minlength: 'Kata sandi minimal 8 karakter'
		},
	}
});
