<script>
let table, validator;
$(() => {
	$('.select2').select2({
		width: '100%'
	});

	$('#modal-form').on('hide.bs.modal', function (event) {
		$('#form-menu').trigger('reset')
		$('#id').val(null).trigger('change')
		$('#ref_menu_group_id').val(null).trigger('change')
		validator.resetForm()
		console.clear()
	})

	$('#table-data').on('click', '.btn-remove', function () {
		let tr = $(this).closest('tr');
		let data = table.row(tr).data();

		let { id, nama } = data;

		Swal.fire({
			title: 'Anda yakin?',
			html: `Anda akan menghapus menu "<b>${nama}</b>"!`,
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
				$.post(base_url('deleteMainMenu'), { id, encrypted_menu_id: MENU_ID, [CSRF.token_name]: CSRF.hash })
					.done((res) => {
						console.log(res);
						if (res.status) {
							toastrSuccess('Sukses', res.message);
							table.ajax.reload(null, false);
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
		let tr = $(this).closest('tr');
		let data = table.row(tr).data();

		console.log(data);

		$('#form-menu')[0].reset();

		let { id, icon, nama, route, path, urutan, ref_menu_group_id } = data;

		$('#modal-form').modal('show');

		$('#id').val(id);
		$('#ref_menu_group_id').val(ref_menu_group_id).trigger('change');
		$('#nama').val(nama);
		$('#urutan').val(urutan);
		$('#icon').val(icon);
		$('#route').val(route);
		$('#path').val(path);
	});

	$('#form-menu').on('submit', function (e) {
		e.preventDefault();

		if (!$(this).valid()) {
			validator.focusInvalid()
			return;
		}

		let data = new FormData(this);

		data.append('encrypted_menu_id', MENU_ID);
		data.append(CSRF.token_name, CSRF.hash)

		$.ajax({
			url: $(this).prop('action'),
			type: $(this).prop('method'),
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
				$(this)[0].reset();
				$('#modal-form').modal('hide');
				table.ajax.reload(null, false);

				loadSidebar();

				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash
			},
			error: (res) => {
				$(this).find('.btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				table.ajax.reload(null, false);
			}
		})
	})

	$('.pilih-icon').on('click', function () {
		let icon_name = $(this).data('icon_name');

		$('input[name=icon]').val(icon_name);
	})

	$('.table-icons').DataTable();

	$('.btn-tambah').on('click', function () {
		$('#form-menu')[0].reset();
		$('#modal-form').modal('show');
	});

	table = $('#table-data').DataTable({
		serverSide: true,
		processing: true,
		ajax: {
			url: base_url('menuData'),
			type: 'get',
			dataType: 'json'
		},
		order: [],
		language: dtLang,
		columnDefs: [{
			targets: [0, 4, 6],
			searchable: false,
			orderable: false,
			className: 'text-center align-top w-5'
		}, {
			targets: [1, 2, 3, 4, 5],
			className: 'text-left align-top',
		}, {
			targets: [7],
			visible: false,
		}],
		columns: [{
			data: 'no',
			render: (data) => {
				return data + '.';
			}
		}, {
			data: 'nama_group',
		}, {
			data: 'nama'
		}, {
			data: 'route',
			render: (data, type, row) => `<h6 class="badge badge-custom font-size-13 mb-1">${data}</h6><br>
            <a target="_blank" href="${data !== '#' ? (BASE_URL + data + '/' + row.id) : '#'}">${data !== '#' ? (BASE_URL + data + '/' + row.id).substring(0, 75) + '...' : '#'}</a>`
		}, {
			data: 'urutan',
			render: (data, type, row) => `<h6 class="badge badge-custom font-size-13">${data}</h6>`
		}, {
			data: 'icon',
			render: (data) => {
				if (data == null) return '';
				return $('<i>', {
					class: data
				}).prop('outerHTML') + ' ' + data
			}
		}, {
			data: 'id',
			render: (id, type, row) => {
				let button_edit = '', button_delete = '';
				if (UPDATE_ACCESS) {
					button_edit = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-pencil'
						}).prop('outerHTML'),
						class: 'btn btn-outline-info btn-update',
						type: 'button',
						'data-id': id,
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Ubah Data'
					})
				}

				if (DELETE_ACCESS) {
					button_delete = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-trash'
						}).prop('outerHTML'),
						class: 'btn btn-outline-danger btn-remove',
						'data-id': id,
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Hapus Data'
					});
				}

				return $('<div>', {
					class: 'btn-group',
					html: [button_edit, button_delete]
				}).prop('outerHTML');
			}
		}, {
			data: 'created_at'
		}]
	});

	validator = $('#form-menu').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			ref_menu_group_id: "required",
			nama: "required",
			route: "required",
			path: "required",
			urutan: {
				required: true,
				number: true
			},
			icon: "required",
		},
		messages: {
			ref_menu_group_id: "Group menu tidak boleh kosong",
			nama: "Nama menu tidak boleh kosong",
			route: "Link menu tidak boleh kosong",
			path: "Path menu tidak boleh kosong",
			urutan: {
				required: "Urutan menu tidak boleh kosong",
				number: 'Urutan menu harus angka'
			},
			icon: "Ikon menu tidak boleh kosong",
		}
	});
})
</script>