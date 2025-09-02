<!--====== Footer Section Start ======-->
<footer class="footer-section footer-two bg-footer-blue text-white rel z-1 pt-70" style="background-repeat:round;">
	<div class="container">

		<div class="row justify-content-between">
			<div class="col-xl-3 col-sm-6 col-7 col-small">
				<div class="footer-widget about-widget">
					<div class="footer-logo mb-20">
						<a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets_landing/images/logos/logo-pusdahamnas-white.png" alt="Logo"></a>
					</div>
					<p><span style="text-align: justify;">Sistem Informasi Pusat Sumber Daya Hak Asasi Manusia Nasional (Pusdahamnas) </span></p>
					<a href="<?= base_url('home/about')?>" class="read-more text-white">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
					<img src="<?= base_url()?>uploads/gambar_slide/30th_komnasham_white.png" style="padding-top:30px" />
				</div>

			</div>
			<div class="col-xl-2 col-sm-4 col-5 col-small">
				<div class="footer-widget link-widget">
					<h4 class="footer-title">Link Terkait</h4>
					<ul class="list-style-one list-terkait">
						<?php
								foreach ($this->db->where('is_active','1')->get('link_terkait')->result_array() as $lk)
								{
									echo'<li><a href="'.$lk['link'].'" target="_blank"><img src="'.base_url(). '/assets/img/' . $lk['gambar'].'"></a></li>';
								}
								?>
					</ul>
				</div>
			</div>
			<div class="col-xl-4 col-md-8">
				<div class="footer-widget link-widget">
					<h4 class="footer-title">Link Mitra</h4>
					<ul class="list-style-two">
						<?php       $no = 0;
                                    foreach ($this->db->where('is_active','2')->get('link_terkait')->result_array() as $lk)
                                    {   $no += 1;
                                        echo'<li><a href="'.$lk['link'].'" target="_blank">'.$lk['judul'].'</a></li>';
                                        if($no==8){
                                            $no = 0;
                                            foreach ($this->db->where('is_active','1')->get('link_terkait')->result_array() as $lk1)
                                            {
                                                $no +=1;                                              
                                               if($no==1){
                                            ?>
                                            <li><a href="#" data-toggle="modal" data-target="#mitraModal">Lihat Selengkapnya</a></li>
                                           <?php
                                               }
                                             }
                                        }
                                    }

                                ?>
                            
                            <div id="mitraModal" style="margin-top: 8%;" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel" style="color: black;">Mitra</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <?php
                                        foreach ($this->db->where('is_active','1')->get('link_terkait')->result_array() as $lk1)
                                        {
                                            echo'<li><a href="'.$lk1['link'].'" style="color:black;" target="_blank">'.$lk1['judul'].'</a></li>';      
                                         }       
                                    ?>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
					</ul>
				</div>
			</div>
			<div class="col-xl-3 col-md-4">
				<div class="footer-widget contact-widget">
					<h4 class="footer-title">Kontak Pusdahamnas</h4>
					<ul class="list-style-three">
						<li><i class="fas fa-map-marker-alt"></i> <span style="text-align: justify;">Jl. Latuharhary No.4b, Menteng, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10310</span></li>
						<li><i class="fas fa-envelope-open"></i> <span><a href="mailto:pusdahamnas@komnasham.go.id">pusdahamnas@komnasham.go.id</a></span></li>
						<li><i class="fas fa-phone"></i> <span>+62-21-3925230 <a href="#"></a></span></li>
					</ul>
					<div class="social-style-one mt-25">
						<a href="https://www.facebook.com/komnashamrepublikindonesia" target="_BLANK"><i class="fab fa-facebook-f"></i></a>
						<a href="https://twitter.com/komnasham" target="_BLANK"><i class="fab fa-twitter"></i></a>
						<a href="https://www.youtube.com/@KomnasHAM" target="_BLANK"><i class="fab fa-youtube"></i></a>
						<a href="https://www.instagram.com/komnas.ham" target="_BLANK"><i class="fab fa-instagram"></i></a>
						<a href="https://www.linkedin.com/company/komnasham" target="_BLANK"><i class="fab fa-linkedin-in"></i></a>
					</div>
					<a href='https://play.google.com/store/apps/details?id=id.go.komnasham.dataham&pcampaignid=web_share&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1' target="_BLANK"><img alt='Temukan di Google Play' style="height:70px" src='https://play.google.com/intl/en_us/badges/static/images/badges/id_badge_web_generic.png'/></a>
				</div>
			</div>
		</div>
		<div class="copyright-area text-center" style="border-top:none;">
			<p>© 2023 Hak Cipta Komnas HAM RI | Website ini ditujukan untuk kepentingan pemajuan dan penegakan HAM</p>
		</div>
	</div>
	<img class="dots-shape" src="<?= base_url() ?>assets_landing/images/shapes/dots.png" alt="Shape">
	<img class="tringle-shape" src="<?= base_url() ?>assets_landing/images/shapes/tringle.png" alt="Shape">
	<img class="close-shape" src="<?= base_url() ?>assets_landing/images/shapes/close.png" alt="Shape">
	<img class="circle-shape" src="<?= base_url() ?>assets_landing/images/shapes/circle.png" alt="Shape">
