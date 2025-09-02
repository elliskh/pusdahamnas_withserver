<style>
    .img-logo {
        width: 100%;
        max-width: 820px;
    }

    .box-icon {
        font-size: 20px !important;
    }

    .breadcrumb {
        background-color: transparent !important;
    }

    #title_isu {
        font-size: 20px;
        text-transform: capitalize;
        font-weight: bold;
    }
</style>

<body data-topbar="dark" data-layout="horizontal">
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex align-items-center">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="<?= base_url() ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img class="img-fluid img-logo" src="https://ministry.phicos.co.id/front/pusdahamnas/assets/images/logo-pusdahamnas.png" alt="img-logo">
                            </span>
                            <span class="logo-lg">
                                <img class="img-fluid img-logo" src="https://ministry.phicos.co.id/front/pusdahamnas/assets/images/logo-pusdahamnas-pjg.png" alt="img-logo">
                            </span>
                        </a>
                    </div>
                    <img src="https://pusdahamnas.komnasham.go.id/assets/30th_komnasham_white.png" style="width: 20%;" class="img-fluid">
                </div>
                <div class="d-flex" style="width:25%">
                    <!-- Bilingual -->
                    <div class="dropdown d-inline-block">
                        <span id="ttg_kami">
                            <a href="<?php echo base_url('home/about')?>">
                                <span style="font-size: small;color:white;">Tentang Kami</span>
                            </a>
                            &nbsp;|&nbsp;
                            <a href="<?php echo base_url('home/kontak')?>">
                                <span style="font-size: small;color:white;">Hubungi Kami</span>
                            </a>
                        </span> 
                        <span style="color: blue;">
                        <?php 
                           if($this->session->tipe_daftar || $this->session->nama){
                            echo "<label style='color:white;'>".strtoupper($this->session->nama)."</label>";?>
                            <a href="<?php echo base_url('auth/logout_front')?>" style="color: red;">| Keluar</a></li>                     
                        <?php }?>
                        
                        </span>
                        <!--<button type="button" class="btn header-item waves-effect"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-imga" src="<?= base_url() ?>assets_front/images/flags/indonesia.png" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?php echo base_url('home')?>" class="dropdown-item notify-item language" data-lang="eng">
                                    <img src="<?= base_url() ?>assets_front/images/flags/indonesia.png" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Indonesia</span>
                                </a>
                                <a href="<?php echo base_url('en/home')?>" class="dropdown-item notify-item language" data-lang="eng">
                                    <img src="<?= base_url() ?>assets_front/images/flags/us.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">English</span>
                                </a>
                            </div>-->
                        <!-- <a href="<?=base_url('~/login')?>" class="btn btn-primary btn-rounded btn-lg d-none d-sm-inline" style="background-color:rgba(243, 243, 249, .07); border-color:white;">   Masuk <i class="fa fa-arrow-right"></i></a>
                        -->
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>
        <style type="text/css">
            .grad9isuH {
                background-image: linear-gradient(to bottom right, #e9e9ec, white);
            }
        </style>
        <style type="text/css">
            .dropdown-menu li {
                position: relative;
            }

            .dropdown-menu .dropdown-submenu {
                display: none;
                position: absolute;
                left: 100%;
                top: -7px;
            }

            .dropdown-menu .dropdown-submenu-right {
                left: 100%;
                left: auto;
            }

            .dropdown-menu>li:hover>.dropdown-submenu {
                display: block;
            }

            .menu-toggle {
                color: white;
            }

            @media only screen and (max-width: 771px) {
                .sidebar {
                    transform: translateY(0);
                    transition: all .25s ease-in-out;
                }

                #ttg_kami {
                    display: none;
                }
            }
        </style>

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light- navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav mr-auto" style="font-size: medium;">
                            <li class="nav-item dropdown">
                                <a class="nav-link d-flex align-items-center justify-content-center" href="<?php echo base_url()?>">
                                    <i class='bx bx-bar-chart-alt-2 box-icon'></i>
                                    <span style="margin-top: 2px;">&nbsp;&nbsp;Data HAM</span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            DATA HAM &raquo;</a>
                                        <ul class="dropdown-menu dropdown-submenu">
                                            <li>
                                                <a href="#" class="dropdown-item">Pelanggaran HAM Berat</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown-item">Permasalahan HAM Papua</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('home/konflik_agraria')?>" onclick="getIsu3()" class="dropdown-item">Konflik Agraria</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('home/kelompok_marginal')?>" onclick="getIsu4()" class="dropdown-item">Kelompok Marginal</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown-item">Perlindungan Pembela HAM</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown-item">Kebebasab Beragama & Berkeyakinan</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown-item">Bisnis & HAM</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url('home/antisipasi_pemilu')?>" onclick="getIsu8()" class="dropdown-item">Antisipasi Pemilu 2024</a>
                                            </li>
                                            <li>
                                                <a href="#" class="dropdown-item">Pemantauan RANHAM 2022-2024</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('home/media_analisis')?>" class="dropdown-item">MEDIA ANALISIS</a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item dropdown">
                                <a class="nav-link d-flex align-items-center justify-content-center" href="<?php echo base_url('home/dokumen')?>">
                                    <i class='bx bx-file box-icon'></i>
                                    <span style="margin-top: 2px;">&nbsp;&nbsp;DOKUMEN</span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url('home/dokumen')?>" class="dropdown-item">DOKUMEN</a>
                                    </li> 
                                    <li>
                                        <a href="<?php echo base_url('home/snp')?>" class="dropdown-item">
                                            STANDAR NORMA DAN PERATURAN (SNP) &raquo;</a>
                                        <ul class="dropdown-menu dropdown-submenu">
                                          <?php
                                            //foreach ($this->db->where('is_active','1')->get('tb_snp')->result_array() as $lk)
                                            //{
                                                echo'<li><a href="'.base_url('home/data_snp').'" class="dropdown-item">STANDAR NORMA DAN PERATURAN (SNP)</a></li>';
                                            //}
                                          ?>
                                        </ul>  
                                        
                                    </li>
                                </ul>
                            </li>



                            <!-- <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('home/about')?>">-->
                            <!--<i class="bx bx-info-circle mr-2"></i>-->
                            <!--    <span>Tentang Pusdahamnas</span>
                                </a>
                            </li>-->

                            <li class="nav-item dropdown">
                                <a class="nav-link d-flex align-items-center justify-content-center" href="<?php echo base_url('home/anggaran')?>">
                                    <!--<i class="bx bx-building mr-2"></i>-->
                                    <i class='bx bx-dollar-circle box-icon'></i>
                                    <span style="margin-top: 2px;">&nbsp;&nbsp;ANGGARAN RAMAH HAM</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo base_url('home/anggaran')?>" class="dropdown-item">ANGGARAN RAMAH HAM</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('home/anggaran_ham')?>" class="dropdown-item">DATA ANGGARAN RAMAH HAM &raquo;</a>
                                    </li>
                                </ul>                                  
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center justify-content-center" href="<?php echo base_url('home/auditham')?>">
                                    <i class='bx bx-book box-icon'></i>
                                    <span style="margin-top: 2px;">&nbsp;&nbsp;AUDIT HAM</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center justify-content-center" href="<?php echo base_url('home/ahli_ham')?>">
                                    <i class="bx bx-user box-icon"></i>
                                    <span style="margin-top: 2px;">&nbsp;&nbsp;KOMUNITAS HAM</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center justify-content-center" href="<?php echo base_url('home/glossary')?>">
                                    <i class="bx bx-notepad box-icon"></i>
                                    <span style="margin-top: 2px;">&nbsp;&nbsp;GLOSARIUM HAM</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center justify-content-center" href="<?php echo base_url('home/lembaga')?>">
                                    <i class="bx bx-buildings box-icon"></i>
                                    <span style="margin-top: 2px;">&nbsp;&nbsp;SEBARAN LEMBAGA HAM</span>
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link pl-5 pr-5" style="background-color: #F7ED7F;" href="<?=base_url('~/login')?>">
                                    <span style="font-size: small;">Masuk</span>
                                </a>
                            </li> -->
                        </ul>
                        <a href="<?=base_url('~/register')?>" class="btn btn-warning text-white">Daftar</a>&nbsp;
                       <!-- <a href="<?=base_url('~/login')?>"  class="btn btn-warning text-white">Masuk</a>-->
                       <?php 
                           if($this->session->tipe_daftar !=1 && $this->session->nama){?>
                             <a href="<?=base_url('dashboard')?>"  class="btn btn-warning text-white">Dashboard</a>
                       <?php    }else{
                             //redirect(base_url());
                             echo "<a href='#' id='toggle_login' class='btn btn-warning text-white'>Masuk</a>";
                       } ?>
                        
                    </div>
                </nav>
            </div>
