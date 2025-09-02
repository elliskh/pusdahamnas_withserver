<!-- Slick -->
<link rel="stylesheet" href="<?=base_url()?>assets_landing/css/slick.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
	.slick-next:before, .slick-prev:before{
		color: #000 !important;
	}
</style>
<div class="container mt-4">
	<div class="card-body" style="margin-top: 8%;">
		<div class="row d-flex justify-content-center">
			<div class="col-md-10">
				<div class="card card-mitra mt-3">
					<?php if($detail)
					{
						$infografis_id = $detail['id']; // Ganti dengan kolom yang sesuai sebagai kunci
						$query_gambar = $this->db->get_where('image_infografis', array('infografis_id' => $infografis_id));
						$gambar_infografis = $query_gambar->result_array();
					?>
						<div class="slider-infografis align-items-center justify-content-center">
					<?php

						if ($detail['link_video'] != null ) {
							?>
							<iframe width="100%" height="600" src="<?php echo $detail['link_video']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="height: 650px !important">

							</iframe>
							
					<?php
						} else {

						foreach ($gambar_infografis as $gambar){
					?>
						<img class="img-fluid card-img-top" src="<?= ($gambar['nama_file']!="") ? base_url('uploads/infografis/'.$gambar['nama_file'].'') : '' ?>" alt="Logo">
					<?php } }?>
					</div>
					<?php }else {?>
					<img class="img-fluid card-img-top" src="<?= base_url($link_gbr) ?>" alt="Logo">
					<?php } ?>
					<div class="card-body" style="text-align:justify">
						<?php if($detail){?>
						<h4 class="font-weight-bold"><?= $detail['judul'] ?></h4>
						<p><?= $detail['deskripsi'] ?></p>
						<?php } else {?>
						<?php }?>

						<a href="/home/infografis" class="btn btn-outline-danger btn-block">Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="http://devpusdahamnas.komnasham.go.id/assets_front/libs/jquery/jquery.min.js"></script>
<script>
	function headerStyle() {
		if ($(".main-header").length) {
			var windowpos = $(window).scrollTop();
			var siteHeader = $(".main-header");
			var siteNav = $("a");
			var scrollLink = $(".scroll-top");
			const gambar = document.getElementById('logo-img');
			if (windowpos <= 100) {
				siteHeader.addClass("fixed-header");
				siteNav.addClass("text-custom");
				gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
				gambar.alt = 'gambar baru';
				scrollLink.fadeIn(300);
			} else {
				siteHeader.addClass("fixed-header");
				siteNav.addClass("text-custom");
				gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
				gambar.alt = 'gambar baru';
				scrollLink.fadeOut(300);
			}
		}
	}

	headerStyle();

	$(document).ready(function () {

		$(window).on("scroll", function () {
			// Header Style and Scroll to Top
			function headerStyle() {
				if ($(".main-header").length) {
					var windowpos = $(window).scrollTop();
					var siteHeader = $(".main-header");
					var siteNav = $("a");
					var scrollLink = $(".scroll-top");
					const gambar = document.getElementById('logo-img');
					if (windowpos >= 100) {
						siteHeader.addClass("fixed-header");
						siteNav.addClass("text-custom");
						gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
						gambar.alt = 'gambar baru';
						scrollLink.fadeIn(300);
					} else {
						//siteHeader.removeClass("fixed-header");          
						siteNav.addClass("text-custom");
						//siteNav.removeClass("text-custom");
						gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
						gambar.alt = 'gambar baru';
						scrollLink.fadeOut(300);
					}
				}
			}

			headerStyle();
		});
	});
</script>
<script>
	$(document).ready(function () {
		// slick carousel
		$('.slider-infografis').slick({
			dots: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 2000,
		});

		var limit = 3;
		// $('.slick-prev');
		// $('.slick-next');
	});
</script>