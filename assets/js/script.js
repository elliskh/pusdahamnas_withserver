"use strict";

/**
 * Keperluan disable inspect element
 */
// ================================================== //

// Disable right click
// $(document).contextmenu((event) => event.preventDefault())

// $(document).keydown(function (event) {
//     // Disable F12
//     if (event.keyCode == 123) return false;

//     // Disable Ctrl + Shift + I
//     if (event.ctrlKey &&
//         event.shiftKey &&
//         event.keyCode == 'I'.charCodeAt(0)) return false;


//     // Disable Ctrl + Shift + J
//     if (event.ctrlKey &&
//         event.shiftKey &&
//         event.keyCode == 'J'.charCodeAt(0)) return false;

//     // Disable Ctrl + U
//     if (event.ctrlKey &&
//         event.keyCode == 'U'.charCodeAt(0)) return false;
// })
// ================================================== //

const getMeta = (meta_name) => {
	let meta = $(`meta[name=${meta_name}]`);
	return meta.attr('content');
}

const checkAccess = (access_name) => {
	let value = parseInt($(`input:hidden[name=${access_name}_access]`).val());

	if (value) return true;

	return false;
}

const dtLang = {
	processing: 'Memuat data',
	paginate: {
		first: '<<',
		previous: '<',
		next: '>',
		last: '>>'
	},
	lengthMenu: 'Menampilkan _MENU_ data',
	search: 'Pencarian: ',
	info: 'Menampilkan _START_ ke _END_ dari _TOTAL_ data',
	infoEmpty: 'Kosong',
	infoFiltered: '(Tersaring dari _MAX_ data)',
	emptyTable: 'Data kosong'
};

const dtDom = "<'row mb-2'<'col-sm-6 text-left container-export'><'col-sm-6 text-right'B>>" +
	"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
	"<'row'<'col-sm-12'tr>>" +
	"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";

const dtButtons = {
	buttons: [
		{
			className: 'btn bg-theme-custom text-white btn-rounded waves-effect waves-light btn-tambah',
			text: $('<i>', {
				class: 'bx bx-plus-circle'
			}).prop('outerHTML') + ' Tambah', // Tambah Data
			action: (e, dt, node, config) => $('#modal-tambah').modal('show')
		},
	],
	dom: {
		button: {
			className: 'btn'
		},
		buttonLiner: {
			tag: null
		}
	}
};

const dtErrorHandler = function (error) {
	console.error(error)
	if (error.status === 403) {
		let timerInterval;
		Swal.fire({
			title: 'Perhatian',
			icon: 'info',
			html: 'Terjadi kesalahan di server.<br>Halaman akan reload dalam <b></b> milliseconds...',
			showConfirmButton: false,
			allowOutsideClick: false,
			allowEscapeKey: false,
			timer: 3000,
			timerProgressBar: true,
			didOpen: () => {
				Swal.showLoading()
				const b = Swal.getHtmlContainer().querySelector('b')
				timerInterval = setInterval(() => {
					b.textContent = Swal.getTimerLeft()
				}, 100)
			},
			willClose: () => {
				clearInterval(timerInterval)
			}
		}).then(() => {
			location.reload();
		})
	}
}

$.LoadingOverlaySetup({
	background: "rgba(255, 255, 255, 0.3)",
});

if (toastr?.options) {
	toastr.options = {
		closeButton: false,
		debug: false,
		newestOnTop: true,
		progressBar: true,
		positionClass: "toast-top-right",
		preventDuplicates: false,
		onclick: null,
		showDuration: 300,
		hideDuration: 1000,
		timeOut: 5000,
		extendedTimeOut: 1000,
		showEasing: "swing",
		hideEasing: "linear",
		showMethod: "fadeIn",
		hideMethod: "fadeOut"
	}
}

$('body').on('draw.dt', function (e, ctx) {
	$('[data-toggle="tooltip"]').tooltip()
	$(document).on('click', '[rel="tooltip"]', function () {
		$(this).tooltip('hide')
	})
});

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': getMeta('csrf-hash'),
		"X-Requested-With": "XMLHttpRequest"
	},
});

let { fetch: _oldFetch } = window;

