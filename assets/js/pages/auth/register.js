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

let validator = $('#form-register').validate({
	errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
	errorElement: 'div',
	errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
	highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
	unhighlight: (element) => $(element).removeClass('is-invalid').addClass('is-valid'),
	success: (element) => $(element).remove(),
	rules: {
		name: "required",
		email: "required",
		username: "required",
		tipe_daftar: "required",
		pendidikan: "required",
		password: {
			required: true,
			minlength: 6
		},
        password2: {
			required: true,
			minlength: 6
		},
	},
	messages: {
		name: "Nama tidak boleh kosong",
		email: "Email tidak boleh kosong",
		username: "Username tidak boleh kosong",
		tipe_daftar: "Tipe daftar tidak boleh kosong",
		pendidikan: "Pendidikan tidak boleh kosong",
		password: {
			required: 'Kata sandi tidak boleh kosong',
			minlength: 'Kata sandi minimal 6 karakter'
		},
	}
});

$('#password, #password2').on('keyup', function () {
  if ($('#password').val() == $('#password2').val()) {
    $('#message_password').html('').css('color', 'green');
    //document.getElementById("btn_register").disabled = false;
    $('#btn_register').prop('disabled', false);
    $('#btn_register').removeAttr('disabled');
  } else 
    $('#message_password').html('Not Matching').css('color', 'red');
    //document.getElementById("btn_register").disabled = true;    
    $('#btn_register').prop('disabled', true);
    if ($('#password').val() == $('#password2').val()) {
        $('#btn_register').prop('disabled', false);
          var c=document.getElementById('check_term');
          if (c.checked) {
            $('#message_term').html('').css('color', 'green');
            $('#btn_register').prop('disabled', false);
            return true;
          } else { 
            $('#message_term').html('Checked Terms').css('color', 'red');
            $('#btn_register').prop('disabled', true);
            return true;
          }
    }    
});

$('#check_term').on('click', function () {
    var c=document.getElementById('check_term');
      if (c.checked) {
        $('#message_term').html('').css('color', 'green');
        $('#btn_register').prop('disabled', false);
        if ($('#password').val() == $('#password2').val()) {
            $('#btn_register').prop('disabled', false);
        }else{
            $('#btn_register').prop('disabled', true);
        }    
        return true;
      } else { 
        $('#message_term').html('Checked Terms').css('color', 'red');
        $('#btn_register').prop('disabled', true);
        return true;
      }
  });
  
	$('#form-register-pengunjung').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
		data.append(CSRF.token_name, CSRF.hash);
        
		$.ajax({
  	        url: $(this).prop('action'),
	 		type: $(this).prop('method'),
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			// alert(res.status);
				if (res.status=='sukses') {
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else if (res.status=='adauser') {
				    alert("Nama username sudah di gunakan!");
					///toastrSuccess('Gagal', "Pendaftaran tidak berhasil");
				}else if (res.status=='adaemail') {
				    alert("Nama email sudah di gunakan!");
					///toastrSuccess('Gagal', "Pendaftaran tidak berhasil");
				} else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil'); ?>
                window.location.replace("login"); 
              }
			/*error: (res) => {
                alert("Terjadi kesalahan di server!");
				//toastrError('Gagal', 'Terjadi kesalahan di server');
				//table.ajax.reload();
			}*/
            }
		});
	});
      
	$('#form-register-komham').on('submit', function (e) {
		e.preventDefault();

		let data = new FormData(this);
		data.append(CSRF.token_name, CSRF.hash);
        
		$.ajax({
  	        url: $(this).prop('action'),
	 		type: $(this).prop('method'),
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
            //async:true,
            //crossDomain:true,
			success: (res) => {
			// alert(res.status);
				if (res.status=='sukses') {
					//toastrSuccess('success_messages', "Pendaftaran berhasil");
                    //window.location = "<?php //echo site_url('~/login'); ?>";
                    ///window.location.replace("<?php //echo site_url('~/login'); ?>");                    
				}else if (res.status=='adauser') {
				    alert("Nama username sudah di gunakan!");
					///toastrSuccess('Gagal', "Pendaftaran tidak berhasil");
				}else if (res.status=='adaemail') {
				    alert("Nama email sudah di gunakan!");
					///toastrSuccess('Gagal', "Pendaftaran tidak berhasil");
				} else {
					toastrError('Gagal', 'Terjadi kesalahan data');
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash

			//	table.ajax.reload();
			},
             error: (res) => {
              if(JSON.stringify(res.status)==500){
                //return res.status(500).json({error: err});
                alert("Terjadi kesalahan di server!");
              } else {
                //return res.status(200).json({success: 'Insert row success'});
                //toastrSuccess('success_messages', "Pendaftaran berhasil");
                <?php $this->session->set_flashdata('success_messages', 'Proses pendaftaran Berhasil'); ?>
                window.location.replace("login"); 
              }
			/*error: (res) => {
                alert("Terjadi kesalahan di server!");
				//toastrError('Gagal', 'Terjadi kesalahan di server');
				//table.ajax.reload();
			}*/
            }
		});
	});