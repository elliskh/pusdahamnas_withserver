<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title><?= sistem()->nama ?> <?= @$title ? '- ' . $title : '' ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?= sistem()->deskripsi ?>" name="description" />
	<meta content="<?= sistem()->author ?>" name="author" />

	<meta content="<?= @csrf()['token_name'] ?>" name="csrf-token_name" />
	<meta content="<?= @csrf()['hash'] ?>" name="csrf-hash" />
	<meta content="<?= base_url() ?>" name="base_url" />
	<meta content="<?= @$path ?>" name="path" />
	<meta content="<?= session('tahun') ?>" name="tahun" />
	<meta content="<?= session('mode') ?>" name="mode" />
	<meta content="<?= session('sidebar') ?>" name="sidebar" />
	<meta content="<?= bin2hex(base64_encode(config_item('cryptojs_aes_password'))) ?>" name="cryptoJsAes" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url('assets/img/img-komnasham-favicon.png') ?>">

	<link href="<?= base_url('assets_front/libs/owl.carousel/assets/owl.carousel.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('assets_front/libs/owl.carousel/assets/owl.theme.default.min.css') ?>" rel="stylesheet" />
	<!-- Bootstrap Css -->
	<link href="<?= config_item('theme_url') ?>assets/css/bootstrap<?= session('mode') === 'dark' ? '-dark' : '' ?>.min.css" id="bootstrap-style" rel="stylesheet" />
	<!-- Icons Css -->
	<link href="<?= config_item('theme_url') ?>assets/css/icons.min.css" rel="stylesheet" />
	<!-- App Css-->
	<link href="<?= config_item('theme_url') ?>assets/css/app<?= session('mode') === 'dark' ? '-dark' : '' ?>.min.css" id="app-style" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css?q=' . random_string()) ?>">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="<?= base_url('assets/js/jquery.datetimepicker.min.css')?>">

	<?php require('components/styles.php') ?>

	
</head>