window.fetch = async (url = '', config = {
	method: 'GET', // *GET, POST, PUT, DELETE, etc.
	mode: 'cors', // no-cors, *cors, same-origin
	cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
	credentials: 'same-origin', // include, *same-origin, omit
	headers: {},
	redirect: 'follow', // manual, *follow, error
	referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
	body: {} // body data type must match "Content-Type" header
}) => {

	let initialHeaders = {
		'X-CSRF-TOKEN': getMeta('csrf-hash'),
		'X-Requested-With': 'XMLHttpRequest',
	};

	if (!(config['body'] instanceof FormData)) {
		initialHeaders['Content-Type'] = 'application/x-www-form-urlencoded';
		config['body'] = new URLSearchParams(config['body']);
	}

	let headers = Object.assign(initialHeaders, config['headers']);

	// Default options are marked with *
	const res = await _oldFetch(url, {
		method: config['method'], // *GET, POST, PUT, DELETE, etc.
		mode: config['mode'], // no-cors, *cors, same-origin
		cache: config['cache'], // *default, no-cache, reload, force-cache, only-if-cached
		credentials: config['credentials'], // include, *same-origin, omit
		headers: headers,
		redirect: config['redirect'], // manual, *follow, error
		referrerPolicy: config['referrerPolicy'], // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
		body: config['body'] // body data type must match "Content-Type" header
	});

	let { ok, status } = res

	let message = "";
	if (!ok) {
		if (status === 403 || status === 500) {
			message = 'Terjadi kesalahan di server'
			let timerInterval;
			Swal.fire({
				title: 'Perhatian',
				icon: 'info',
				html: 'Terjadi kesalahan di server.<br>Halaman akan reload dalam <b></b> milliseconds...',
				showConfirmButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false,
				timer: 3000,
				timerProgressBar: true,
				didOpen: () => {
					Swal.showLoading()
					const b = Swal.getHtmlContainer().querySelector('b')
					timerInterval = setInterval(() => {
						b.textContent = Swal.getTimerLeft()
					}, 100)
				},
				willClose: () => {
					clearInterval(timerInterval)
				}
			}).then(() => {
				// location.reload();
			})

			throw new Error(message);
		}

		let errorResponse = await res.json();
		return Promise.resolve(errorResponse);
	}
	let successResponse = await res.json();  // parses JSON response into native JavaScript objects
	return Promise.resolve(successResponse)
}

(function ($) {
	$.fn.inputFilter = function (inputFilter) {
		return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
		});
	};
}(jQuery));

if ($?.validator) {
	$.validator.addMethod('filesize', function (value, element, param) {
		return this.optional(element) || (element.files[0].size <= param)
	}, 'File size must be less than {0} bytes');

	$.validator.addMethod("exactlength", function (value, element, param) {
		return this.optional(element) || value.length == param;
	}, $.validator.format("Please enter exactly {0} characters."));
}

window.BASE_URL = getMeta('base_url');
window.MODE = getMeta('mode');
window.SIDEBAR = getMeta('sidebar');
window.PATH = getMeta('path');
window.MENU_ID = $('#menu_id').val();
window.MENU_ACTIVE = $('#menu_active').val();
window.MENU_OPEN = $('#menu_open').val();
window.CSRF = {
	token_name: getMeta('csrf-token_name'),
	hash: getMeta('csrf-hash'),
}

window.CREATE_ACCESS = checkAccess('tambah') || false;
window.UPDATE_ACCESS = checkAccess('ubah') || false;
window.DELETE_ACCESS = checkAccess('hapus') || false;

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

if ($.fn.datepicker) {
	$('#tombol-session-tahun').datepicker({
		format: "yyyy",
		minViewMode: 2,
		clearBtn: true,
		autoclose: true
	}).on('changeYear', function (event) {
		$.LoadingOverlay('show')
		$.get(BASE_URL + 'changeTahun', {
			tahun: new Date(event.date).getFullYear(),
		}).then(res => {
			toastrSuccess('Sukses', res.message)
			$.LoadingOverlay('hide')
			setTimeout(() => {
				location.reload()
			}, 2000);
		})
			.catch(err => toastrError('Gagal', 'Terjadi kesalahan di server'))
			.then(() => setTimeout(() => location.reload(), 2000))
	}).on('hide', function (event) {
		event.stopPropagation();
	});

	$('#tombol-session-tahun').datepicker('update', new Date(getMeta('tahun'), 1, 1));
}


