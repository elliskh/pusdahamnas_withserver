<script src="<?= config_item('theme_url') ?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= themeUrl() ?>assets/libs/toastr/build/toastr.min.js"></script>
<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom/cryptojs-aes-php/cryptojs-aes-format.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js" integrity="sha256-qXBd/EfAdjOA2FGrGAG+b3YBn2tn5A6bhz+LSgYD96k=" crossorigin="anonymous"></script>
<?php if (@$datatable || @$plugins['datatable']) : ?>
	<!-- Required datatable js -->
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<!-- Buttons examples -->
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/jszip/jszip.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

	<!-- Responsive examples -->
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<?php endif ?>
<?php if (@$form_wizard || @$plugins['form_wizard']) : ?>
	<!-- twitter-bootstrap-wizard js -->
	<script src="<?= config_item('theme_url') ?>assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

	<script src="<?= config_item('theme_url') ?>assets/libs/twitter-bootstrap-wizard/prettify.js"></script>
<?php endif ?>
<?php if (@$leaflet || @$plugins['leaflet']) : ?>
	<!-- Leaflet.js -->
	<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
	<!-- Leaflet AJAX -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js" integrity="sha512-Abr21JO2YqcJ03XGZRPuZSWKBhJpUAR6+2wH5zBeO4wAw4oksr8PRdF+BKIRsxvCdq+Mv4670rZ+dLnIyabbGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- Leaflet Fullscreen -->
	<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
	<!-- Maki Markers -->
	<script src="<?= base_url('assets/custom/makimarkers/Leaflet.MakiMarkers.js') ?>"></script>
	<!-- Esri Leaflet -->
	<script src="https://unpkg.com/esri-leaflet@3.0.7/dist/esri-leaflet.js" integrity="sha512-ciMHuVIB6ijbjTyEdmy1lfLtBwt0tEHZGhKVXDzW7v7hXOe+Fo3UA1zfydjCLZ0/vLacHkwSARXB5DmtNaoL/g==" crossorigin=""></script>
	<!-- Leaflet Draw -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js" integrity="sha512-ozq8xQKq6urvuU6jNgkfqAmT7jKN2XumbrX1JiB3TnF7tI48DPI4Gy1GXKD/V3EExgAs1V+pRO7vwtS1LHg0Gw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php endif ?>
<?php if (@$apex_chart || @$plugins['apex_chart']) : ?>
	<!-- apexcharts -->
	<script src="<?= config_item('theme_url') ?>assets/libs/apexcharts/apexcharts.min.js"></script>
<?php endif ?>
<?php if (@$lightbox || @$plugins['lightbox']) : ?>
	<!-- Magnific Popup-->
	<script src="<?= config_item('theme_url') ?>assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<?php endif ?>
<?php if (@$select2 || @$plugins['select2']) : ?>
	<script src="<?= config_item('theme_url') ?>assets/libs/select2/js/select2.min.js"></script>
<?php endif ?>
<?php if (@$tui_chart || @$plugins['tui_chart']) : ?>
	<!-- tui charts plugins -->
	<script src="<?= config_item('theme_url') ?>assets/libs/tui-chart/tui-chart-all.min.js"></script>
<?php endif ?>
<?php if (@$chart_js || @$plugins['chart_js']) : ?>
	<!-- Chart JS -->
	<script src="<?= config_item('theme_url') ?>assets/libs/chart.js/Chart.bundle.min.js"></script>
	<script src="<?= config_item('theme_url') ?>assets/js/pages/chartjs.init.js"></script>
<?php endif ?>
<?php if (@$uuid || @$plugins['uuid']) : ?>
	<script src="https://unpkg.com/uuid@latest/dist/umd/uuidv4.min.js"></script>
<?php endif ?>
<?php if (@$jquery_validate || @$plugins['jquery_validate']) : ?>
	<!-- JQuery Validate -->
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<?php endif ?>
<?php if (@$input_mask || @$plugins['input_mask']) : ?>
	<script src="<?= config_item('theme_url') ?>assets/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<?php endif ?>

<script>
$('.select2-multiple').select({
    placeholder: 'select',
		allowClear: true,
})
</script>