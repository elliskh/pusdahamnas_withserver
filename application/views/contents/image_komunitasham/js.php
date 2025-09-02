<script>
	let table;
$(() => {
	$('#modal-tambah').on('hide.bs.modal', function (event) {
		$('#form-tambah-user').trigger('reset')
		validator.tambah.resetForm()
	})

	$('#modal-ubah').on('hide.bs.modal', function (event) {
		$('#form-ubah-user').trigger('reset')
		$('#form-ubah-user').data('id', null)
		validator.ubah.resetForm()
	})

	$('#table-data').on('click', '.btn-remove', function () {
		let tr = $(this).closest('tr');
		let data = table.row(tr).data();

		let { id, gambar } = data;

		Swal.fire({
			title: 'Anda yakin?',
			html: `Anda akan menghapus gambar "<b>${gambar}</b>"!`,
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
				$.post(BASE_URL + 'image_komunitasham/deleteKonten/' + MENU_ID, { id, [CSRF.token_name]: CSRF.hash }).done((res) => {
					if (res.status) {
						toastrSuccess('Sukses', res.message);
						table.ajax.reload();
						loadSidebar();
					}

					CSRF.token_name = res.csrf.token_name
					CSRF.hash = res.csrf.hash
				}).fail((res) => {
					toastrError('Gagal', 'Terjadi kesalahan di server');
				})
			}
		})
	})

	$('#table-data').on('change', '.change-active', function () {
		let id = $(this).data('user_id')
		let checked = $(this).prop('checked');

		$.post(BASE_URL + 'image_komunitasham/changeKontenActive/' + MENU_ID, { id, val: (checked ? 1 : 0), [CSRF.token_name]: CSRF.hash}).done((res) => {
    		if(res.status==true){
    				toastrSuccess('Sukses', res.message);
    				table.ajax.reload();
    				CSRF.token_name = res.csrf.token_name;
    				CSRF.hash = res.csrf.hash;
            }else{
    			toastrError('Gagal', 'Data update gagal!');
    			table.ajax.reload();
            }
		}).fail((res) => {
			toastrError('Gagal', 'Terjadi kesalahan');
			table.ajax.reload();
		})
	})

	$('#form-ubah-user').on('submit', function (e) {
		e.preventDefault();

		if (!$(this).valid()) {
			validator.ubah.focusInvalid()
			return;
		}

		let data = new FormData(this);
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
				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash
				$(this)[0].reset();
				$('#modal-ubah-user').modal('hide');
				table.ajax.reload();
			},
			error: (res) => {
				$(this).find('.btn-submit').fadeIn();
				toastrError('Gagal', 'Terjadi kesalahan di server');
				table.ajax.reload();
			}
		})
	})

	$('#table-data').on('click', '.btn-update', function () {
		let tr = $(this).closest('tr');
		let data = table.row(tr).data();
        let url_edit  = '<?= '' . $link . '/' . $menu_id . '' ?>'.replace('tambah','edit_konten');

        window.location = url_edit.replace('<?= $menu_id?>',data.id);
        
		/*$('#form-ubah-user')[0].reset();

		let { id, username, nama } = data;

		$('input[name=id]').val(id);
		$('#ubah-username').val(username);
		$('#ubah-nama').val(nama);

		$('#modal-ubah-user').modal('show');*/
	})

	$('#form-tambah-user').on('submit', function (e) {
		e.preventDefault();

		if (!$(this).valid()) {
			validator.tambah.focusInvalid()
			return;
		}

		let data = new FormData(this);
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
				CSRF.token_name = res.csrf.token_name
				CSRF.hash = res.csrf.hash

				$(this)[0].reset();
				$('#modal-tambah-user').modal('hide');
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
		$('#form-tambah-user')[0].reset();
		$('#modal-tambah-user').modal('show');
	})
 
	table = $('#table-data').DataTable({	    
        destroy: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
        order: [],
        dom: 'lBfrtip',
        buttons: [
             'csv', 'excel', 'pdf', 'print'
        ],
		ajax: {
			url: BASE_URL + 'image_komunitasham/data/' + MENU_ID,
			type: 'get',
			dataType: 'json'
		}, 
		order: [[5, 'desc']],
		columnDefs: [{
			targets: [0, 4, 5],
			searchable: false,
			orderable: false,
			className: 'text-center align-top w-4'
		}, {
		//	targets: [1],
		//	className: 'text-left'
		}, {
			targets: [5], 
			visible: false,
		}],
		columns: [{
			data: 'no',
			render: (data) => {
				return data + '.'
			}
		}, {
			data: 'deskripsi',
            render: function ( data, type, row ) {
                return data.length > 25 ?
                    data.substr( 0, 25 ) + '.'+ '.'+ '.' : data;
            }
		}, {
			data: 'gambar'
		},  {
			data: 'is_active',
			render: (data, type, row) => {
				let { id } = row;
      //alert(row.tipe_daftar);
            <?php 
              $check_ss = decrypt($this->session->userdata('id'));
            ?>
            if(row.tipe_daftar==2 && <?php echo $check_ss;?> > 30){
				return `                
                    <label class="custom-control-label-" for="active-${id}">${data == '1' ? 'Aktif' : 'Nonaktif'}</label>                
                `;
            }else{
				return `
                <div class="custom-control custom-switch mb-3" dir="ltr">
                    <input type="checkbox" class="custom-control-input change-active" name="active-${id}" id="active-${id}" data-user_id="${id}" ${data == '1' ? 'checked' : ''}>
                    <label class="custom-control-label" for="active-${id}">${data == '1' ? 'Aktif' : 'Nonaktif'}</label>
                </div>
                `;                
            }    
                
			}
		}, {
			data: 'id',
			render: (id, data, row) => {
				let button_edit = '', button_delete = '';
            <?php 
              $check_ss = decrypt($this->session->userdata('id'));
            ?>

			   if(row.tipe_daftar==2 && <?php echo $check_ss;?> > 30){	
			     if(row.is_active==1){
                  if (UPDATE_ACCESS) {                    
					button_edit = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-pencil'
						}).prop('outerHTML'),
						class: 'btn btn-outline-info btn-update',
						type: 'button',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						//title: 'Ubah Data',
                        disabled: true
                        
					});
				  }
                  
     				if (DELETE_ACCESS) {
    					button_delete = $('<button>', {
    						html: $('<i>', {
    							class: 'bx bx-trash'
    						}).prop('outerHTML'),
    						class: 'btn btn-outline-danger btn-remove',
    						'data-toggle': 'tooltip',
    						'data-placement': 'top',
    						//title: 'Hapus Data',
                            disabled: true
    					});
    				}
                }else{
                  if (UPDATE_ACCESS) {                    
					button_edit = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-pencil'
						}).prop('outerHTML'),
						class: 'btn btn-outline-info btn-update',
						type: 'button',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Ubah Data',
                        disabled: false
                        
					});
				  }
                  
     				if (DELETE_ACCESS) {
    					button_delete = $('<button>', {
    						html: $('<i>', {
    							class: 'bx bx-trash'
    						}).prop('outerHTML'),
    						class: 'btn btn-outline-danger btn-remove',
    						'data-toggle': 'tooltip',
    						'data-placement': 'top',
    						title: 'Hapus Data',
                            disabled: false
    					});
    				}                    
                }    
                    
                }else{
                  if (UPDATE_ACCESS) {
					button_edit = $('<button>', {
						html: $('<i>', {
							class: 'bx bx-pencil'
						}).prop('outerHTML'),
						class: 'btn btn-outline-info btn-update',
						type: 'button',
						'data-toggle': 'tooltip',
						'data-placement': 'top',
						title: 'Ubah Data',
                        disabled: false
                        
					});
				  }       
                  
 				   if (DELETE_ACCESS) {
    					button_delete = $('<button>', {
    						html: $('<i>', {
    							class: 'bx bx-trash'
    						}).prop('outerHTML'),
    						class: 'btn btn-outline-danger btn-remove',
    						'data-toggle': 'tooltip',
    						'data-placement': 'top',
    						title: 'Hapus Data',
                            disabled: false
    					});
    				}            
                }
   



				return $('<div>', {
					class: 'btn-group',
					html: [button_edit, button_delete]
				}).prop('outerHTML');
			}
		}, {
			data: 'deleted_at'
		}]

	})
})
 
 function format(d) {
    return (
        'Sumber data : ' +
        d.sumber_data +
        '<br>' +
        'Sampul : ' +
        d.cover +
        '<br>'
    );
}
// Array to track the ids of the details displayed rows
table = $('#table-data').DataTable();
const detailRows = [];
table.on('click', 'tbody td.dt-control', function () {

    let tr = event.target.closest('tr');
    let row = table.row(tr);
    let idx = detailRows.indexOf(tr.id);
 
    if (row.child.isShown()) {
        tr.classList.remove('details');
        row.child.hide();
 
        // Remove from the 'open' array
        detailRows.splice(idx, 1);
    }
    else {
        tr.classList.add('details');
        row.child(format(row.data())).show();
 
        // Add to the 'open' array
        if (idx === -1) {
            detailRows.push(tr.id);
        }
    }
});
 
