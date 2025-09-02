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
          @media only screen and(max-width:680px) {
            a{
              color:#444;
            }
          }
        </style>

        <body class="home-three">
          <div class="page-wrapper hero-section-three rel z-2 pt-105 rpt-150 pb-130 rpb-100">
            <!-- gradient -->
            <!--====== Header Part Start ======-->
            <header class="main-header header-three fixed-header">
              <!--Header-Upper-->
              <div class="header-upper">
                <div class="container clearfix">
                  <div class="header-inner py-20">
                    <div class="logo-outer">
                      <div class="logo"><a href="<?= base_url() ?>"><img id="logo-img" src="<?= base_url() ?>assets_landing/images/logos/logo-pusdahamnas-white.png" class="logo" alt="Logo"></a></div>
                    </div>
                            <?php 
                                $useragent = $_SERVER['HTTP_USER_AGENT']; 
                                $iPod = stripos($useragent, "iPod"); 
                                $iPad = stripos($useragent, "iPad"); 
                                $iPhone = stripos($useragent, "iPhone");
                                $Android = stripos($useragent, "Android"); 
                                $iOS = stripos($useragent, "iOS");
                                //-- You can add billion devices 
                                
                                $DEVICE = ($iPod||$iPad||$iPhone||$Android||$iOS);
                            ?>
                    <div class="nav-outer d-flex align-items-center clearfix mx-lg-auto">
                      <!-- Main Menu -->
                      <nav class="main-menu navbar-expand-lg">
                        <div class="navbar-header">
                          <div class="logo-mobile"><a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets_landing/images/logos/logo-pusdahamnas.png" alt="Logo" class="logo-mobile"></a></div>
                          <!-- Toggle Button -->
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="main-menu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix" id="main-menu">
                          <ul class="navigation clearfix">
                          <?php 
                            if($DEVICE){?>
                                <li class="" style="font-size: small;"><a href="<?= base_url() ?>"><span style="color: black;">Beranda</span></a></li>
                           <?php }else{?>
                                <li class="" style="font-size: small;"><a href="<?= base_url() ?>">Beranda</a></li>
                          <?php  }
                          ?>   
                            <li class="dropdown" style="font-size: small;">
                            <?php 
                            
                            if ($DEVICE){
                            ?>
                              <a class="" href="<?php echo base_url()?>">
                                <i class='bx bx-bar-chart-alt-2 box-icon'></i> 
                                <?php 
                                   if($Android || $iPhone){ ?>
                                     <span style="margin-top: -8%;margin-left: -1.2%;color: black;">Data HAM</span>
                                <?php    }else{ ?>
                                     <span style="margin-top: -8%;margin-left: 0%;color: black;">Data HAM</span>
                                <?php  }  
                                ?>                                                                              
                              </a>                            
                            <?php    
                            }else{?>
                               <?php if($iPad){?>
                                  <a class="" href="<?php echo base_url()?>">
                                    <i class='bx bx-bar-chart-alt-2 box-icon'></i>
                                    <span style="margin-top: -8%;color: black;">Data HAM</span>
                                  </a>
                                <?php }else{?>
                                  <a class="" href="<?php echo base_url()?>">
                                    <i class='bx bx-bar-chart-alt-2 box-icon'></i>
                                    <span style="margin-top: -8%;">Data HAM</span>
                                  </a>
                               <?php     
                                }
                                ?>
                           <?php } ?>
                              
                              <ul class="dropdown-menu">
                                <li>
                                <?php  
                                if ($DEVICE){ ?> 
                                  <a href="#" onclick="location.href='<?= base_url('home/visualisasi_data') ?>'" class="dropdown-item">
                                    Visualisasi Data</a>
                                
                                  <!-- <ul class="dropdown-menu dropdown-submenu">
                                    <?php 
                                       // foreach ($this->db->where('is_active', '1')->order_by('id', 'asc')->get('tb_visualisasi')->result_array() as $row){
                                         //   $this->session->set_userdata('looker', $row['looker_studio']);
                                    ?>
                                    <li class="dropdown-submenu">
                                      <a href="<?php echo base_url('home/visualisasi/'.encrypt($row['looker_studio']).'')?>" class="dropdown-item"><?= $row['judul'] ?></a>                                   
                                    </li>
                                   <?php //}  ?>
                                 </ul>  -->
                               <?php }else{ ?> 
                                  <a href="#" onclick="location.href='<?= base_url('home/visualisasi_data') ?>'" class="dropdown-item">
                                    Visualisasi Data &raquo;</a>
                                 
                                  <!-- <ul class="dropdown-menu dropdown-submenu">
                                    <?php 
                                       // foreach ($this->db->where('is_active', '1')->order_by('id', 'asc')->get('tb_visualisasi')->result_array() as $row){
                                         //   $this->session->set_userdata('looker', $row['looker_studio']);
                                    ?>
                                    <li>
                                      <a href="<?php echo base_url('home/visualisasi/'.encrypt($row['looker_studio']).'')?>" class="dropdown-item"><?= $row['judul'] ?></a>                                   
                                    </li>
                                   <?php //}  ?>
                                 </ul> -->
                                    
                               <?php } ?> 
                                 
                                </li>
                                <li>
                                  <a href="<?php echo base_url('home/media_analisis')?>" class="dropdown-item">Media Analisis</a>
                                </li>
                              </ul>
                            </li>
                            <?php
                               if($DEVICE){?>                                  
                                  <li class="dropdown" style="font-size: small;"><a href="#" onclick="location.href='<?= base_url('home/dokumen') ?>'"><span style="color: black;">Dokumen HAM</span></a>
                                <?php }else{?>
                                  <li class="dropdown" style="font-size: small;"><a href="#" onclick="location.href='<?= base_url('home/dokumen') ?>'">Dokumen HAM</a>
                               <?php }
                            ?> <ul>
                                <li><a href="<?= base_url('home/data_snp') ?>">Standar Norma & Pengaturan</a></li>
                                <li><a href="<?= base_url('home/glossary') ?>">Glosarium</a></li>
                                <li><a href="<?= base_url('home/infografis') ?>">Infografis</a></li>
                              </ul>
                            </li>
                            <?php
                              // if($DEVICE){?>  
                                <!--   <li class="dropdown" style="font-size: small;"><a href="#" onclick="location.href='<?= base_url('home/anggaranham_auditham') ?>'"><span style="color: black;">Anggaran & Penilaian</span></a> -->
                               <?php // }else{?>
                                <!--    <li class="dropdown" style="font-size: small;"><a href="#" onclick="location.href='<?= base_url('home/anggaranham_auditham') ?>'">Anggaran & Penilaian</a> -->
                                <?php // }
                            ?> <!-- <ul> -->
                                <li hidden><a href="<?= base_url('home/anggaran_ham') ?>" hidden>Anggaran HAM</a></li>
				<li><a href="#">Penilaian HAM</a></li>
                                <li hidden><a href="<?= base_url('home/audit_ham') ?>">Penilaian HAM</a></li>
                              <!-- </ul> -->
                            <!-- </li> -->
                            <?php
                               if($DEVICE){?>  
                            <li class="dropdown" style="font-size: small;"><a href="#" onclick="location.href='<?= base_url('home/pegiat_ham') ?>'"><span style="color: black;">Komunitas Pegiat HAM</span></a>
                               <?php }else{?>
                                 <li class="dropdown" style="font-size: small;"><a href="#" onclick="location.href='<?= base_url('home/pegiat_ham') ?>'">Komunitas Pegiat HAM</a>
                               <?php } ?>
                              <ul>
                                <li><a href="<?= base_url('home/lembaga') ?>">Lembaga HAM</a></li>
                              </ul>
                            </li>
                          </ul>
                        </div>

                      </nav>

                      <!-- Main Menu End-->

                    </div> 
                    <!-- Bahasa -->
                    
                    <style type="text/css">
                      .btn-konten {
                        rotate: 90deg; 
                      }
                    </style>
                    <div class="menu-right d-none d-lg-flex align-items-center">
                      <!-- <a href="contact.html" class="login">Masuk <i class="fas fa-lock"></i></a> -->
                      <?php if($this->session->role_id == 1) {?>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <?php 
                            $limited_username = substr($this->session->username, 0, 5); // Mengambil 28 karakter pertama dari username
                            if (strlen($this->session->username) > 5) {
                                $limited_username .= ''; // Jika lebih dari 28 karakter, tambahkan ...
                            }
                              echo  $limited_username;
                            ?>

                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);" onclick="javascript:$('#form').modal('show');">Profile</a>
                            <!-- <a class="dropdown-item" href="<?=base_url('dashboard')?>">Dashboard</a> -->
                            <a class="dropdown-item" href="<?=base_url('auth/logout_front')?>">Keluar</a>
                          </div>
                        </div>
                      <?php } else if($this->session->tipe_daftar != 1 && $this->session->nama){?>
                        
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <?php 
                            $limited_username = substr($this->session->username, 0, 5); // Mengambil 28 karakter pertama dari username
                            if (strlen($this->session->username) > 5) {
                                $limited_username .= ''; // Jika lebih dari 28 karakter, tambahkan ...
                            }
                              echo  $limited_username;
                            ?>

                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);" onclick="javascript:$('#form').modal('show');">Profile</a>
                            <!-- <a class="dropdown-item" href="<?=base_url('dashboard')?>">Dashboard</a> -->
                            <a class="dropdown-item" href="<?=base_url('auth/logout_front')?>">Keluar</a>
                          </div>
                        </div>
                      <?php    
                      } else{
                      if($this->session->tipe_daftar == 1 && $this->session->nama){?>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <?php 
                            $limited_username = substr($this->session->username, 0, 5); // Mengambil 28 karakter pertama dari username
                            if (strlen($this->session->username) > 5) {
                                $limited_username .= '...'; // Jika lebih dari 28 karakter, tambahkan ...
                            }
                              echo $limited_username;
                            ?>

                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);" onclick="javascript:$('#form').modal('show');">Profile</a>
                            <a class="dropdown-item" href="<?=base_url('auth/logout_front')?>">Keluar</a>
                          </div>
                        </div>
                      <?php } else {    
                          if ($this->uri->segment(2)=='login'){  
                          
                          }else{
                            if ($this->uri->segment(2)=='pendaftaran'){
                              echo '<a href="'. base_url('home/login') .'" class="theme-btn style-two" style="font-size: smaller;width:85px;height:40px;margin-top:-15%;">Masuk <i class="fas fa-arrow-right"></i></a>'; 
                            } else{   
                              echo '<a href="'. base_url('home/login') .'" class="theme-btn style-two" style="font-size: smaller;width:85px;height:40px;">Masuk <i class="fas fa-arrow-right"></i></a>';
                            }
                          }
                        }
                      } ?>
                    </div>

                  </div>

                </div>
              </div>
              <!--End Header Upper-->

            </header>

            <!--====== Header Part End ======-->
            <script src="<?php echo base_url('assets_front/libs/jquery/jquery.min.js');?>"></script>
            <style type="text/css">
              .modal-backdrop {
                z-index: -1;
              }
            </style>

                      <!-- <?php //if($this->session->tipe_daftar != 1 && $this->session->nama){?>-->
                      <!--<a class="btn-konten btn btn-primary text-white" style="position: fixed;margin-top: 12%;margin-left: 93%; width: 140px;z-index: 9999;" href="<?=base_url('komunitasham/buat_konten/TlhoZDh2VWFCaFhBM0lZUVlwc3dvV0YwMlhvRE1VUDFpS1gzTXlJRXVhcz0=')?>"  class="btn btn-success text-white" style="margin-top: -15%;">Buat Konten</a>
                      <div style="margin-top: 95%;">
                           <a class="btn-konten btn btn-primary text-white" style=" width: 140px;" href="<?=base_url('komunitasham/buat_konten/TlhoZDh2VWFCaFhBM0lZUVlwc3dvV0YwMlhvRE1VUDFpS1gzTXlJRXVhcz0=')?>"  class="btn btn-success text-white" style="margin-top: -15%;">Buat Konten</a>
                      </div>
                      <?php //}?>-->
            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color:#f4f4f4;">
                  <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Data Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="form-profil" data-id="<?= session('id') ?>" action="#" class="form form-horizontal" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                      <div class="form-group">
                        <input type="hidden" name="username" id="profil-username" class="form-control" disabled value="<?= session('username') ?>">
                        <input type="hidden" name="role" id="profil-role" class="form-control" disabled value="<?= session('nama_role') ?>">                      
                        <label for="nama"><span>Nama</span></label>  
                        <input type="text" style="background-color:white;" class="form-control heighttext" id="nama" name="nama" value="<?= session('nama') ?>" placeholder="Nama">
                        <input type="hidden" style="background-color:white;" class="form-control heighttext" id="id" name="id" value="<?= session('id') ?>">
                      </div>
                      <!--<div class="form-group">
                       <label for="email"><span>Email</span></label>  
                        <input type="email" style="background-color:white;" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= session('email') ?>" placeholder="email" disabled>
                      </div>-->
                      <div class="form-group">
                        <input type="password" style="background-color:white;" class="form-control" id="password" name="password" placeholder="Password">
                        <span class="text-danger">Kata Sandi *) kosongkan jika tidak ingin mengubah kata sandi</span>
                      </div>
                      <div class="form-group">
                        <!--<input type="password" style="background-color:white;" class="form-control" id="password2" name="password2" placeholder="Confirm Password">-->
                        <input type="password" style="background-color:white;" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        
                      </div>
                      <div class="form-group">
                        <label for="photo">Photo</span></label>
                        <input type="file" style="background-color:white;" class="form-control" name="gambar" id="gambar" value="">
                      </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- End modal profil -->
            <script type="text/javascript">
              $('.modal-backdrop').remove();
              $('#form-profil').on('submit', function (e) {
                e.preventDefault();

                let data = new FormData(this);
                //	data.append(CSRF.token_name, CSRF.hash);
                //alert(data);    
                $.ajax({
                  url: "<?php echo base_url('welcome/editProfilBiasa');?>", //$(this).prop('action'),
                  type: "POST",
                  data: data,
                  dataType: 'json',
                  processData: false,
                  contentType: false,
                  //async:true,
                  //crossDomain:true,
                  success: (res) => {

                    if (res.status == 'sukses') {
                      alert("Data berhasil update ");
                      location.reload()
                    } else {
                      toastrError('Gagal', 'Terjadi kesalahan data');
                    }
                  },
                  error: (res) => {
                    if (JSON.stringify(res.status) == 500) {
                      alert("Terjadi kesalahan di server!");
                    } else {
                      alert("Simpan data berhasil");
                      history.go(-1);
                    }
                    /*error: (res) => {
                alert("Terjadi kesalahan di server!");
				//toastrError('Gagal', 'Terjadi kesalahan di server');
				//table.ajax.reload();
			}*/
                  }
                });
              });
            </script>

            <!-- <script>
function headerStyle() {
  if ($(".main-header").length) {
    var windowpos = $(window).scrollTop();
    var siteHeader = $(".main-header");
    var siteNav = $("a");
    var scrollLink = $(".scroll-top");
    const gambar = document.getElementById('logo-img');
    if (windowpos <= 100) {
      siteHeader.addClass("fixed-header");      
      ///siteNav.addClass("text-custom");
      gambar.src = '/assets_landing/images/logos/logo-pusdahamnas-white.png';
      gambar.alt = 'gambar baru';
      scrollLink.fadeIn(300);
    } else {
      siteHeader.addClass("fixed-header");      
      siteNav.addClass("text-custom");
      //siteNav.removeClass("text-custom");
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
          siteNav.removeClass("text-custom");
          gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
          gambar.alt = 'gambar baru';
          scrollLink.fadeIn(300);
        } else {
          siteHeader.removeClass("fixed-header");                
          siteNav.addClass("text-custom");
          siteNav.removeClass("text-custom");
          gambar.src = '/assets_landing/images/logos/logo-pusdahamnas-white.png';
          gambar.alt = 'gambar baru';
          scrollLink.fadeOut(300);
        }
      }
    }

    headerStyle();
  });
});
</script> -->