<body <?php if (session('sidebar') === 'vertical') : ?> data-sidebar="<?= @session('mode') ?>" <?php elseif (session('sidebar') === 'horizontal') : ?> data-topbar="dark" data-layout="horizontal" <?php endif ?>>
	<!-- Loader -->
	<div id="preloader">
		<div id="status" class="status-preloader">
			<div class="spinner-chase">
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
				<div class="chase-dot"></div>
			</div>
		</div>
	</div>

	<!-- Begin page -->
	<div id="layout-wrapper">
		<header id="page-topbar">
			<div class="navbar-header">
				<div class="d-flex">
					<!-- LOGO -->
					<div class="navbar-brand-box">
						<a href="<?= base_url() ?>" class="logo logo-dark">
							<span class="logo-sm">
								<!-- <img src="<?= sistem()->logo_sm_dark ?>" alt="" height="22"> -->
								<img src="<?= base_url('assets/img/logo-pusdahamnas-dark.png') ?>" alt="" height="22">
							</span>
							<span class="logo-lg">
								<!-- <img src="<?= sistem()->logo_dark ?>" alt="" height="17"> -->
								<img src="<?= base_url('assets/img/logo-pusdahamnas-dark.png') ?>" alt="" height="30">
							</span>
						</a>

						<a href="<?= base_url() ?>" class="logo logo-light">
							<span class="logo-sm">
								<!-- <img src="<?= sistem()->logo_sm_light ?>" alt="" height="22"> -->
								<img src="<?= base_url('assets/img/logo-pusdahamnas.png') ?>" alt="" height="22">
							</span>
							<span class="logo-lg">
								<!-- <img src="<?= sistem()->logo_light ?>" alt="" height="19"> -->
								<img src="<?= base_url('assets/img/logo-pusdahamnas.png') ?>" alt="" height="30">
							</span>
						</a>
					</div>

					<?php if (session('sidebar') === 'vertical') : ?>
						<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
							<i class="fa fa-fw fa-bars"></i>
						</button>
					<?php endif ?>

					<button type="button" class="btn btn-sm px-3 header-item waves-effect" id="tombol-session-tahun">
						Tahun <b><?= session('tahun') ?></b>
					</button>

					<div class="dropdown dropdown-mega d-none d-lg-block ml-2">
						<button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
							<span key="t-info" class="mr-1">Informasi</span>
							<i class="mdi mdi-chevron-down"></i>
						</button>

						<div class="dropdown-menu dropdown-megamenu">
							<div class="row">
								<div style="border-right: 1px solid #292f41;" class="col-sm-4 row">
									<div class="col-md-6">
										<h5 class="font-size-15 font-weight-bold mt-0">Otoritas</h5>
										<p><?= strtoupper(session('nama_role')) ?> </p>

										<h5 class="font-size-15 font-weight-bold mt-2">Sidebar</h5>
										<div class="custom-control custom-radio custom-radio-primary mb-1">
											<input type="radio" id="sidebar-vertical" name="sidebar" value="vertical" <?= session('sidebar') === 'vertical' ? 'checked' : '' ?> class="custom-control-input" onchange="javascript:onChangeSidebar(this);">
											<label class="custom-control-label" for="sidebar-vertical">Vertical</label>
										</div>
										<div class="custom-control custom-radio custom-radio-primary mb-1">
											<input type="radio" id="sidebar-horizontal" name="sidebar" value="horizontal" <?= session('sidebar') === 'horizontal' ? 'checked' : '' ?> class="custom-control-input" onchange="javascript:onChangeSidebar(this);">
											<label class="custom-control-label" for="sidebar-horizontal">Horizontal</label>
										</div>
									</div>
									<div class="col-md-6">
										<h5 class="font-size-15 font-weight-bold mt-2">Mode</h5>
										<div class="custom-control custom-radio custom-radio-primary mb-1">
											<input type="radio" id="mode-light" name="mode" value="light" <?= session('mode') === 'light' ? 'checked' : '' ?> class="custom-control-input" onchange="javascript:onChangeMode(this);">
											<label class="custom-control-label" for="mode-light">Light</label>
										</div>
										<div class="custom-control custom-radio custom-radio-primary mb-1">
											<input type="radio" id="mode-dark" name="mode" value="dark" <?= session('mode') === 'dark' ? 'checked' : '' ?> class="custom-control-input" onchange="javascript:onChangeMode(this);">
											<label class="custom-control-label" for="mode-dark">Dark</label>
										</div>

									</div>
								</div>

								<div style="border-right: 1px solid #292f41;" id="waktu" class="col-sm-4 d-flex flex-column text-center align-items-center justify-content-start"></div>

								<div class="col-sm-4">
									<div class="row">
										<div class="col-sm-6">
											<h5 class="font-size-15 font-weight-bold mt-0" key="t-ui-components">Deskripsi</h5>
											<p><?= sistem()->deskripsi ?></p>
										</div>

										<div class="col-sm-5">
											<div>
												<a href="<?= base_url() ?>" class="logo logo-dark">
													<span class="logo-sm">
														<img src="<?= sistem()->logo_sm_dark ?>" alt="" height="22">
													</span>
													<span class="logo-lg">
														<img src="<?= sistem()->logo_dark ?>" alt="" height="17">
													</span>
												</a>

												<a href="<?= base_url() ?>" class="logo logo-light">
													<span class="logo-sm">
														<img src="<?= sistem()->logo_sm_light ?>" alt="" height="22">
													</span>
													<span class="logo-lg">
														<img src="<?= sistem()->logo_light ?>" alt="" height="19">
													</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="d-flex">

					<div class="dropdown d-none d-lg-inline-block ml-1">
						<button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
							<i class="bx bx-fullscreen"></i>
						</button>
					</div>
                 <?php
                    if($this->session->username){                        
                        if($this->session->tipe_daftar ==''){
                        //    echo $this->session->tipe_daftar;
                       // }
                    //}
                 ?>
					<div id="dropdown_collapse_sh" class="dropdown d-inline-block">
                                    <?php
                                        ///$this->db->where('deleted_at',null);
                                        $where3 = "is_active = '0' AND deleted_at is null";
                                        $this->db->where($where3);
                                        $count = $this->db->count_all_results('tb_lembaga');
                        							
										//$where1 = "is_active = '0'";// order by id_lembaga desc limit 3";
                                        //$this->db->where('deleted_at',null);
                                        $where1 = "is_active = '0' AND deleted_at is null";
                                        $this->db->or_where($where1);
				                        $this->db->order_by('id_lembaga', 'desc');
                                        $this->db->group_by('nama_lembaga');
			                            $this->db->limit(3);
										$query = $this->db->get('tb_lembaga');
										$detail_lembaga = [];
										if ($query) {
											$detail_lembaga = $query->result_array();
										} else {
											// Handle the error, e.g., log the error or set $detail_lembaga to an empty array
											$detail_lembaga = [];
											log_message('error', 'Query failed: ' . $this->db->last_query());
										}
                                        //$this->db->where('is_active',0);
										$where = "is_active = '0' AND tipe_daftar = '2' AND deleted_at is null";
                                        $this->db->where($where);
                                        $count_komham = $this->db->count_all_results('users');
                                        
										$where2 = "is_active = '0' AND tipe_daftar = '2' order by id desc limit 3";
                                        $this->db->where($where2);
                                        $detail_user = $this->db->get('users')->result_array();
										
                                    ?>
						<button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="bx bx-bell"></i><span class="badge badge-warning navbar-badge"><?php echo $count;?><span class="badge badge-success navbar-badge" style="font-size: smaller;"><?php echo $count_komham;?></span> <!-- bx-tada -->
							<!-- <span class="badge badge-danger badge-pill">0</span> -->
						</button>
						
						<div id="dropdown_collapse" class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
							<div class="p-3">
								<div class="row align-items-center">
									<div class="col">
									<!--	<h6 class="m-0-" key="t-notifications"> <i class="fas fa-building mr-2"></i><?php echo $count;?>&nbsp;Lembaga HAM </h6>-->
                                            <div class="nav-item dropdown" >
                                              <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                               <label style="color: black;"><i class="fas fa-building mr-2"></i><?php echo $count;?>&nbsp;Lembaga HAM</label>
                                             </a>
                                             <?php
                                               if($detail_lembaga){
                                                    $no = 0;
                                                    foreach($detail_lembaga as $str){ $no = $no +1;
                                                    ?>
                                                      <form class='dropdown-menu'>                                         
                                                           <ul class='list-group text-black'>
                                                             <?php                                                              
                                                             if($no==1){
                                                              echo "<li class='list-group-item'>";
                                                              echo $str['nama_lembaga'];
                                                              echo "</li>";
                                                             } ?>                                                            
                                                             <?php
                                                             if($no==2){
                                                              echo "<li class='list-group-item'>";
                                                              echo $str['nama_lembaga'];
                                                              echo "</li>";
                                                             } ?>                                                            
                                                            <?php
                                                             if($no==3){
                                                              echo "<li class='list-group-item'>";
                                                              echo $str['nama_lembaga'];
                                                              echo "</li>";
                                                             } ?>
                                                        </ul>
                                                        <?php }?>
                                                      </form>
                                             <?php }?>
                                            </div>
									</div>
          
									<?php if($this->session->tipe_daftar != '2'){ ?>
									<div class="col-auto">
										<a href="<?=base_url('data_lembaga/index/YnpEZWRoUDI5M3hPV0FwMUk4RDNvNmIvcjRPcWtxTjljRUJFTHJWNnVlMD0=')?>" class="small" key="t-view-all"> Lihat Semua</a>
									</div>
									<?php } ?>
								</div>
								<hr/>
								<div class="row align-items-center">
									<div class="col">
										<!--<h6 class="m-0" key="t-notifications"> <i class="fas fa-user mr-2"></i><?php echo $count_komham;?>&nbsp;User Komunitas HAM </h6>-->
 
                                                    <div class="nav-item dropdown" >
                                                      <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                                       <label style="color: black;"><i class="fas fa-user mr-2"></i><?php echo $count_komham;?>&nbsp;User Komunitas HAM </label>
                                                     </a>
                                             <?php
                                               if($detail_user){
                                                    $no = 0;
                                                    foreach($detail_user as $str){ $no = $no +1;
                                                    ?>
                                                      <form class='dropdown-menu'>                                         
                                                           <ul class='list-group text-black'>
                                                             <?php                                                              
                                                             if($no==1){
                                                              echo "<li class='list-group-item'>";
                                                              echo $str['username'];
                                                              echo "</li>";
                                                             } ?>                                                            
                                                             <?php
                                                             if($no==2){
                                                              echo "<li class='list-group-item'>";
                                                              echo $str['username'];
                                                              echo "</li>";
                                                             } ?>                                                            
                                                            <?php
                                                             if($no==3){
                                                              echo "<li class='list-group-item'>";
                                                              echo $str['username'];
                                                              echo "</li>";
                                                             } ?>
                                                        </ul>
                                                        <?php }?>
                                                      </form>
                                                 <?php }?>
                                                    </div>
                                    </div>
									<?php if($this->session->tipe_daftar != '2'){?>
									<div class="col-auto">
										<a href="<?= base_url('status_komunitasham/index/ZzJhV2dMbW1neWptcXlGM2tWdzdKRFFSZSt4MUNQRnY1VHM5SVh3L3k2Yz0=')?>" class="small" key="t-view-all"> Lihat Semua</a>
									</div>
									<?php } ?>
								</div>
							</div>
							<div data-simplebar style="max-height: 230px;">

							</div>
						</div>
					</div>
                   <?php } } ?>
					<div class="dropdown d-inline-block">
						<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?php if($this->session->photo){ $gbr = session('photo'); ?>
                             <img class="rounded-circle header-profile-user" src="<?= site_url().'assets/photo/'.$gbr ?>" alt="Header Photo">
                           <?php }else{?>
							<img class="rounded-circle header-profile-user" src="<?= @session('user')->foto->path ? "https://egov.phicos.co.id/sulut/portal/" . @session('user')->foto->path : base_url('assets/img/user-icon.jpg') ?>" alt="Header Avatar">
						   <?php }?>
							<span class="d-none d-xl-inline-block ml-1 mr-1" key="t-nama"><?= session('nama') ?></span>
							<i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<!-- item-->
							<a class="dropdown-item" href="javascript:void(0);" onclick="javascript:$('#modal-profil').modal('show');"><i class="bx bx-user font-size-16 align-middle mr-1"></i> <span key="t-profil">Profil</span></a>
							<?php if (session('multirole')) : ?>
								<a class="dropdown-item" href="<?= site_url('auth/chooseRole/' . session('id')) ?>"><i class="fas fa-spin fa-sync font-size-15 align-middle mr-1"></i> <span key="t-beranda">Ganti Otoritas</span></a>
							<?php endif ?>
							<?php if (session('mode') === 'light') : ?>
								<a class="dropdown-item" href="javascript:void(0);" onclick="javascript:darkMode();"><i class="bx bx-moon font-size-16 align-middle mr-1"></i> <span key="t-dark_mode">Dark Mode</span></a>
								<div class="dropdown-divider"></div>
							<?php elseif (session('mode') === 'dark') : ?>
								<a class="dropdown-item" href="javascript:void(0);" onclick="javascript:lightMode();"><i class="bx bxs-sun  font-size-16 align-middle mr-1"></i> <span key="t-light_mode">Light Mode</span></a>
								<div class="dropdown-divider"></div>
							<?php endif ?>

							<a class="dropdown-item text-danger" href="<?= site_url('auth/logout') ?>"><i class="bx bx-power-off font-size-16 align-top mr-1 text-danger"></i> <span key="t-logout">Logout</span></a>
						</div>
					</div>

				</div>
			</div>
		</header>

		<?php if (session('sidebar') === 'vertical') : ?>
			<!-- ========== Left Sidebar Start ========== -->
			<div class="vertical-menu">

				<div data-simplebar class="h-100 bg-sidebar">

					<!--- Sidemenu -->
					<div id="sidebar-menu">
						<!-- Left Menu Start -->
						<ul class="metismenu list-unstyled" id="side-menu"></ul>
					</div>
					<!-- Sidebar -->
				</div>
			</div>
			<!-- Left Sidebar End -->

		<?php elseif (session('sidebar') === 'horizontal') : ?>
			<!-- ========== Left Sidebar Start ========== -->
			<div class="topnav">
				<div class="container-fluid">
					<nav class="navbar navbar-light navbar-expand-lg topnav-menu">

						<div class="collapse navbar-collapse" id="topnav-menu-content">
							<ul class="navbar-nav" id="top-menu" style="height: 53px;"></ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- Top Nav End -->
		<?php endif ?>

		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<!-- ============================================================== -->
		<div class="main-content">

			<div class="page-content">
				<div class="container-fluid">

					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box d-flex align-items-center justify-content-between">
								<h4 class="mb-0 font-size-18"><?= isset($title) ? $title : '' ?></h4>

								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<?php if (@$breadcrumb) : ?>
											<?php for ($i = 0; $i < count($breadcrumb); $i++) : ?>
												<?php if ($i === 0) : ?>
													<li class="breadcrumb-item"><a href="javascript: void(0);"><?= $breadcrumb[$i]  ?></a></li>
												<?php else : ?>
													<li class="breadcrumb-item active"><?= $breadcrumb[$i] ?></li>
												<?php endif ?>
											<?php endfor; ?>
										<?php endif ?>
									</ol>
								</div>

							</div>
						</div>
					</div>
					<!-- end page title -->

					<?= $contents ?>

				</div> <!-- container-fluid -->
			</div>
			<!-- End Page-content -->


			<footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							Copyright &copy; <?= date('Y') ?>
						</div>
						<div class="col-sm-6">
							<div class="text-sm-right d-none d-sm-block">
								<?= sistem()->nama ?>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<!-- end main content-->

		<input type="hidden" id="menu_id" value="<?= $menu_id ?>">
		<input type="hidden" id="menu_active" value="<?= $menu_active ?? null ?>">
		<input type="hidden" id="menu_open" value="<?= $menu_open ?? null ?>">

		<?php if (@$access) : ?>
			<?php foreach ($access as $key => $value) : ?>
				<input type="hidden" name="<?= $key ?>_access" value="<?= $value ? 1 : 0 ?>">
			<?php endforeach ?>
		<?php endif ?>
	</div>
	<!-- END layout-wrapper -->

	<?php require('components/modals.php') ?>
	<?php if (@$modals) : ?>
		<?php for ($i = 0; $i < count($modals); $i++) :
			echo @$modals[$i];
		endfor ?>
	<?php endif ?>

	<!-- JAVASCRIPT -->
	<script src="<?= themeUrl() ?>assets/libs/jquery/jquery.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
	<script src="https://ministry.phicos.co.id/tema/Skote_v2.1.0/HTML/Admin/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/metismenu/metisMenu.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= themeUrl() ?>assets/libs/node-waves/waves.min.js"></script>
	<script src="<?= base_url() ?>assets_front/libs/owl.carousel/owl.carousel.min.js"></script>
	<script src="<?= themeUrl() ?>assets/js/app.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


	<?php require('components/scripts.php') ?>

	<script src="<?= base_url('assets/js/script.js?q=' . random_string()) ?>"></script>
	<script src="<?= base_url('assets/js/menu.js?q=' . random_string()) ?>"></script>

	<?= $javascript ?>

	<?php if (!empty($script_js)) : ?>
		<?php if (is_array($script_js)) : ?>
			<?php foreach ($script_js as $js) : ?>
				<script src="<?= $js . '?q=' . random_string() ?>"></script>
			<?php endforeach ?>
		<?php else : ?>
			<script src="<?= $script_js . '?q=' . random_string() ?>"></script>
		<?php endif ?>
	<?php endif ?>

	<script>
        $("#timeline-carousel-1").owlCarousel({
            items: 1,
            loop: !1,
            margin: 0,
            nav: !0,
            navText: [
                "<i class='mdi mdi-chevron-left'></i>",
                "<i class='mdi mdi-chevron-right'></i>",
            ],
            dots: !1,
            responsive: { 576: { items: 2 }, 768: { items: 4 } },
        });
        $("#timeline-carousel-2").owlCarousel({
            items: 1,
            loop: !1,
            margin: 0,
            nav: !0,
            navText: [
                "<i class='mdi mdi-chevron-left'></i>",
                "<i class='mdi mdi-chevron-right'></i>",
            ],
            dots: !1,
            responsive: { 576: { items: 2 }, 768: { items: 4 } },
        });
        $("#timeline-carousel-3").owlCarousel({
            items: 1,
            loop: !1,
            margin: 0,
            nav: !0,
            navText: [
                "<i class='mdi mdi-chevron-left'></i>",
                "<i class='mdi mdi-chevron-right'></i>",
            ],
            dots: !1,
            responsive: { 576: { items: 2 }, 768: { items: 4 } },
        });
    </script>
</body>

</html>