<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= themeUrl() ?>assets/libs/toastr/build/toastr.min.css">


<?php if (@$datatable || @$plugins['datatable']) : ?>
	<!-- DataTables -->
	<link href="<?= $this->config->item('theme_url') ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= $this->config->item('theme_url') ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Responsive datatable examples -->
	<link href="<?= $this->config->item('theme_url') ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?php endif ?>
<?php if (@$form_wizard || @$plugins['form_wizard']) : ?>
	<!-- twitter-bootstrap-wizard css -->
	<link rel="stylesheet" href="<?= $this->config->item('theme_url') ?>assets/libs/twitter-bootstrap-wizard/prettify.css">
<?php endif ?>
<?php if (@$lightbox || @$plugins['lightbox']) : ?>
	<!-- Lightbox css -->
	<link href="<?= $this->config->item('theme_url') ?>assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
<?php endif ?>
<?php if (@$select2 || @$plugins['select2']) : ?>
	<!-- <link href="<?= $this->config->item('theme_url') ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" /> -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php endif ?>
<?php if (@$tui_chart || @$plugins['tui_chart']) : ?>
	<!-- tui charts Css -->
	<link href="<?= $this->config->item('theme_url') ?>assets/libs/tui-chart/tui-chart.min.css" rel="stylesheet" type="text/css" />
<?php endif ?>
<?php if (@$leaflet || @$plugins['leaflet']) :  ?>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
	<link href="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" integrity="sha512-gc3xjCmIy673V6MyOAZhIW93xhM9ei1I+gLbmFjUHIjocENRsLX/QUE1htk5q1XV2D/iie/VQ8DXI6Vu8bexvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php endif ?>