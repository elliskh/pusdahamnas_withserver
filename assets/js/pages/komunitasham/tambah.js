
let validator = $('#form-add-konten').validate({
	errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
	errorElement: 'div',
	errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
	highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
	unhighlight: (element) => $(element).removeClass('is-invalid').addClass('is-valid'),
	success: (element) => $(element).remove(),
	rules: {
		judul: "required",
		dekripsi: "required",
		penulis: "required",
		editor: "required",
		sumber_data: "required",
		jenis_konten: "required",
		cover: "required",
		jumlah_paragraf: "required",
		isi_konten: "required"
	},
	messages: {
		judul: "Judul tidak boleh kosong",
		dekripsi: "Dekripsi tidak boleh kosong",
		penulis: "Penulis tidak boleh kosong",
		editor: "Editor tidak boleh kosong",
		sumber_data: "Sumber data tidak boleh kosong",
		jenis_konten: "Jenis konten tidak boleh kosong",
		cover: "Cover tidak boleh kosong",
		jumlah_paragraf: "Jumlah paragraf tidak boleh kosong",
		isi_konten: "Isi konten tidak boleh kosong"
		},
	}
});

	$('#form-add-konten').on('submit', function (e) {
	    e.preventDefault();

		let data = new FormData(this);
		//data.append(CSRF.token_name, CSRF.hash)

		$.ajax({
			url: $(this).prop('action'),
			type: $(this).prop('method'),
			data: data,
            processData: false,
            contentType: false,
            beforeSend: function(request) {
            request.setRequestHeader("Authority", CSRF.hash);
          },
			success: (res) => {
				///$(this).find('.btn-submit').fadeIn();

				if (res.message=='success') { 
				    alert('Tambah data berhasil');
                    window.location.href = "login";
					toastrSuccess('Sukses', 'Tambah data berhasil');
				}else {
				    alert('Gagal proses data!');
					toastrError('Gagal', 'Terjadi kesalahan di data');
                   
				}
				//CSRF.token_name = res.csrf.token_name
				//CSRF.hash = res.csrf.hash
				///$(this)[0].reset();
			},
			error: (res) => {
				//$(this).find('.btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				
			}
		});
	});
  