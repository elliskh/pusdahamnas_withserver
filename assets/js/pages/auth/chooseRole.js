$(() => {
	$('#role_id').select2({
		width: '100%'
	})
	$('#role_id').on('change', function () {
		$('#form-choose-role').submit();
	})
})