// On each draw, loop over the `detailRows` array and show any child rows
table.on('draw', () => {
    detailRows.forEach((id, i) => {
        let el = document.querySelector('#' + id + ' td.dt-control');
 
        if (el) {
            el.dispatchEvent(new Event('click', { bubbles: true }));
        }
    });
});

const validator = {
	tambah: $('#form-tambah-user').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			username: "required",
			nama: "required",
			password: {
				"required": true,
				"minlength": 8,
			},
			password_confirmation: {
				"required": true,
				"minlength": 8,
				"equalTo": '#password',
			},
		},
		messages: {
			username: "Username tidak boleh kosong",
			nama: "Nama lengkap tidak boleh kosong",
			password: {
				"required": "Kata sandi tidak boleh kosong",
				"minlength": "Kata sandi minimal 8 karakter",
			},
			password_confirmation: {
				"required": "Konfirmasi kata sandi tidak boleh kosong",
				"minlength": "Konfirmasi kata sandi minimal 8 karakter",
				"equalTo": "Konfirmasi kata sandi tidak sama",
			},
		}
	}),

	ubah: $('#form-ubah-user').validate({
		errorClass: 'text-left invalid-feedback animate__animated animate__fadeInDown',
		errorElement: 'div',
		errorPlacement: (error, element) => $(element).closest('.form-group').append(error),
		highlight: (element) => $(element).removeClass('is-invalid').addClass('is-invalid'),
		unhighlight: (element) => $(element).removeClass('is-invalid'),
		success: (element) => $(element).remove(),
		rules: {
			username: "required",
			nama: "required",
		},
		messages: {
			username: "Username tidak boleh kosong",
			nama: "Nama lengkap tidak boleh kosong",
		}
	}),
  }
</script>