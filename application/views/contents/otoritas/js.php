<script>
let table, validator;

$(() => {
	$('#table-data').on('click', '.btn-remove', function () {
		var tr = $(this).closest('tr');
		let data = table.row(tr).data();

		let { id, nama } = data;

		Swal.fire({
			title: 'Anda yakin?',
			html: `Anda akan menghapus otoritas "<b>${nama}</b>"!`,
			footer: 'Data yang sudah dihapus tidak bisa dikembalikan kembali!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
			reverseButtons: true,
		}).then((result) => {
			if (result.isConfirmed) {
				$.post(BASE_URL + 'otoritas/delete/' + MENU_ID, { id, encrypted_menu_id: MENU_ID, [CSRF.token_name]: CSRF.hash })
					.done((res) => {
						console.log(res);
						if (res.status) {
							toastrSuccess('Sukses', res.message);
							table.ajax.reload();
							loadSidebar();
						}

						CSRF.token_name = res.csrf.token_name
						CSRF.hash = res.csrf.hash
					}).fail((res) => {
						console.log(res);
						toastrError('Gagal', 'Terjadi kesalahan di server');
					})
			}
		})
	})

	$('#table-data').on('click', '.btn-update', function () {
		var tr = $(this).closest('tr');
		let data = table.row(tr).data();

		$("#form-otoritas")[0].reset();

		let { id, nama } = data;

		$('#id').val(id);
		$('#nama').val(nama);

		$('#modal-form').modal('show');
	})

	$('#modal-form').on('hide.bs.modal', function (event) {
		$('#form-otoritas').trigger('reset')
		$('#id').val(null).trigger('change')
		validator.resetForm()
		console.clear()
	})

	$('#form-otoritas').on('submit', function (e) {
		e.preventDefault();

		if (!$(this).valid()) {
			validator.focusInvalid()
			return;
		}

		let data = new FormData(this);
		data.append('encrypted_menu_id', MENU_ID)
		data.append(CSRF.token_name, CSRF.hash)

		$.ajax({
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
			beforeSend: () => {
				$(this).find('.btn-submit').fadeOut();
			},
			success: (res) => {
				$(this).find('.btn-submit').fadeIn();
				if (res.status) {
					toastrSuccess('Sukses', res.message);

				} else {
					toastrError('Gagal', 'Terjadi kesalahan');
				}

				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash
				$(this)[0].reset();
				$('#modal-form').modal('hide');
				table.ajax.reload();
			},
			error: (res) => {
				$(this).find('.btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				table.ajax.reload();
			}
		})
	})

	$('.btn-tambah').on('click', function () {
		$('#form-otoritas')[0].reset();
		$('#modal-form').modal('show');
	});

	table = $('#table-data').DataTable({
		serverSide: true,
		processing: true,
		language: dtLang,
		ajax: {
			url: base_url('data'),
			type: 'get',
			dataType: 'json',
		},
		order: [[3, 'desc']],
		columnDefs: [{
			targets: [0, 2],
			searchable: false,
			orderable: false,
			className: 'text-center align-top w-5'
		}, {
			targets: [1],
			className: 'text-left align-top'
		}, {
			targets: [3],
			visible: false,
		}],
		columns: [{
			data: 'no',
			render: (data) => {
				return data + '.';
			}
		}, {
			data: 'nama'
		}, {
			data: 'id',
			render: (id) => {
				let button_edit = '', button_delete = '', button_access = '';
				if (UPDATE_ACCESS) {
					button_edit = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-pencil'
						}).prop('outerHTML'),
						class: 'btn btn-outline-info btn-update',
						type: 'button',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Ubah Data'
					})

					button_access = $('<a>', {
						html: $('<i>', {
							class: 'bx bx-lock-open '
						}).prop('outerHTML'),
						class: 'btn btn-outline-success btn-access',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Plotting hak akses',
						href: BASE_URL + 'otoritas/hakAkses/' + MENU_ID + '/' + id
					})
				}

				if (DELETE_ACCESS) {
					button_delete = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-trash'
						}).prop('outerHTML'),
						class: 'btn btn-outline-danger btn-remove',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Hapus Data'
					});
				}


				return $('<div>', {
					class: 'btn-group',
					html: [button_access, button_edit, button_delete]
				}).prop('outerHTML');
			}
		}, {
			data: 'created_at'
		}]
	})

	validator = $('#form-otoritas').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			nama: "required",
		},
		messages: {
			nama: "Nama otoritas tidak boleh kosong",
		}
	});
})
</script>