</footer>
<!--====== Footer Section End ======-->


</div>
<!--End pagewrapper-->

<!-- Scroll Top Button -->
<button class="scroll-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></button>

<!--====== Bootstrap ======-->
<script src="<?= base_url() ?>assets_landing/js/bootstrap.4.5.3.min.js"></script>

<!--====== Appear js ======-->
<script src="<?= base_url() ?>assets_landing/js/appear.js"></script>
<!--====== WOW js ======-->
<script src="<?= base_url() ?>assets_landing/js/wow.min.js"></script>
<!--====== Isotope ======-->
<script src="<?= base_url() ?>assets_landing/js/isotope.pkgd.min.js"></script>
<!--====== Circle Progress ======-->
<script src="<?= base_url() ?>assets_landing/js/circle-progress.min.js"></script>
<!--====== Image loaded ======-->
<script src="<?= base_url() ?>assets_landing/js/imagesloaded.pkgd.min.js"></script>
<!--====== Nice Select ======-->
<script src="<?= base_url() ?>assets_landing/js/jquery.nice-select.min.js"></script>
<!--====== Magnific ======-->
<script src="<?= base_url() ?>assets_landing/js/jquery.magnific-popup.min.js"></script>
<!--====== Slick Slider ======-->
<script src="<?= base_url() ?>assets_landing/js/slick.min.js"></script>
<!--====== Main JS ======-->

<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>

<script>
	$(document).ready(function () {

		var mobileWidth = 992;
		var navcollapse = $(".navigation li.dropdown");

		navcollapse.hover(function () {
			if ($(window).innerWidth() >= mobileWidth) {
				$(this).children("ul").stop(true, false, true).slideToggle(300);
				$(this).children(".megamenu").stop(true, false, true).slideToggle(300);
			}
		});

		// 03. Submenu Dropdown Toggle
		if ($(".main-header .navigation li.dropdown ul").length) {
			$(".main-header .navigation li.dropdown").append(
				'<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>'
			);

			//Dropdown Button
			$(".main-header .navigation li.dropdown .dropdown-btn").on(
				"click",
				function () {
					$(this).prev("ul").slideToggle(500);
					$(this).prev(".megamenu").slideToggle(800);
				}
			);

			//Disable dropdown parent link
			$(".navigation li.dropdown > a").on("click", function (e) {
				e.preventDefault();
			});
		}

		//Submenu Dropdown Toggle
		if ($(".main-header .main-menu").length) {
			$(".main-header .main-menu .navbar-toggle").click(function () {
				$(this).prev().prev().next().next().children("li.dropdown").hide();
			});
		}

		// 04. Search Box
		$(".nav-search > button").on("click", function () {
			$(".nav-search form").toggleClass("hide");
		});

		$('.box-counter').slick({
			dots: true,
			infinite: false,	
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 4,
			prevArrow: false,
    		nextArrow: false,
			verticalSwiping: true,
            autoplay: true,
            autoplaySpeed: 5000,
			responsive: [
                {
                    breakpoint: 1024,
                    settings:{
                        slidesToShow: 5,
                        slidesToScroll: 5,

                    }
                },
                {
                    breakpoint: 670,
                    settings:{
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480,
                    settings:{
                        slidesToShow: 1,
                        slidesToScroll:1,
                    }
                }
   
            ]
		});
	});
</script>

</body>

</html>