$('#modal-profil').on('hide.bs.modal', function (event) {
	$('#form-profil').find('input').removeClass('is-invalid')
	$('#form-profil').find('div > span.text-danger').empty()
	$('#form-profil').find('input#profil-password, input#profil-password_confirmation').val(null).trigger('change')
})

const base_url = (url) => {
	return BASE_URL + PATH + url + '/' + MENU_ID
}

const getCookie = (name) => {
	const value = `; ${document.cookie}`;
	const parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}

const hex2bin = (s) => {
	const ret = []
	let i = 0
	let l
	s += ''
	for (l = s.length; i < l; i += 2) {
		const c = parseInt(s.substr(i, 1), 16)
		const k = parseInt(s.substr(i + 1, 1), 16)
		if (isNaN(c) || isNaN(k)) return false
		ret.push((c << 4) | k)
	}
	return String.fromCharCode.apply(String, ret)
}

const bin2hex = (s) => {
	let i, l, o = "", n;

	s += "";

	for (i = 0, l = s.length; i < l; i++) {
		n = s.charCodeAt(i).toString(16)
		o += n.length < 2 ? "0" + n : n;
	}

	return o;
}

const numberFormat = (val) => {
	if (val != null) {
		val = val.toString().replace(/,/g, ''); //remove existing commas first
		let valSplit = val.split('.'); //then separate decimals

		while (/(\d+)(\d{3})/.test(valSplit[0].toString())) {
			valSplit[0] = valSplit[0].toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
		}

		if (valSplit.length == 2) { //if there were decimals
			val = valSplit[0] + "." + valSplit[1]; //add decimals back
		} else {
			val = valSplit[0];
		}

		return val;
	} else {
		return '-';
	}
}