<!-- form login --> 
         	<div class="col-xl-3-">
				<div class="my-auto-">
                  <div class="collapse multi-collapse2"  id="multiCollapseExample1">                        
        			<div class="mt-4-" style="width:200px;height:250px;float:right;margin-right: 6px;">
        				<form id="form-login" action="<?= site_url('auth/process') ?>" method="post">
                          
        					<?php if ($this->session->flashdata('error_messages')) : ?>
        						<div class="alert alert-danger alert-dismissible fade show" role="alert">
        							<i class="mdi mdi-block-helper mr-2"></i>
        							<?= $this->session->flashdata('error_messages') ?>
        							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        								<span aria-hidden="true">&times;</span>
        							</button>
        						</div>
        					<?php endif ?>
                            
                           <?php if ($this->session->flashdata('success_messages')) : ?>
        						<div class="alert alert-success alert-dismissible fade show" role="alert">
        							<i class="mdi mdi-block-helper mr-2"></i>
        							<?= $this->session->flashdata('success_messages') ?>
        							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        								<span aria-hidden="true">&times;</span>
        							</button>
        						</div>
        					<?php endif ?>
        
        					<input type="hidden" name="<?= @csrf()['token_name'] ?>" value="<?= @csrf()['hash'] ?>" autocomplete="new-password">
        
        					<div class="form-group">
        						<label for="username">Username</label>
        						<input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" autofocus>
        					</div>
        
        					<div class="form-group">
        						<label for="userpassword">Kata Sandi</label>
        							<input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi">
        							<div class="input-group-append">
        								<button type="button" class="btn bg-theme-custom text-white" id="show-password"><i class="bx bx-show"></i></button>
        							</div>                        
        					</div>
        
        					<div class="form-group">
        						<?= recaptchaDisplay() ?>
        					</div>
                            
        					<div class="mt-3">
        						<button class="btn btn-warning font-weight-bold btn-block waves-effect waves-light" type="submit" style="margin-top: -18%;">Login</button>
                            </div> 
        				</form>
        			</div>
                </div>  
             </div>
          </div>
        </div>
                       
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>        
<script type="text/javascript">
var toggle_login = $('#toggle_login');
toggle_login.on('click', function(event) { 
  if (toggle_login.attr("aria-expanded") === 'false') {
    $('.multi-collapse2').collapse('show')
    toggle_login.attr('aria-expanded', 'true');
    document.getElementById("msg_konten").focus();
  } else {
    $('.multi-collapse2').collapse('hide')
    toggle_login.attr('aria-expanded', 'false');
  }
});
</script>
        <!-- start main content -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php
                   $url_get = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                   
                       if($url_get=='http://devpusdahamnas.komnasham.go.id/'){
                         echo "<marquee><span style='color: black;'>Ini adalah Website PUSDAHAMNAS yang sedang dalam Proses pengembangan. 
                               Sedangkan website PUSDAHAMNAS yang production tetap dapat di akses pada https://pusdahamnas.komnasham.go.id</span></marquee>";
                         
                       } 
                ?>
                    <!-- Title Page Start -->