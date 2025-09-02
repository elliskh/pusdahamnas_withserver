<script>
	let table;
$(() => {

	$('.select2').select2({
		width: '100%'
	});

	async function generateMenu(event, ref_menu_group_id = null, menu_utama_id = null) {

		let main_menu = await $.get(base_url('getMainMenu'), {
			ref_menu_group_id: ref_menu_group_id ?? $(event.target).val(),
		}).then(res => res)
			.catch(err => err)

		let html = `<option value="">Pilih Menu Utama</option>\n`;
		html += main_menu.data.map(value => `<option value="${value.id}" ${menu_utama_id === value.id ? 'selected' : ''}>${value.nama}</option>\n`).join('')
		$('#parent_id').html(html)
	}

	$('#modal-form').on('show.bs.modal', function (event) {
		$('#ref_menu_group_id').on('change', generateMenu)
	})

	$('#modal-form').on('hide.bs.modal', function (event) {
		$('#id').val(null).trigger('change')
		$('#form-sub-menu').trigger('reset')
		$('#ref_menu_group_id').val(null).trigger('change')
		$('#parent_id').val(null).trigger('change')
		validator.resetForm()
		console.clear()
	})

	$('#table-data').on('click', '.btn-remove', function () {
		var tr = $(this).closest('tr');
		let data = table.row(tr).data();

		let { id, nama } = data;

		Swal.fire({
			title: 'Anda yakin?',
			html: `Anda akan menghapus submenu "<b>${nama}</b>"!`,
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
				$.post(base_url('deleteSubMenu'), { id, encrypted_menu_id: MENU_ID, [CSRF.token_name]: CSRF.hash })
					.done((res) => {
						console.log(res);
						if (res.status) {
							toastrSuccess('Sukses', res.message);
							table.ajax.reload(null, false);
							loadSidebar();

							CSRF.token_name = res.csrf.token_name
							CSRF.hash = res.csrf.hash
						}
					}).fail((res) => {
						console.log(res);
						toastrError('Gagal', 'Terjadi kesalahan di server');
					})
			}
		})
	})

	$('#table-data').on('click', '.btn-update', async function (event) {
		var tr = $(this).closest('tr');
		let data = table.row(tr).data();

		console.log(data);

		$('#form-sub-menu')[0].reset();

		let { id, nama, route, parent_id, urutan, ref_menu_group_id } = data;


		$('#id').val(id);
		$('#ref_menu_group_id').val(ref_menu_group_id).trigger('change');
		await generateMenu(null, ref_menu_group_id, parent_id)

		$('#nama').val(nama);
		$('#route').val(route);
		$('#urutan').val(urutan);

		$('#modal-form').modal('show');
	})

	$('#form-sub-menu').on('submit', function (e) {
		e.preventDefault();

		if (!$(this).valid()) {
			validator.focusInvalid()
			return;
		}

		let data = new FormData(this);
		data.append(CSRF.token_name, CSRF.hash)
		data.append('encrypted_menu_id', MENU_ID);

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
				$(this)[0].reset();
				$('#modal-form').modal('hide');
				table.ajax.reload(null, false);

				loadSidebar();

				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash
			},
			error: (res) => {
				$(this).find('btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				table.ajax.reload(null, false);
			}
		})
	})

	$('.btn-tambah').on('click', function () {
		$('#form-sub-menu')[0].reset();
		$('#modal-form').modal('show');
	})

	table = $('#table-data').DataTable({
		serverSide: true,
		processing: true,
		ajax: {
			url: base_url('submenuData'),
			type: 'get',
			dataType: 'json'
		},
		order: [],
		language: dtLang,
		columnDefs: [{
			targets: [0, 5, 6],
			searchable: false,
			orderable: false,
			className: 'text-center align-top w-5'
		}, {
			targets: [1, 2, 3],
			className: 'text-left align-top',
		}, {
			targets: [7],
			visible: false,
		}],
		columns: [{
			data: 'no',
			redner: (data) => {
				return data + '.';
			}
		}, {
			data: 'nama_group',
		}, {
			data: 'parent_name'
		}, {
			data: 'nama',
		}, {
			data: 'route',
			render: (data, type, row) => `<h6 class="badge badge-custom font-size-13 mb-1">${data}</h6><br>
            <a target="_blank" href="${data !== '#' ? (BASE_URL + data + '/' + row.id) : '#'}">${data !== '#' ? (BASE_URL + data + '/' + row.id).substring(0, 75) + '...' : '#'}</a>`
		}, {
			data: 'urutan',
			render: (data, type, row) => `<h6 class="badge badge-custom font-size-13">${data}</h6>`
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
	})

	validator = $('#form-sub-menu').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			ref_menu_group_id: "required",
			parent_id: 'required',
			nama: "required",
			route: "required",
			urutan: {
				required: true,
				number: true
			},
			icon: "required",
		},
		messages: {
			ref_menu_group_id: "Group menu tidak boleh kosong",
			parent_id: "Menu utama tidak boleh kosong",
			nama: "Nama sub menu tidak boleh kosong",
			route: "Link sub menu tidak boleh kosong",
			urutan: {
				required: "Urutan sub menu tidak boleh kosong",
				number: 'Urutan sub menu harus angka'
			},
		}
	});
})
</script>