const formatRupiah = (angka, prefix) => {
	let number_string = angka.replace(/[^,\d]/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

const formatTanggal = (date = new Date()) => {
	let tahun = date.getFullYear();
	let bulan = date.getMonth();
	let tanggal = date.getDate();
	let hari = date.getDay();
	let jam = date.getHours();
	let menit = date.getMinutes();
	let detik = date.getSeconds();
	switch (hari) {
		case 0:
			hari = "Minggu";
			break;
		case 1:
			hari = "Senin";
			break;
		case 2:
			hari = "Selasa";
			break;
		case 3:
			hari = "Rabu";
			break;
		case 4:
			hari = "Kamis";
			break;
		case 5:
			hari = "Jum'at";
			break;
		case 6:
			hari = "Sabtu";
			break;
	}

	switch (bulan) {
		case 0:
			bulan = "Januari";
			break;
		case 1:
			bulan = "Februari";
			break;
		case 2:
			bulan = "Maret";
			break;
		case 3:
			bulan = "April";
			break;
		case 4:
			bulan = "Mei";
			break;
		case 5:
			bulan = "Juni";
			break;
		case 6:
			bulan = "Juli";
			break;
		case 7:
			bulan = "Agustus";
			break;
		case 8:
			bulan = "September";
			break;
		case 9:
			bulan = "Oktober";
			break;
		case 10:
			bulan = "November";
			break;
		case 11:
			bulan = "Desember";
			break;
	}

	return `${hari}, ${tanggal} ${bulan} ${tahun}`
}

const currentTime = () => {
	let date = new Date();

	let tahun = date.getFullYear();
	let bulan = date.getMonth();
	let tanggal = date.getDate();
	let hari = date.getDay();

	switch (hari) {
		case 0:
			hari = "Minggu";
			break;
		case 1:
			hari = "Senin";
			break;
		case 2:
			hari = "Selasa";
			break;
		case 3:
			hari = "Rabu";
			break;
		case 4:
			hari = "Kamis";
			break;
		case 5:
			hari = "Jum'at";
			break;
		case 6:
			hari = "Sabtu";
			break;
	}

	switch (bulan) {
		case 0:
			bulan = "Januari";
			break;
		case 1:
			bulan = "Februari";
			break;
		case 2:
			bulan = "Maret";
			break;
		case 3:
			bulan = "April";
			break;
		case 4:
			bulan = "Mei";
			break;
		case 5:
			bulan = "Juni";
			break;
		case 6:
			bulan = "Juli";
			break;
		case 7:
			bulan = "Agustus";
			break;
		case 8:
			bulan = "September";
			break;
		case 9:
			bulan = "Oktober";
			break;
		case 10:
			bulan = "November";
			break;
		case 11:
			bulan = "Desember";
			break;
	}

	let hh = date.getHours();
	let mm = date.getMinutes();
	let ss = date.getSeconds();
	let session = "AM";


	if (hh > 12) {
		session = "PM";
	}

	hh = (hh < 10) ? "0" + hh : hh;
	mm = (mm < 10) ? "0" + mm : mm;
	ss = (ss < 10) ? "0" + ss : ss;

	let time = `<h1>${hh}:${mm}:${ss} ${session} </h1> <p>${hari}, ${tanggal} ${bulan} ${tahun}</p>`;

	$('#waktu').html(time)
	setTimeout(function () { currentTime() }, 200);
}

currentTime();

const toastrSuccess = (title, message = null) => {
	toastr.success(message, title);
}

const toastrError = (title, message = null) => {
	toastr.error(message, title);
}

const capitalizeFirstLetter = (string) => {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

const darkMode = () => {
	$.LoadingOverlay('show')
	$.get(BASE_URL + 'darkMode')
		.then(({ message }) => {
			$.LoadingOverlay('hide');
			toastrSuccess('Sukses', message)
			setTimeout(() => {
				location.reload()
			}, 2000);
		})
}

const lightMode = () => {
	$.LoadingOverlay('show')
	$.get(BASE_URL + 'lightMode')
		.then(({ message }) => {
			$.LoadingOverlay('hide');
			toastrSuccess('Sukses', message)
			setTimeout(() => {
				location.reload()
			}, 2000);
		})
}

const onChangeMode = (element) => {
	$.LoadingOverlay('show')
	$.get(BASE_URL + $(element).val() + 'Mode')
		.then(({ message }) => {
			$.LoadingOverlay('hide');
			toastrSuccess('Sukses', message)
			setTimeout(() => {
				location.reload()
			}, 2000);
		})
}

const onChangeSidebar = (element) => {
	$.LoadingOverlay('show')
	$.get(BASE_URL + 'changeSidebar?sidebar=' + $(element).val())
		.then(({ message }) => {
			$.LoadingOverlay('hide');
			toastrSuccess('Sukses', message)
			setTimeout(() => {
				location.reload()
			}, 2000);
		})
}

const onSubmitProfil = (element) => {

	// Before send
	$(element).find('.btn-submit').fadeOut();
	$(element).LoadingOverlay('show')
	// ------------------------------------------------

	let formData = new FormData(element);
	formData.append(CSRF.token_name, CSRF.hash)
	formData.append('id', $(element).data('id'))

	fetch(BASE_URL + 'editProfil', {
		method: 'POST',
		body: formData
	}).then(res => {	// Success
		let { message, code, csrf } = res

		if (code === 200) {
			$('#modal-profil').modal('hide');
			toastrSuccess('Sukses', message);
		}
		else if (code === 404) toastrError('Gagal', message);
		else if (code === 422) {
			toastrError('Gagal', message);
			let { errors } = res
			for (const error in errors) {
				if (Object.hasOwnProperty.call(errors, error)) {
					const message = errors[error];
					$('input#profil-' + error).addClass('is-invalid')
					$('#error-profil-' + error).html(`<span class="text-danger">${message}</span>`)
				}
			}
		}

		CSRF.token_name = csrf.token_name
		CSRF.hash = csrf.hash
		datatable.ajax.reload(null, false);
		// ------------------------------------------------
	}).catch(err => {	// Error
		let { message } = err;
		toastrError('Gagal', message);
		// ------------------------------------------------
	}).finally(() => { // Complete
		$(element).find('.btn-submit').fadeIn();
		$(element).LoadingOverlay('hide')
		// ------------------------------------------------
	})
}

const cryptoJsAesEncrypt = (valueToEncrypt) => {
	let password = atob(hex2bin(getMeta('cryptoJsAes')))
	let encrypted = CryptoJSAesJson.encrypt(valueToEncrypt, password)
	return encrypted;
}

const cryptoJsAesDecrypt = (encrypted) => {
	let password = atob(hex2bin(getMeta('cryptoJsAes')))
	let decrypted = CryptoJSAesJson.decrypt(encrypted, password)
	return decrypted;
}